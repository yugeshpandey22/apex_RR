<?php
$current_page = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . '/../config/db.php';

// Fetch projects for header dropdowns
$stmt_rr = $pdo->prepare("SELECT id, title FROM projects WHERE category = 'rr_home' ORDER BY created_at DESC");
$stmt_rr->execute();
$rr_projects = $stmt_rr->fetchAll(PDO::FETCH_ASSOC);

$stmt_apex = $pdo->prepare("SELECT id, title FROM projects WHERE category = 'apex' ORDER BY created_at DESC");
$stmt_apex->execute();
$apex_projects = $stmt_apex->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/head.php'; ?>
</head>
<body>

<!-- Top Bar -->
<div class="bg-dark text-white py-2 d-none d-lg-block" style="font-size: 0.85rem;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-start">
                <span class="me-3"><i class="fa-solid fa-location-dot text-warning"></i> Sector 81, Faridabad, Haryana 121007</span>
            </div>
            <div class="col-md-6 text-end">
                <span class="me-3"><i class="fa-solid fa-envelope text-warning"></i> <a href="mailto:info@rrhomes.com" class="text-white text-decoration-none">info@rrhomes.com</a></span>
                <span><i class="fa-solid fa-phone text-warning"></i> <a href="tel:+919971199138" class="text-white text-decoration-none">+91 99711 99138</a></span>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
    <div class="container">
        <div class="d-flex align-items-center">
            <a class="navbar-brand d-flex align-items-center me-2" href="<?= BASE_URL ?>pages/rr-home-project.php">
                <img src="<?= BASE_URL ?>assets/images/rr-home-logo.png" alt="RR Home" style="max-height: 70px; width: auto; object-fit: contain;" class="mobile-logo-main">
            </a>
            <a class="navbar-brand d-flex align-items-center d-lg-none" href="<?= BASE_URL ?>pages/apex-project.php">
                <img src="<?= BASE_URL ?>assets/images/apex_logo.png" alt="Apex" style="max-height: 50px; width: auto; object-fit: contain;">
            </a>
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
                <li class="nav-item">
                    <a class="nav-link fw-semibold <?php echo $current_page == 'home.php' ? 'active text-warning' : ''; ?>" href="<?= BASE_URL ?>pages/home.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold <?php echo $current_page == 'about.php' ? 'active text-warning' : ''; ?>" href="<?= BASE_URL ?>pages/about.php">ABOUT US</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold <?php echo ($current_page == 'project-details.php') ? 'active text-warning' : ''; ?>" href="#" id="rrHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        RR HOME PROJECT
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark shadow border-0 mt-2" aria-labelledby="rrHomeDropdown" style="background-color: #343a40;">
                        <?php if (count($rr_projects) > 0): ?>
                            <?php foreach ($rr_projects as $proj): ?>
                                <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>pages/project-details.php?id=<?= $proj['id'] ?>"><?= htmlspecialchars($proj['title']) ?></a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><span class="dropdown-item py-2 text-muted">No projects yet</span></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold <?php echo ($current_page == 'project-details.php') ? 'active text-warning' : ''; ?>" href="#" id="apexDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        APEX PROJECT
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark shadow border-0 mt-2" aria-labelledby="apexDropdown" style="background-color: #343a40;">
                        <?php if (count($apex_projects) > 0): ?>
                            <?php foreach ($apex_projects as $proj): ?>
                                <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>pages/project-details.php?id=<?= $proj['id'] ?>"><?= htmlspecialchars($proj['title']) ?></a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><span class="dropdown-item py-2 text-muted">No projects yet</span></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold <?php echo $current_page == 'contact.php' ? 'active text-warning' : ''; ?>" href="<?= BASE_URL ?>pages/contact.php">CONTACT US</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-4">
                <a href="<?= BASE_URL ?>pages/apex-project.php" class="d-none d-lg-block">
                    <img src="<?= BASE_URL ?>assets/images/apex_logo.png" alt="Apex" style="max-height: 95px; width: auto; object-fit: contain;">
                </a>
                <button class="btn btn-warning text-white fw-semibold px-4" data-bs-toggle="modal" data-bs-target="#enquireModal">Enquire Now</button>
            </div>
        </div>
    </div>
</nav>

<!-- Bootstrap Modal for Enquiry -->
<div class="modal fade" id="enquireModal" tabindex="-1" aria-labelledby="enquireModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold fs-4" id="enquireModalLabel">Quick Enquiry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted mb-4">Leave your details and we will get back to you shortly.</p>
        <form action="send-enquiry.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control p-3" placeholder="Your Full Name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control p-3" placeholder="Your Email Address" required>
            </div>
            <div class="mb-3">
                <input type="tel" class="form-control p-3" placeholder="Your Phone Number" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control p-3" placeholder="I am interested in..." rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-warning text-white w-100 py-3 fw-bold">Submit Enquiry</button>
        </form>
      </div>
    </div>
  </div>
</div>
