        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-none d-md-block">
            <div class="admin-logo">
                <i class="fa-solid fa-building fa-3x" style="color: #6c757d;"></i>
            </div>
            
            <?php
            require_once __DIR__ . '/../../config/db.php';
            try {
                $stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'admin_name'");
                $admin_name = $stmt->fetchColumn();
                if (!$admin_name) $admin_name = 'Admin';
            } catch (Exception $e) {
                $admin_name = 'Admin';
            }
            ?>
            <div class="user-info text-center mb-4 mt-3">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($admin_name) ?>&background=0D8ABC&color=fff" class="rounded-circle mb-2 shadow-sm" width="60" alt="<?= htmlspecialchars($admin_name) ?>">
                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($admin_name) ?></h6>
                <small class="text-muted">Administrator</small>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-bs-toggle="collapse" data-bs-target="#projectsMenu" aria-expanded="true">
                        <i class="fa-solid fa-building"></i> Projects
                    </a>
                    <div class="collapse show" id="projectsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="projects.php?category=rr_home"><i class="fa-solid fa-minus"></i> RR Home Project</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="projects.php?category=apex"><i class="fa-solid fa-minus"></i> Apex Project</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="add_project.php"><i class="fa-solid fa-plus text-success"></i> Add Project</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#settingsMenu" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                    <div class="collapse" id="settingsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="settings.php"><i class="fa-solid fa-minus"></i> General Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php"><i class="fa-solid fa-minus"></i> Profile</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#enquiriesMenu" aria-expanded="false">
                        <i class="fa-solid fa-envelope"></i> Enquiries
                    </a>
                    <div class="collapse" id="enquiriesMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="enquiries.php"><i class="fa-solid fa-minus"></i> Manage Enquiries</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="banners.php">
                        <i class="fa-solid fa-images"></i> Manage Banners
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link text-danger" href="logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 main-content">
            <div class="top-header rounded d-flex justify-content-center">
                <span class="badge bg-success py-2 px-4" style="font-size: 1rem;">WELCOME TO RRHOMES ADMIN DASHBOARD</span>
            </div>
