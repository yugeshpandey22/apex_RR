<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

$success_msg = '';
$error_msg = '';

// Handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_banner'])) {
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $link_url = $_POST['link_url'] ?? '';

    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/images/banners/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $filename = uniqid() . '_' . basename($_FILES['banner_image']['name']);
        $target_path = $upload_dir . $filename;
        
        if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_path)) {
            $db_path = 'assets/images/banners/' . $filename;
            
            $mobile_db_path = null;
            if (isset($_FILES['mobile_banner_image']) && $_FILES['mobile_banner_image']['error'] === UPLOAD_ERR_OK) {
                $mobile_filename = uniqid() . '_mobile_' . basename($_FILES['mobile_banner_image']['name']);
                $mobile_target_path = $upload_dir . $mobile_filename;
                if (move_uploaded_file($_FILES['mobile_banner_image']['tmp_name'], $mobile_target_path)) {
                    $mobile_db_path = 'assets/images/banners/' . $mobile_filename;
                }
            }
            
            $stmt = $pdo->prepare("INSERT INTO banners (title, subtitle, image_path, mobile_image_path, link_url) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $subtitle, $db_path, $mobile_db_path, $link_url]);
            $success_msg = "Banner uploaded successfully!";
        } else {
            $error_msg = "Failed to upload image.";
        }
    } else {
        $error_msg = "Please select a valid image file.";
    }
}

