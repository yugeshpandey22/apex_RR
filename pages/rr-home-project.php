<?php 
require_once '../config/db.php';

// Fetch all RR Home projects
$stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'rr_home' ORDER BY created_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php'; 
?>

<!-- Page Header -->
<section class="position-relative bg-dark w-100 overflow-hidden">
    <img src="<?= BASE_URL ?>assets/images/rr%20home%20banner.webp" class="w-100 project-page-banner" alt="RR Home Projects Banner" style="height: 400px; object-fit: fill; display: block;">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-center text-white" style="background: rgba(0,0,0,0.3);">
        <div class="container animate-fade-up" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">
            <h1 class="display-3 fw-bold mb-3 rr-heading-font">RR Home Projects</h1>
            <p class="fs-4 fw-light">Explore our premium residential developments</p>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <?php if (count($projects) > 0): ?>
                <?php foreach ($projects as $proj): 
                    // Fetch first image for thumbnail
                    $stmt_img = $pdo->prepare("SELECT file_path FROM project_media WHERE project_id = ? LIMIT 1");
                    $stmt_img->execute([$proj['id']]);
                    $img = $stmt_img->fetchColumn();
                    $t = strtolower($proj['title']);
                    if (!$img) {
                        if (strpos($t, 'royal') !== false) {
                            $img_src = BASE_URL . "assets/images/rr%20home%20banner.webp";
                        } elseif (strpos($t, 'prince') !== false || strpos($t, 'price') !== false) {
                            $img_src = BASE_URL . "assets/images/hero-1.webp";
                        } elseif (strpos($t, 'simple') !== false) {
                            $img_src = BASE_URL . "assets/images/apex%20banner.webp";
                        } else {
                            $img_src = BASE_URL . "assets/images/project-1.jpg";
                        }
                    } else {
                        $img_src = BASE_URL . $img;
                    }
                ?>
                <div class="col-md-5">
                    <div class="card h-100 shadow-sm border-0 project-card hover-lift">
                        <?php $tags = ['Exclusive Deal', 'Best Seller', 'Price Dropped', 'Hot Property']; $randomTag = $tags[array_rand($tags)]; ?>
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 p-2 fs-6 shadow-sm z-1"><?= $randomTag ?></span>
                        <img src="<?= htmlspecialchars($img_src) ?>" class="card-img-top rr-card-img object-fit-cover" alt="<?= htmlspecialchars($proj['title']) ?>" style="height: 250px;">
                        <div class="card-body p-4 text-center">
                            <h3 class="card-title h3 fw-bold mb-3"><?= htmlspecialchars($proj['title']) ?></h3>
                            <p class="card-text text-muted mb-4"><?= htmlspecialchars(substr($proj['short_description'], 0, 100)) ?>...</p>
                            <a href="project-details?id=<?= $proj['id'] ?>" class="btn btn-warning text-dark w-100 fw-semibold py-2 shadow">View Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No projects found in this category yet.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>



