<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
require_once '../config/db.php';

// Fetch all settings for the profile
$stmt = $pdo->query("SELECT * FROM settings");
$settings_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$settings = [];
foreach ($settings_data as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $keys = ['admin_name', 'admin_login_email', 'admin_mobile', 'admin_username'];
        foreach ($keys as $key) {
            $val = $_POST[$key] ?? '';
            // Insert or Update
            $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
            $stmt->execute([$key, $val, $val]);
        }
        $success_msg = "Profile updated successfully!";
        // Refresh settings array
        foreach ($keys as $key) {
            $settings[$key] = $_POST[$key];
        }
    } elseif (isset($_POST['change_password'])) {
        $old_pass = $_POST['old_password'] ?? '';
        $new_pass = $_POST['new_password'] ?? '';
        $confirm_pass = $_POST['confirm_password'] ?? '';
        
        $current_pass = $settings['admin_password'] ?? '';

        if ($new_pass !== $confirm_pass) {
            $error_msg = "New passwords do not match!";
        } else if ($current_pass !== '' && $old_pass !== $current_pass) {
            $error_msg = "Old password is incorrect!";
        } else {
            // Save new password plain text for now as no auth is implemented yet
            $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
            $stmt->execute(['admin_password', $new_pass, $new_pass]);
            $success_msg = "Password changed successfully!";
            $settings['admin_password'] = $new_pass;
        }
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Profile</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="settings" class="text-decoration-none">Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
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

<div class="row">
    <!-- Update Profile Column -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header text-white py-3" style="background-color: #0d6efd;">
                <h6 class="m-0 font-weight-bold">Update Profile</h6>
            </div>
            <div class="card-body">
                <form action="profile" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control" name="admin_name" value="<?= htmlspecialchars($settings['admin_name'] ?? 'Admin') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" name="admin_login_email" value="<?= htmlspecialchars($settings['admin_login_email'] ?? 'admin@example.com') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mobile</label>
                        <input type="text" class="form-control" name="admin_mobile" value="<?= htmlspecialchars($settings['admin_mobile'] ?? '1234567890') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" name="admin_username" value="<?= htmlspecialchars($settings['admin_username'] ?? 'admin') ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Profile Image</label>
                        <input class="form-control" type="file" name="profile_image" accept="image/*">
                        <div class="mt-3">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($settings['admin_name'] ?? 'Admin') ?>&background=0D8ABC&color=fff" class="rounded" width="60" alt="Avatar">
                        </div>
                    </div>

                    <button type="submit" name="update_profile" class="btn btn-primary px-4">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password Column -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header text-white py-3" style="background-color: #28a745;">
                <h6 class="m-0 font-weight-bold">Change Password</h6>
            </div>
            <div class="card-body">
                <form action="profile" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Old Password</label>
                        <input type="password" class="form-control" name="old_password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>

                    <button type="submit" name="change_password" class="btn btn-success px-4">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

