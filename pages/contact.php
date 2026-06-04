<?php include '../includes/header.php'; ?>

<?php
$stmt = $pdo->prepare("SELECT * FROM page_banners WHERE page_name = 'contact'");
$stmt->execute();
$page_banner = $stmt->fetch(PDO::FETCH_ASSOC);

$banner_desktop = $page_banner && !empty($page_banner['desktop_image']) ? BASE_URL . $page_banner['desktop_image'] : BASE_URL . 'assets/images/contact%20banner.webp';
$banner_mobile = $page_banner && !empty($page_banner['mobile_image']) ? BASE_URL . $page_banner['mobile_image'] : null;
$banner_title = $page_banner && !empty($page_banner['title']) ? $page_banner['title'] : '';
$banner_subtitle = $page_banner && !empty($page_banner['subtitle']) ? $page_banner['subtitle'] : '';
?>
<style>
@media(max-width: 767px) {
    .project-page-banner {
        height: auto !important;
        object-fit: contain !important;
    }
}
</style>
<!-- Page Header -->
<section class="position-relative w-100 p-0 m-0 text-center overflow-hidden">
    <?php if ($banner_mobile): ?>
        <picture>
            <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($banner_mobile) ?>">
            <img src="<?= htmlspecialchars($banner_desktop) ?>" class="img-fluid w-100 d-block project-page-banner" alt="Contact Us" style="aspect-ratio: 1894 / 620; max-height: 620px; object-fit: cover; object-position: center;">
        </picture>
    <?php else: ?>
        <img src="<?= htmlspecialchars($banner_desktop) ?>" class="img-fluid w-100 d-block project-page-banner" alt="Contact Us" style="aspect-ratio: 1894 / 620; max-height: 620px; object-fit: cover; object-position: center;">
    <?php endif; ?>
    
    <?php if ($banner_title || $banner_subtitle): ?>
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-center text-white" style="background: rgba(0,0,0,0.4); pointer-events: none;">
        <div class="container animate-fade-up" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">
            <?php if ($banner_title): ?>
                <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading);"><?= htmlspecialchars($banner_title) ?></h1>
            <?php endif; ?>
            <?php if ($banner_subtitle): ?>
                <p class="fs-4 fw-light"><?= htmlspecialchars($banner_subtitle) ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5 animate-fade-up">
            <h2 class="display-4 fw-bold" style="color: var(--secondary-color); font-family: var(--font-heading);">Let’s Find Your Next Big Deal Together</h2>
            <p class="fs-5 text-muted max-w-75 mx-auto">Have a question about a property or want to list yours? Get in touch with our real estate experts today.</p>
        </div>
        
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="bg-light p-5 rounded-3 h-100 shadow-sm border-0">
                    <h2 class="h4 fw-bold mb-4" style="color: var(--secondary-color);">Contact Information</h2>
                    
                    <div class="d-flex mb-4">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Call Us / WhatsApp</h4>
                            <a href="tel:+919971199138" class="text-muted text-decoration-none">+91 99711 99138</a>
                            <p class="small text-muted mb-0">Talk to our property advisor instantly</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Email Us</h4>
                            <a href="mailto:info@rrhomes.com" class="text-muted text-decoration-none">info@rrhomes.com</a>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Visit Our Office</h4>
                            <p class="text-muted mb-0">RR Homes, Puri VIP Floors<br>Sector 81, Faridabad<br>Haryana 121007</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Business Hours</h4>
                            <p class="text-muted mb-0">Monday to Saturday: 10:00 AM - 7:00 PM</p>
                            <p class="small text-danger mb-0 fw-semibold">Sunday Closed</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="bg-white p-5 rounded-3 shadow-sm border-0 h-100">
                    <h2 class="h3 fw-bold mb-4" style="color: var(--secondary-color);">Send Us a Message</h2>
                    <form action="send-enquiry" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control p-3" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control py-3 pe-3" name="phone" placeholder="xxxxx xxxxx" pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" title="Please enter exactly 10 digits" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control p-3" name="email" placeholder="john@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Property Type Interest</label>
                                <select class="form-select p-3" name="property_type">
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Plots">Plots</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Your Message</label>
                                <textarea class="form-control p-3" rows="5" name="message" placeholder="I am looking for a 2 BHK in my budget..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-warning text-white btn-lg fw-bold px-5 py-3">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>



