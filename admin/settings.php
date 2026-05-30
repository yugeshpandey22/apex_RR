<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    foreach ($_POST['settings'] as $key => $value) {
        $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$value, $key]);
    }
    $success_msg = "Settings updated successfully!";
}

// Fetch all settings
$stmt = $pdo->query("SELECT * FROM settings");
$settings_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organize settings by key for easy access
$settings = [];
foreach ($settings_data as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Settings</h4>
</div>

<?php if (isset($success_msg)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $success_msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">General & Contact Settings</h6>
            </div>
            <div class="card-body">
                <form action="settings.php" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Site Title</label>
                        <input type="text" class="form-control" name="settings[site_title]" value="<?= htmlspecialchars($settings['site_title'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Contact Email</label>
                        <input type="email" class="form-control" name="settings[contact_email]" value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Contact Phone Number</label>
                        <input type="text" class="form-control" name="settings[contact_phone]" value="<?= htmlspecialchars($settings['contact_phone'] ?? '') ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Office Address</label>
                        <textarea class="form-control" name="settings[office_address]" rows="4" required><?= htmlspecialchars($settings['office_address'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" name="update_settings" class="btn btn-primary px-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