// Handle Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_banner'])) {
    $id = $_POST['banner_id'];
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $link_url = $_POST['link_url'] ?? '';

    $mobile_db_path = null;
    $upload_dir = '../assets/images/banners/';
    
    // Process mobile image if uploaded
    if (isset($_FILES['mobile_banner_image']) && $_FILES['mobile_banner_image']['error'] === UPLOAD_ERR_OK) {
        $mobile_filename = uniqid() . '_mobile_' . basename($_FILES['mobile_banner_image']['name']);
        $mobile_target_path = $upload_dir . $mobile_filename;
        
        if (move_uploaded_file($_FILES['mobile_banner_image']['tmp_name'], $mobile_target_path)) {
            $mobile_db_path = 'assets/images/banners/' . $mobile_filename;
            
            // Delete old mobile image
            $stmt = $pdo->prepare("SELECT mobile_image_path FROM banners WHERE id = ?");
            $stmt->execute([$id]);
            $old_mobile = $stmt->fetchColumn();
            if ($old_mobile && file_exists('../' . $old_mobile)) {
                unlink('../' . $old_mobile);
            }
        }
    }

    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
        $filename = uniqid() . '_' . basename($_FILES['banner_image']['name']);
        $target_path = $upload_dir . $filename;
        
        if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_path)) {
            $db_path = 'assets/images/banners/' . $filename;
            
            $stmt = $pdo->prepare("SELECT image_path FROM banners WHERE id = ?");
            $stmt->execute([$id]);
            $old = $stmt->fetchColumn();
            if ($old && file_exists('../' . $old)) {
                unlink('../' . $old);
            }
            
            if ($mobile_db_path) {
                $stmt = $pdo->prepare("UPDATE banners SET title = ?, subtitle = ?, link_url = ?, image_path = ?, mobile_image_path = ? WHERE id = ?");
                $stmt->execute([$title, $subtitle, $link_url, $db_path, $mobile_db_path, $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE banners SET title = ?, subtitle = ?, link_url = ?, image_path = ? WHERE id = ?");
                $stmt->execute([$title, $subtitle, $link_url, $db_path, $id]);
            }
            $success_msg = "Banner updated successfully!";
        } else {
            $error_msg = "Failed to upload new image.";
        }
    } else {
        if ($mobile_db_path) {
            $stmt = $pdo->prepare("UPDATE banners SET title = ?, subtitle = ?, link_url = ?, mobile_image_path = ? WHERE id = ?");
            $stmt->execute([$title, $subtitle, $link_url, $mobile_db_path, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE banners SET title = ?, subtitle = ?, link_url = ? WHERE id = ?");
            $stmt->execute([$title, $subtitle, $link_url, $id]);
        }
        $success_msg = "Banner updated successfully!";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Fetch image path to delete file
    $stmt = $pdo->prepare("SELECT image_path, mobile_image_path FROM banners WHERE id = ?");
    $stmt->execute([$id]);
    $banner = $stmt->fetch();
    
    if ($banner) {
        $file_to_delete = '../' . $banner['image_path'];
        if (file_exists($file_to_delete)) {
            unlink($file_to_delete);
        }
        if (!empty($banner['mobile_image_path'])) {
            $mobile_to_delete = '../' . $banner['mobile_image_path'];
            if (file_exists($mobile_to_delete)) {
                unlink($mobile_to_delete);
            }
        }
        
        $pdo->prepare("DELETE FROM banners WHERE id = ?")->execute([$id]);
        $success_msg = "Banner deleted successfully!";
    }
}

// Fetch all banners
$stmt = $pdo->query("SELECT * FROM banners ORDER BY created_at DESC");
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Manage Banners</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal"><i class="fa-solid fa-plus me-1"></i> Add New Banner</button>
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
    <?php if (count($banners) > 0): ?>
        <?php foreach ($banners as $b): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <img src="<?= BASE_URL ?><?= htmlspecialchars($b['image_path']) ?>" class="card-img-top object-fit-cover" style="height: 200px;" alt="Banner">
                    <div class="card-body">
                        <?php if ($b['title']): ?>
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($b['title']) ?></h5>
                        <?php endif; ?>
                        <?php if ($b['subtitle']): ?>
                            <p class="card-text text-muted"><?= htmlspecialchars($b['subtitle']) ?></p>
                        <?php endif; ?>
                        <?php if ($b['link_url']): ?>
                            <a href="<?= htmlspecialchars($b['link_url']) ?>" target="_blank" class="text-primary small d-block mb-3"><i class="fa-solid fa-link"></i> <?= htmlspecialchars($b['link_url']) ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-white border-0 text-end">
                        <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editBannerModal<?= $b['id'] ?>"><i class="fa-solid fa-pen"></i> Edit</button>
                        <a href="banners?delete=<?= $b['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this banner?');"><i class="fa-solid fa-trash"></i> Delete</a>
                    </div>
                </div>

                <!-- Edit Banner Modal -->
                <div class="modal fade text-start" id="editBannerModal<?= $b['id'] ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="banners" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="banner_id" value="<?= $b['id'] ?>">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Replace Desktop Image (Optional)</label>
                                <input class="form-control" type="file" name="banner_image" accept="image/*">
                                <small class="text-muted">Leave blank to keep the current desktop image.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Replace Mobile Image (Optional)</label>
                                <input class="form-control" type="file" name="mobile_banner_image" accept="image/*">
                                <small class="text-muted">Leave blank to keep the current mobile image.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Title (Optional)</label>
                                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($b['title']) ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Subtitle (Optional)</label>
                                <input type="text" class="form-control" name="subtitle" value="<?= htmlspecialchars($b['subtitle']) ?>">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Link URL (Optional)</label>
                                <input type="text" class="form-control" name="link_url" value="<?= htmlspecialchars($b['link_url']) ?>">
                            </div>

                            <button type="submit" name="edit_banner" class="btn btn-primary w-100 fw-bold">Save Changes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5 bg-white rounded shadow-sm">
            <h5 class="text-muted">No banners uploaded yet.</h5>
            <p>Click "Add New Banner" to upload your first slider image.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Add Banner Modal -->
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="addBannerModalLabel">Upload New Banner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="banners" method="POST" enctype="multipart/form-data">
            
            <div class="alert alert-info small">
                <i class="fa-solid fa-circle-info"></i> For best results on the homepage, upload wide images (e.g. 1920x800 pixels). You can upload a plain image, or one with text already designed into it.
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Desktop Banner Image <span class="text-danger">*</span></label>
                <input class="form-control" type="file" name="banner_image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mobile Banner Image (Optional)</label>
                <input class="form-control" type="file" name="mobile_banner_image" accept="image/*">
                <small class="text-muted">For best results on phones, upload a square or vertical image. If blank, desktop image is used.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Title (Optional)</label>
                <input type="text" class="form-control" name="title" placeholder="Large text overlay">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Subtitle (Optional)</label>
                <input type="text" class="form-control" name="subtitle" placeholder="Smaller text under title">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Link URL (Optional)</label>
                <input type="text" class="form-control" name="link_url" placeholder="e.g. /apex/pages/project-details.php?id=2">
                <small class="text-muted">Where should users go if they click this banner?</small>
            </div>

            <button type="submit" name="add_banner" class="btn btn-primary w-100 fw-bold">Upload Banner</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>



