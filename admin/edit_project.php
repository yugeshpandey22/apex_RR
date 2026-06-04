<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

$id = $_GET['id'] ?? 0;

// Fetch project
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Project not found!</div></div>";
    include 'includes/footer.php';
    exit();
}

// Fetch images
$stmt_media = $pdo->prepare("SELECT * FROM project_media WHERE project_id = ?");
$stmt_media->execute([$id]);
$media = $stmt_media->fetchAll(PDO::FETCH_ASSOC);

$success_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_project'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $short_description = $_POST['short_description'];
    $description = $_POST['description'];
    $specifications = $_POST['specifications'];
    $seo_title = $_POST['seo_title'];
    $seo_description = $_POST['seo_description'];

    $upload_dir = '../assets/images/projects/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $desktop_banner_path = $project['desktop_banner'];
    if (isset($_FILES['desktop_banner']) && $_FILES['desktop_banner']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['desktop_banner']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '_hero_desktop.' . $ext;
        if (move_uploaded_file($_FILES['desktop_banner']['tmp_name'], $upload_dir . $new_filename)) {
            if ($desktop_banner_path && file_exists('../' . $desktop_banner_path)) {
                unlink('../' . $desktop_banner_path);
            }
            $desktop_banner_path = 'assets/images/projects/' . $new_filename;
        }
    }

    $mobile_banner_path = $project['mobile_banner'];
    if (isset($_FILES['mobile_banner']) && $_FILES['mobile_banner']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['mobile_banner']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '_hero_mobile.' . $ext;
        if (move_uploaded_file($_FILES['mobile_banner']['tmp_name'], $upload_dir . $new_filename)) {
            if ($mobile_banner_path && file_exists('../' . $mobile_banner_path)) {
                unlink('../' . $mobile_banner_path);
            }
            $mobile_banner_path = 'assets/images/projects/' . $new_filename;
        }
    }

    $stmt_update = $pdo->prepare("UPDATE projects SET category=?, title=?, short_description=?, description=?, specifications=?, seo_title=?, seo_description=?, desktop_banner=?, mobile_banner=? WHERE id=?");
    $stmt_update->execute([$category, $title, $short_description, $description, $specifications, $seo_title, $seo_description, $desktop_banner_path, $mobile_banner_path, $id]);

    if (!empty($_FILES['new_images']['name'][0])) {
        foreach ($_FILES['new_images']['name'] as $key => $filename) {
            $tmp_name = $_FILES['new_images']['tmp_name'][$key];
            $error = $_FILES['new_images']['error'][$key];
            
            if ($error === UPLOAD_ERR_OK) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $new_filename = uniqid() . '_' . time() . '.' . $ext;
                $target_file = $upload_dir . $new_filename;
                
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $media_path = 'assets/images/projects/' . $new_filename;
                    $stmt_media_insert = $pdo->prepare("INSERT INTO project_media (project_id, file_path) VALUES (?, ?)");
                    $stmt_media_insert->execute([$id, $media_path]);
                }
            }
        }
        
        // Re-fetch media to show newly added images immediately
        $stmt_media->execute([$id]);
        $media = $stmt_media->fetchAll(PDO::FETCH_ASSOC);
    }

    $success_msg = "Project updated successfully!";
    
    // Refresh data
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Project</h4>
    <a href="projects?category=<?= htmlspecialchars($project['category']) ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back to Projects</a>
</div>

