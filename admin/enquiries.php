<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

// Handle Mark as Read
if (isset($_GET['mark_read']) && is_numeric($_GET['mark_read'])) {
    $id = $_GET['mark_read'];
    $stmt = $pdo->prepare("UPDATE enquiries SET status = 'read' WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>window.location.href='enquiries.php';</script>";
    exit();
}

// Fetch enquiries
$stmt = $pdo->query("SELECT * FROM enquiries ORDER BY created_at DESC");
$enquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Manage Enquiries</h4>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage All Enquiries</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Subject/Project</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($enquiries) > 0): ?>
                        <?php foreach ($enquiries as $enq): ?>
                            <tr class="<?= $enq['status'] === 'unread' ? 'table-warning' : '' ?>">
                                <td><?= date('d M Y, h:i A', strtotime($enq['created_at'])) ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($enq['name']) ?></td>
                                <td>
                                    <a href="mailto:<?= htmlspecialchars($enq['email']) ?>"><?= htmlspecialchars($enq['email']) ?></a><br>
                                    <a href="tel:<?= htmlspecialchars($enq['phone']) ?>"><?= htmlspecialchars($enq['phone']) ?></a>
                                </td>
                                <td>
                                    <?= htmlspecialchars($enq['subject'] ?: $enq['project_name']) ?>
                                    <?php if($enq['project_name']): ?>
                                        <span class="badge bg-secondary ms-1">Project</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= nl2br(htmlspecialchars($enq['message'])) ?></td>
                                <td>
                                    <?php if ($enq['status'] === 'unread'): ?>
                                        <span class="badge bg-danger">New</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Read</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($enq['status'] === 'unread'): ?>
                                        <a href="enquiries.php?mark_read=<?= $enq['id'] ?>" class="btn btn-sm btn-primary">Mark Read</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No enquiries found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
