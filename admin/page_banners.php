<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

$success_msg = '';
$error_msg = '';

$pages = [
    'about' => 'About Us',
    'contact' => 'Contact Us',
    'apex_project' => 'Apex Project',
    'rr_project' => 'RR Home Project'
];

// Handle upload/update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_page_banner'])) {
    $page_name = $_POST['page_name'];
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';

    // Check if entry exists
    $stmt = $pdo->prepare("SELECT * FROM page_banners WHERE page_name = ?");
    $stmt->execute([$page_name]);
    $existing = $stmt->fetch();

    $upload_dir = '../assets/images/banners/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $desktop_db_path = $existing ? $existing['desktop_image'] : '';
    $mobile_db_path = $existing ? $existing['mobile_image'] : '';

    // Process Desktop Image
    if (isset($_FILES['desktop_image']) && $_FILES['desktop_image']['error'] === UPLOAD_ERR_OK) {
        $filename = uniqid() . '_desktop_' . basename($_FILES['desktop_image']['name']);
        $target_path = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['desktop_image']['tmp_name'], $target_path)) {
            if ($desktop_db_path && file_exists('../' . $desktop_db_path)) {
                unlink('../' . $desktop_db_path);
            }
            $desktop_db_path = 'assets/images/banners/' . $filename;
        }
    }

    // Process Mobile Image
    if (isset($_FILES['mobile_image']) && $_FILES['mobile_image']['error'] === UPLOAD_ERR_OK) {
        $mobile_filename = uniqid() . '_mobile_' . basename($_FILES['mobile_image']['name']);
        $mobile_target_path = $upload_dir . $mobile_filename;
        if (move_uploaded_file($_FILES['mobile_image']['tmp_name'], $mobile_target_path)) {
            if ($mobile_db_path && file_exists('../' . $mobile_db_path)) {
                unlink('../' . $mobile_db_path);
            }
            $mobile_db_path = 'assets/images/banners/' . $mobile_filename;
        }
    }

    if (!$desktop_db_path) {
        $error_msg = "A desktop image is required.";
    } else {
        if ($existing) {
            $stmt = $pdo->prepare("UPDATE page_banners SET desktop_image = ?, mobile_image = ?, title = ?, subtitle = ? WHERE page_name = ?");
            $stmt->execute([$desktop_db_path, $mobile_db_path, $title, $subtitle, $page_name]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO page_banners (page_name, desktop_image, mobile_image, title, subtitle) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$page_name, $desktop_db_path, $mobile_db_path, $title, $subtitle]);
        }
        $success_msg = "Banner for " . $pages[$page_name] . " saved successfully!";
    }
}

// Fetch all page banners
$stmt = $pdo->query("SELECT * FROM page_banners");
$db_banners = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $db_banners[$row['page_name']] = $row;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Manage Page Banners</h4>
</div>

<?php if ($success_msg): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $success_msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($error_msg): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $error_msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <?php foreach ($pages as $slug => $name): ?>
        <?php $has_banner = isset($db_banners[$slug]); ?>
        <?php $banner = $has_banner ? $db_banners[$slug] : null; ?>
        
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold">
                    <?= $name ?> Banner
                </div>
                
                <?php if ($has_banner && !empty($banner['desktop_image'])): ?>
                    <img src="<?= BASE_URL ?><?= htmlspecialchars($banner['desktop_image']) ?>" class="card-img-top object-fit-cover" style="height: 150px;" alt="Banner">
                <?php else: ?>
                    <div class="bg-light text-center py-5 border-bottom">
                        <i class="fa-solid fa-image fa-3x text-muted mb-2"></i>
                        <p class="mb-0 text-muted">No banner set (Using default)</p>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <?php if ($has_banner): ?>
                        <p class="mb-1"><strong>Title:</strong> <?= htmlspecialchars($banner['title']) ?: '<em>None</em>' ?></p>
                        <p class="mb-3"><strong>Subtitle:</strong> <?= htmlspecialchars($banner['subtitle']) ?: '<em>None</em>' ?></p>
                        <?php if (!empty($banner['mobile_image'])): ?>
                            <span class="badge bg-success">Mobile Image Uploaded</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">No Mobile Image (Desktop used on all)</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                
                <div class="card-footer bg-white border-0 text-end">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPageModal<?= $slug ?>">
                        <i class="fa-solid fa-pen"></i> <?= $has_banner ? 'Update Banner' : 'Set Banner' ?>
                    </button>
                </div>
            </div>

            <!-- Edit Modal for <?= $name ?> -->
            <div class="modal fade text-start" id="editPageModal<?= $slug ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title fw-bold"><?= $has_banner ? 'Update' : 'Set' ?> <?= $name ?> Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="page_banners" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="page_name" value="<?= $slug ?>">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Desktop Banner Image <?= !$has_banner ? '<span class="text-danger">*</span>' : '(Optional)' ?></label>
                            <input class="form-control" type="file" name="desktop_image" accept="image/*" <?= !$has_banner ? 'required' : '' ?>>
                            <small class="text-muted">Wide image (e.g., 1920x400).</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mobile Banner Image (Optional)</label>
                            <input class="form-control" type="file" name="mobile_image" accept="image/*">
                            <small class="text-muted">Square or vertical image. If empty, desktop image is used.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Title (Optional)</label>
                            <input type="text" class="form-control" name="title" value="<?= $has_banner ? htmlspecialchars($banner['title']) : '' ?>" placeholder="Large text overlay">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Subtitle (Optional)</label>
                            <input type="text" class="form-control" name="subtitle" value="<?= $has_banner ? htmlspecialchars($banner['subtitle']) : '' ?>" placeholder="Smaller text under title">
                        </div>

                        <button type="submit" name="save_page_banner" class="btn btn-primary w-100 fw-bold">Save Banner</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
