<?php
require_once '../config/db.php';

$id = $_GET['id'] ?? 0;

// Fetch project details
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    // Redirect or show 404 if project not found
    header("Location: home.php");
    exit();
}

// Fetch project media
$stmt_media = $pdo->prepare("SELECT * FROM project_media WHERE project_id = ?");
$stmt_media->execute([$id]);
$media = $stmt_media->fetchAll(PDO::FETCH_ASSOC);

$category_label = $project['category'] === 'rr_home' ? 'RR Home' : 'Apex';

// We override the title so header.php uses it
$page_title = $project['seo_title'] ?: $project['title'] . " | RR Homes";
$page_description = $project['seo_description'] ?: $project['short_description'];

include '../includes/header.php'; 
?>

<?php
$desktop_bg = BASE_URL . "assets/images/projects-hero.webp"; // Default fallback banner
if (!empty($project['desktop_banner'])) {
    $desktop_bg = BASE_URL . $project['desktop_banner'];
} elseif (count($media) > 0 && !empty($media[0]['file_path'])) {
    $desktop_bg = BASE_URL . $media[0]['file_path'];
} else {
    // Custom fallbacks for specific projects
    $t = strtolower($project['title']);
    if (strpos($t, 'royal') !== false) {
        $desktop_bg = BASE_URL . "assets/images/rr%20home%20banner.webp";
    } elseif (strpos($t, 'prince') !== false || strpos($t, 'price') !== false) {
        $desktop_bg = BASE_URL . "assets/images/hero-1.webp";
    } elseif (strpos($t, 'simple') !== false) {
        $desktop_bg = BASE_URL . "assets/images/apex%20banner.webp";
    }
}

$mobile_bg = $desktop_bg;
if (!empty($project['mobile_banner'])) {
    $mobile_bg = BASE_URL . $project['mobile_banner'];
}
?>
<style>
.project-banner-img {
    width: 100%;
    height: auto;
    object-fit: contain;
    object-position: center;
}
</style>
<!-- Project Hero -->
<section class="project-hero w-100" style="background-color: #f8f9fa;">
    <picture>
        <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($mobile_bg) ?>">
        <img src="<?= htmlspecialchars($desktop_bg) ?>" class="d-block project-banner-img" alt="Project Banner">
    </picture>
</section>

<!-- Project Info -->
<section class="py-5 tp-section-bg" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row g-5">
            
            <!-- Left Content -->
            <div class="col-lg-8">
                
                <!-- Description Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>
                            <h2 class="display-6 fw-bold mb-0 tp-section-title">Project Overview</h2>
                        </div>
                        <div class="fs-5 text-muted tp-text-lh rich-text-content">
                            <?= $project['description'] ?>
                        </div>
                    </div>
                </div>

                <!-- Specifications Card -->
                <?php if (!empty(trim(strip_tags($project['specifications'])))): ?>
                <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <h3 class="h2 fw-bold mb-0 tp-heading-font" style="color: var(--secondary-color);">Specifications</h3>
                        </div>
                        <div class="specifications-content fs-5 text-muted tp-text-lh rich-text-content">
                            <?= $project['specifications'] ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Gallery -->
                <?php if (count($media) > 0): ?>
                <div class="d-flex align-items-center mb-4 mt-5">
                    <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <h3 class="h2 fw-bold mb-0 tp-heading-font" style="color: var(--secondary-color);">Photo Gallery</h3>
                </div>
                <div class="row g-4">
                    <?php foreach ($media as $image): ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="gallery-img-wrap shadow-sm rounded-4 overflow-hidden h-100 hover-lift" style="cursor: pointer;">
                            <img src="<?= BASE_URL ?><?= htmlspecialchars($image['file_path']) ?>" class="img-fluid w-100 h-100 object-fit-cover transition-all" style="min-height: 250px; max-height: 300px;" alt="Gallery Image" onclick="window.open(this.src, '_blank')">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Sidebar: Sticky Contact Form -->
            <div class="col-lg-4">
                <div class="sidebar-contact p-4 p-xl-5 rounded-4 shadow-lg sticky-top tp-sidebar-contact" style="top: 100px; background: linear-gradient(145deg, #ffffff, #f0f0f0); border: 1px solid #e0e0e0;">
                    <div class="text-center mb-4">
                        <div class="d-inline-block p-3 bg-warning text-dark rounded-circle mb-3 shadow-sm">
                            <i class="fa-solid fa-headset fs-2"></i>
                        </div>
                        <h3 class="h3 fw-bold mb-2 tp-heading-font" style="color: var(--secondary-color);">Interested in <?= htmlspecialchars($project['title']) ?>?</h3>
                        <p class="text-muted mb-0">Contact our real estate specialists directly.</p>
                    </div>
                    
                    <form action="send-enquiry" method="POST">
                        <input type="hidden" name="project_name" value="<?= htmlspecialchars($project['title']) ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control p-3 rounded-3 bg-white border" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control p-3 rounded-3 bg-white border" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="mb-4">
                            <input type="tel" class="form-control p-3 rounded-3 bg-white border" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 py-3 rounded-3 fw-bold fs-5 text-dark shadow-sm hover-lift">Request Callback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>



