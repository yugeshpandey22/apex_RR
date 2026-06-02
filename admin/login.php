<?php
session_start();

// Hardcoded credentials for simplicity
$USERNAME = 'admin';
$PASSWORD = 'admin123';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    
    if ($user === $USERNAME && $pass === $PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Apex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #f4f7f6; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { max-width: 400px; width: 100%; padding: 2rem; border-radius: 1rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; }
        .login-header { text-align: center; margin-bottom: 2rem; }
    </style>
</head>
<body>

<div class="card login-card bg-white">
    <div class="login-header">
        <h2 class="fw-bold text-dark mb-0">Apex Admin</h2>
        <p class="text-muted">Sign in to manage your website</p>
    </div>
    
    <?php if ($error): ?>
        <div class="alert alert-danger py-2"><i class="fa-solid fa-circle-exclamation me-1"></i> <?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label fw-bold">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-user text-muted"></i></span>
                <input type="text" name="username" class="form-control border-start-0 bg-light" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0 bg-light" required>
            </div>
        </div>
        <button type="submit" class="btn btn-warning w-100 py-2 fw-bold text-dark fs-5 shadow-sm">Login</button>
    </form>
    
    <div class="text-center mt-4">
        <a href="<?= BASE_URL ?>" class="text-muted text-decoration-none small"><i class="fa-solid fa-arrow-left me-1"></i> Back to Website</a>
    </div>
</div>

</body>
</html>