<?php if ($success_msg): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $success_msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form action="edit_project?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            
            <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">Basic Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Rich Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false">Media & Gallery</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">SEO</button>
                </li>
            </ul>

            <div class="tab-content" id="projectTabsContent">
                <!-- Basic Info Tab -->
                <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                    <div class="mb-3">
                        <label for="projectCategory" class="form-label fw-bold">Project Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="projectCategory" name="category" required>
                            <option value="rr_home" <?= $project['category'] == 'rr_home' ? 'selected' : '' ?>>RR Home Project</option>
                            <option value="apex" <?= $project['category'] == 'apex' ? 'selected' : '' ?>>Apex Project</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="projectTitle" class="form-label fw-bold">Project Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="projectTitle" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="shortDescription" class="form-label fw-bold">Short Description</label>
                        <textarea class="form-control" id="shortDescription" name="short_description" rows="3" placeholder="A brief summary for project cards..."><?= htmlspecialchars($project['short_description']) ?></textarea>
                    </div>
                </div>

                <!-- Rich Details Tab -->
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="mb-4">
                        <label for="fullDescription" class="form-label fw-bold">Full Description</label>
                        <textarea class="form-control" id="fullDescription" name="description"><?= htmlspecialchars($project['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="specifications" class="form-label fw-bold">Specifications</label>
                        <textarea class="form-control" id="specifications" name="specifications"><?= htmlspecialchars($project['specifications']) ?></textarea>
                    </div>
                </div>

                <!-- Media Tab -->
                <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                    
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h5 class="fw-bold mb-3" style="color: var(--secondary-color);">Hero Banners (Optional)</h5>
                        <p class="text-muted mb-4">Set specific banners for the top of the project details page. If empty, the first gallery image is used.</p>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="desktopBanner" class="form-label fw-bold">Desktop Hero Banner</label>
                                <?php if ($project['desktop_banner']): ?>
                                    <div class="mb-2">
                                        <img src="<?= BASE_URL ?><?= htmlspecialchars($project['desktop_banner']) ?>" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                    </div>
                                <?php endif; ?>
                                <input class="form-control" type="file" id="desktopBanner" name="desktop_banner" accept="image/*">
                                <div class="form-text">Wide image (e.g., 1920x600). Uploading a new one replaces the old.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="mobileBanner" class="form-label fw-bold">Mobile Hero Banner</label>
                                <?php if ($project['mobile_banner']): ?>
                                    <div class="mb-2">
                                        <img src="<?= BASE_URL ?><?= htmlspecialchars($project['mobile_banner']) ?>" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                    </div>
                                <?php endif; ?>
                                <input class="form-control" type="file" id="mobileBanner" name="mobile_banner" accept="image/*">
                                <div class="form-text">Square or vertical image (e.g., 1080x1080). Uploading a new one replaces the old.</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 p-4 border rounded bg-white shadow-sm">
                        <label for="newImages" class="form-label fw-bold">Add More Gallery Images</label>
                        <input class="form-control" type="file" id="newImages" name="new_images[]" multiple accept="image/*">
                        <div class="form-text">Select multiple images to append to the existing gallery. Existing images will not be deleted.</div>
                    </div>
                    <label class="form-label fw-bold">Current Gallery Images</label>
                    <div class="row g-3 mb-3">
                        <?php foreach ($media as $img): ?>
                            <div class="col-md-3">
                                <img src="<?= BASE_URL ?><?= htmlspecialchars($img['file_path']) ?>" class="img-fluid rounded border" alt="Project Image">
                            </div>
                        <?php endforeach; ?>
                        <?php if (count($media) == 0): ?>
                            <div class="col-12"><p class="text-muted">No images found for this project.</p></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- SEO Tab -->
                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    <div class="mb-3">
                        <label for="seoTitle" class="form-label fw-bold">SEO Meta Title</label>
                        <input type="text" class="form-control" id="seoTitle" name="seo_title" value="<?= htmlspecialchars($project['seo_title']) ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="seoDescription" class="form-label fw-bold">SEO Meta Description</label>
                        <textarea class="form-control" id="seoDescription" name="seo_description" rows="3"><?= htmlspecialchars($project['seo_description']) ?></textarea>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="text-end">
                <button type="submit" name="edit_project" class="btn btn-primary px-4 fw-bold">
                    <i class="fa-solid fa-save me-2"></i> Update Project
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 initialization -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#fullDescription'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#specifications'))
        .catch(error => {
            console.error(error);
        });
</script>

<?php include 'includes/footer.php'; ?>



