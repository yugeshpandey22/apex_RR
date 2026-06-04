<?php include '../includes/header.php'; ?>

<?php
$stmt = $pdo->prepare("SELECT * FROM page_banners WHERE page_name = 'about'");
$stmt->execute();
$page_banner = $stmt->fetch(PDO::FETCH_ASSOC);

$banner_desktop_raw = $page_banner && !empty($page_banner['desktop_image']) ? BASE_URL . $page_banner['desktop_image'] : BASE_URL . 'assets/images/projects-hero.webp';
$banner_desktop = str_replace(' ', '%20', $banner_desktop_raw);

$banner_mobile_raw = $page_banner && !empty($page_banner['mobile_image']) ? BASE_URL . $page_banner['mobile_image'] : null;
$banner_mobile = $banner_mobile_raw ? str_replace(' ', '%20', $banner_mobile_raw) : null;

$banner_title = $page_banner && !empty($page_banner['title']) ? $page_banner['title'] : 'About Us';
$banner_subtitle = $page_banner && !empty($page_banner['subtitle']) ? $page_banner['subtitle'] : 'Building Trust, Delivering Excellence';
?>
<style>
.project-page-banner {
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: center;
    display: block;
}
@media(max-width: 767px) {
    .project-page-banner {
        height: 250px !important;
    }
}
</style>
<!-- Page Hero -->
<section class="position-relative bg-dark w-100 overflow-hidden text-center">
    <?php if ($banner_mobile): ?>
        <picture>
            <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($banner_mobile) ?>">
            <img src="<?= htmlspecialchars($banner_desktop) ?>" class="project-page-banner" alt="<?= htmlspecialchars($banner_title) ?>">
        </picture>
    <?php else: ?>
        <img src="<?= htmlspecialchars($banner_desktop) ?>" class="project-page-banner" alt="<?= htmlspecialchars($banner_title) ?>">
    <?php endif; ?>
    
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-center text-white" style="background: rgba(0,0,0,0.4); pointer-events: none;">
        <div class="container animate-fade-up" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">
            <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading);"><?= htmlspecialchars($banner_title) ?></h1>
            <?php if ($banner_subtitle): ?>
                <p class="fs-4 fw-light"><?= htmlspecialchars($banner_subtitle) ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5" style="background-color: #fcfcfc;">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            
            <!-- Left Side Image Collage / Interactive Selector -->
            <div class="col-lg-6">
                <div class="interactive-selector mb-4">
                    <div class="interactive-option active" style="background-image: url('<?= BASE_URL ?>assets/images/about-img.jpg');">
                        <div class="interactive-content">
                            <div class="interactive-icon"><i class="fa-solid fa-building"></i></div>
                            <div class="interactive-text">
                                <h4>Luxury Floors</h4>
                                <p>Premium Living</p>
                            </div>
                        </div>
                    </div>
                    <div class="interactive-option" style="background-image: url('<?= BASE_URL ?>assets/images/hero-1.webp');">
                        <div class="interactive-content">
                            <div class="interactive-icon"><i class="fa-solid fa-handshake"></i></div>
                            <div class="interactive-text">
                                <h4>Expert Consulting</h4>
                                <p>Trusted Guidance</p>
                            </div>
                        </div>
                    </div>
                    <div class="interactive-option" style="background-image: url('<?= BASE_URL ?>assets/images/hero-1.webp');">
                        <div class="interactive-content">
                            <div class="interactive-icon"><i class="fa-solid fa-house-chimney"></i></div>
                            <div class="interactive-text">
                                <h4>Modern Architecture</h4>
                                <p>Aesthetic Designs</p>
                            </div>
                        </div>
                    </div>
                    <div class="interactive-option" style="background-image: url('<?= BASE_URL ?>assets/images/projects-hero.webp');">
                        <div class="interactive-content">
                            <div class="interactive-icon"><i class="fa-solid fa-gem"></i></div>
                            <div class="interactive-text">
                                <h4>Premium Quality</h4>
                                <p>Unmatched Standards</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="experience-badge bg-warning text-dark text-center p-3 rounded-4 shadow-lg w-100" style="position: static; transform: none; min-width: 100%;">
                    <h2 class="display-5 fw-bold mb-0">10+</h2>
                    <p class="mb-0 fw-semibold fs-6">Years of Excellence</p>
                </div>
            </div>

            <!-- Right Side Text Content -->
            <div class="col-lg-6 ps-lg-5 mt-5 mt-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <div style="width: 50px; height: 3px; background-color: var(--primary-color);" class="me-3 rounded"></div>
                    <span class="text-warning fw-bold text-uppercase tracking-wide">Who We Are</span>
                </div>
                
                <h2 class="display-4 fw-bold mb-4" style="color: var(--secondary-color); font-family: var(--font-heading); line-height: 1.2;">Redefining Real Estate in Delhi NCR</h2>
                
                <div class="border-start border-warning border-4 ps-4 mb-4 py-2" style="background: linear-gradient(90deg, rgba(212, 175, 55, 0.1) 0%, transparent 100%);">
                    <p class="fs-5 text-dark mb-0" style="font-style: italic; font-family: var(--font-heading);">
                        "Our mission is to provide transparent, hassle-free, and personalized real estate solutions."
                    </p>
                </div>
                
                <p class="fs-5 text-muted mb-4" style="line-height: 1.8;">
                    We are a leading real estate consultancy and construction firm based in Faridabad. With a decade of experience in the industry, we have established ourselves as a trusted name for finding premium builder floors and luxury residential spaces. Whether you are looking for your dream home or a lucrative investment opportunity, our team of experts is dedicated to guiding you every step of the way.
                </p>
                
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="p-4 bg-white rounded-4 shadow-sm border border-light hover-lift h-100 transition-all">
                            <div class="mb-3 d-inline-block p-3 bg-light rounded-circle text-warning">
                                <i class="fa-solid fa-handshake fs-2"></i>
                            </div>
                            <h4 class="h5 fw-bold mb-2 text-dark">Trusted Agency</h4>
                            <p class="text-muted mb-0 small">Honest & transparent real estate dealings.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 bg-white rounded-4 shadow-sm border border-light hover-lift h-100 transition-all">
                            <div class="mb-3 d-inline-block p-3 bg-light rounded-circle text-warning">
                                <i class="fa-solid fa-gem fs-2"></i>
                            </div>
                            <h4 class="h5 fw-bold mb-2 text-dark">Premium Quality</h4>
                            <p class="text-muted mb-0 small">Exclusive listings & luxury properties.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Our Mission -->
            <div class="col-lg-6">
                <div class="mission-vision-card p-5 rounded-4 shadow-sm h-100 position-relative overflow-hidden" style="border-top: 5px solid var(--primary-color); background: #fdfdfd;">
                    <i class="fa-solid fa-bullseye position-absolute" style="font-size: 15rem; color: #f8f9fa; top: -20px; right: -20px; z-index: 0; transform: rotate(-15deg);"></i>
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 70px; height: 70px; font-size: 1.8rem;">
                                <i class="fa-solid fa-rocket"></i>
                            </div>
                            <h2 class="display-6 fw-bold mb-0" style="color: var(--secondary-color); font-family: var(--font-heading);">Our Mission</h2>
                        </div>
                        <p class="fs-5 text-muted" style="line-height: 1.8;">
                            Our mission is to empower families and investors by providing honest, transparent, and expert real estate consultancy. We strive to deliver premium quality homes and builder floors that exceed expectations, creating spaces where modern lifestyles can truly thrive.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Our Vision -->
            <div class="col-lg-6">
                <div class="mission-vision-card p-5 rounded-4 shadow-sm h-100 position-relative overflow-hidden" style="border-top: 5px solid var(--secondary-color); background: #fdfdfd;">
                    <i class="fa-solid fa-eye position-absolute" style="font-size: 15rem; color: #f8f9fa; top: -20px; right: -20px; z-index: 0; transform: rotate(-15deg);"></i>
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 70px; height: 70px; font-size: 1.8rem;">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <h2 class="display-6 fw-bold mb-0" style="color: var(--secondary-color); font-family: var(--font-heading);">Our Vision</h2>
                        </div>
                        <p class="fs-5 text-muted" style="line-height: 1.8;">
                            To be the most trusted and innovative real estate brand in Delhi NCR, recognized for our uncompromising integrity, customer-centric approach, and architectural brilliance. We envision a future where finding your dream property is a seamless, joyful journey.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-dark text-white position-relative" style="background: linear-gradient(rgba(26, 26, 26, 0.92), rgba(26, 26, 26, 0.92)), url('<?= BASE_URL ?>assets/images/projects-hero.webp') center/cover fixed;">
    <div class="container py-5 text-center position-relative z-1">
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="outer-dot-card">
                    <div class="dot"></div>
                    <div class="card-content">
                        <h3 class="display-3 fw-bold text-warning mb-2"><span class="counter" data-target="500">0</span>+</h3>
                        <p class="fs-6 text-light fw-light mb-0 text-uppercase tracking-wide">Happy Families</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="outer-dot-card">
                    <div class="dot" style="animation-delay: -1s;"></div>
                    <div class="card-content">
                        <h3 class="display-3 fw-bold text-warning mb-2"><span class="counter" data-target="50">0</span>+</h3>
                        <p class="fs-6 text-light fw-light mb-0 text-uppercase tracking-wide">Projects Delivered</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="outer-dot-card">
                    <div class="dot" style="animation-delay: -2s;"></div>
                    <div class="card-content">
                        <h3 class="display-3 fw-bold text-warning mb-2"><span class="counter" data-target="15">0</span>+</h3>
                        <p class="fs-6 text-light fw-light mb-0 text-uppercase tracking-wide">Expert Agents</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="outer-dot-card">
                    <div class="dot" style="animation-delay: -3s;"></div>
                    <div class="card-content">
                        <h3 class="display-3 fw-bold text-warning mb-2"><span class="counter" data-target="100">0</span>+</h3>
                        <p class="fs-6 text-light fw-light mb-0 text-uppercase tracking-wide">Awards Won</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5 pb-4">
            <span class="text-warning fw-bold text-uppercase tracking-wide">Our Core Values</span>
            <h2 class="display-5 fw-bold mt-2 mb-4" style="color: var(--secondary-color); font-family: var(--font-heading);">Why Choose Us?</h2>
            <div style="width: 60px; height: 3px; background-color: var(--primary-color); margin: 0 auto;"></div>
        </div>
        
        <div class="row g-4">
            <!-- Value 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="value-card p-5 bg-white rounded-4 shadow border-0 h-100 text-center">
                    <div class="icon-wrapper bg-warning text-dark rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; font-size: 2.5rem;">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3" style="font-family: var(--font-heading);">Premium Quality</h3>
                    <p class="text-muted mb-0" style="line-height: 1.7;">We never compromise on the quality of construction, ensuring every home we deliver is built to perfection using the finest materials.</p>
                </div>
            </div>
            <!-- Value 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="value-card p-5 bg-white rounded-4 shadow border-0 h-100 text-center">
                    <div class="icon-wrapper bg-warning text-dark rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; font-size: 2.5rem;">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3" style="font-family: var(--font-heading);">Absolute Transparency</h3>
                    <p class="text-muted mb-0" style="line-height: 1.7;">Honesty is our policy. From pricing to legal paperwork, we maintain 100% transparency so you can invest with total peace of mind.</p>
                </div>
            </div>
            <!-- Value 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="value-card p-5 bg-white rounded-4 shadow border-0 h-100 text-center">
                    <div class="icon-wrapper bg-warning text-dark rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; font-size: 2.5rem;">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3" style="font-family: var(--font-heading);">Expert Guidance</h3>
                    <p class="text-muted mb-0" style="line-height: 1.7;">Our seasoned real estate professionals provide tailored advice to help you make informed decisions in the ever-changing property market.</p>
                </div>
            </div>
        </div>
    </div>

<!-- Call To Action -->
<section class="py-5" style="background-color: var(--primary-color);">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="display-6 fw-bold text-white mb-2" style="font-family: var(--font-heading);">Ready to find your perfect property?</h2>
                <p class="fs-5 text-white fw-light mb-0">Our experts are waiting to guide you home.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="contact" class="btn btn-dark btn-lg px-5 py-3 fw-bold text-warning shadow-lg hover-lift">Contact Us Today</a>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>


