<?php 
require_once '../config/db.php';

// Fetch all Apex projects
$stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'apex' ORDER BY created_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php'; 
?>

<!-- Page Header -->
<section class="d-flex align-items-center justify-content-center text-center text-white apex-hero" style="background: url('../assets/images/apex banner.webp') center/cover no-repeat; min-height: 400px; padding: 120px 0;">
    <div class="container animate-fade-up" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">
        <h1 class="display-3 fw-bold mb-3 rr-heading-font">Apex Projects</h1>
        <p class="fs-4 fw-light">Explore our commercial developments</p>
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
                    $img_src = $img ? "/apex/" . $img : "../assets/images/project-1.jpg";
                ?>
                <div class="col-md-5">
                    <div class="card h-100 shadow-sm border-0 project-card hover-lift">
                        <img src="<?= htmlspecialchars($img_src) ?>" class="card-img-top rr-card-img object-fit-cover" alt="<?= htmlspecialchars($proj['title']) ?>" style="height: 250px;">
                        <div class="card-body p-4 text-center">
                            <h3 class="card-title h3 fw-bold mb-3"><?= htmlspecialchars($proj['title']) ?></h3>
                            <p class="card-text text-muted mb-4"><?= htmlspecialchars(substr($proj['short_description'], 0, 100)) ?>...</p>
                            <a href="project-details.php?id=<?= $proj['id'] ?>" class="btn btn-warning text-dark w-100 fw-semibold py-2 shadow">View Details</a>
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
