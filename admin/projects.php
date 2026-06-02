<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

// Determine the category to show
$category_filter = $_GET['category'] ?? 'all';
$category_name = "All Projects";

if ($category_filter === 'rr_home') {
    $category_name = "RR Home Projects";
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'rr_home' ORDER BY created_at DESC");
    $stmt->execute();
} elseif ($category_filter === 'apex') {
    $category_name = "Apex Projects";
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'apex' ORDER BY created_at DESC");
    $stmt->execute();
} else {
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
}

$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle deletion logic if needed later
// ...
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><?= htmlspecialchars($category_name) ?></h4>
    <a href="add_project" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add New</a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage <?= htmlspecialchars($category_name) ?></h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Category</th>
                        <th>Added On</th>
                        <th class="pe-4 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($projects) > 0): ?>
                        <?php foreach ($projects as $proj): ?>
                            <tr>
                                <td class="ps-4 fw-bold">
                                    <?= htmlspecialchars($proj['title']) ?>
                                </td>
                                <td>
                                    <?php if ($proj['category'] === 'rr_home'): ?>
                                        <span class="badge bg-info text-dark rounded-pill px-2 py-1">RR Home</span>
                                    <?php elseif ($proj['category'] === 'apex'): ?>
                                        <span class="badge bg-warning text-dark rounded-pill px-2 py-1">Apex</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary rounded-pill px-2 py-1">Unknown</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted">
                                    <?= date('M d, Y', strtotime($proj['created_at'])) ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="edit_project?id=<?= $proj['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="delete_project" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                                        <input type="hidden" name="id" value="<?= $proj['id'] ?>">
                                        <input type="hidden" name="category" value="<?= $proj['category'] ?>">
                                        <button type="submit" name="delete_project" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No projects found in this category.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

