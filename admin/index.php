<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

// Fetch stats
try {
    $total_projects = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    $total_enquiries = $pdo->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();
    $unread_enquiries = $pdo->query("SELECT COUNT(*) FROM enquiries WHERE status = 'unread'")->fetchColumn();
    
    // Fetch 5 most recent enquiries
    $recent_enquiries = $pdo->query("SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $total_projects = 0;
    $total_enquiries = 0;
    $unread_enquiries = 0;
    $recent_enquiries = [];
}

// Get admin name
try {
    $admin_name = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'admin_name'")->fetchColumn();
    if (!$admin_name) $admin_name = 'Admin';
} catch (Exception $e) {
    $admin_name = 'Admin';
}
?>

<!-- Custom CSS for Dashboard -->
<style>
    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 12px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .icon-circle {
        height: 60px;
        width: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        color: white;
        border-radius: 12px;
    }
</style>

<!-- Welcome Banner -->
<div class="welcome-banner p-4 mb-4 shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-1">Welcome back, <?= htmlspecialchars($admin_name) ?>! 👋</h3>
            <p class="mb-0 text-white-50">Here's what's happening with your projects today.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="add_project.php" class="btn btn-light text-primary fw-bold px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-plus me-2"></i> Add New Project
            </a>
        </div>
    </div>
</div>

<!-- Stats Row -->
<div class="row mb-4">
    <!-- Total Projects -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card stat-card shadow-sm border-0 border-start border-primary border-4 h-100 py-3">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Projects</div>
                        <div class="h3 mb-0 fw-bold text-dark"><?= $total_projects ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-primary bg-opacity-10">
                            <i class="fa-solid fa-building fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Unread Enquiries -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card stat-card shadow-sm border-0 border-start border-danger border-4 h-100 py-3">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-danger text-uppercase mb-1">New Enquiries</div>
                        <div class="h3 mb-0 fw-bold text-dark"><?= $unread_enquiries ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-danger bg-opacity-10">
                            <i class="fa-solid fa-bell fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Enquiries -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card stat-card shadow-sm border-0 border-start border-success border-4 h-100 py-3">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Enquiries</div>
                        <div class="h3 mb-0 fw-bold text-dark"><?= $total_enquiries ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-success bg-opacity-10">
                            <i class="fa-solid fa-envelope-open-text fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Row -->
<div class="row">
    <!-- Recent Enquiries -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
                <h6 class="m-0 fw-bold text-dark">Recent Enquiries</h6>
                <a href="enquiries.php" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Subject/Project</th>
                                <th>Status</th>
                                <th class="pe-4 text-end">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($recent_enquiries) > 0): ?>
                                <?php foreach ($recent_enquiries as $enq): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold">
                                            <?= htmlspecialchars($enq['name']) ?><br>
                                            <small class="text-muted fw-normal"><?= htmlspecialchars($enq['phone']) ?></small>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($enq['subject'] ?: $enq['project_name']) ?>
                                        </td>
                                        <td>
                                            <?php if ($enq['status'] === 'unread'): ?>
                                                <span class="badge bg-danger rounded-pill px-2 py-1">New</span>
                                            <?php else: ?>
                                                <span class="badge bg-success rounded-pill px-2 py-1">Read</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="pe-4 text-end text-muted small">
                                            <?= date('M d', strtotime($enq['created_at'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No recent enquiries found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h6 class="m-0 fw-bold text-dark">Quick Links</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="add_project.php" class="btn btn-outline-primary text-start py-3 rounded-3 d-flex align-items-center">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3" style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="fw-bold">Add a New Project</div>
                    </a>
                    
                    <a href="enquiries.php" class="btn btn-outline-danger text-start py-3 rounded-3 d-flex align-items-center">
                        <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3" style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-inbox"></i>
                        </div>
                        <div class="fw-bold">Check New Enquiries</div>
                    </a>

                    <a href="settings.php" class="btn btn-outline-secondary text-start py-3 rounded-3 d-flex align-items-center">
                        <div class="icon-circle bg-secondary bg-opacity-10 text-secondary me-3" style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-gear"></i>
                        </div>
                        <div class="fw-bold">Update General Settings</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
