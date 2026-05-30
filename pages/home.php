<?php 
require_once '../config/db.php';

// Fetch banners
$stmt = $pdo->prepare("SELECT * FROM banners ORDER BY created_at ASC");
$stmt->execute();
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php'; 
?>

<!-- Hero Section with Bootstrap Carousel -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-indicators">
    <?php if (count($banners) > 0): ?>
      <?php foreach ($banners as $index => $banner): ?>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
      <?php endforeach; ?>
    <?php else: ?>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <?php endif; ?>
  </div>
  
  <div class="carousel-inner">
    <?php if (count($banners) > 0): ?>
      <?php foreach ($banners as $index => $banner): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
          <?php if (!empty($banner['link_url'])): ?>
          <a href="<?= htmlspecialchars($banner['link_url']) ?>" class="d-block w-100 text-decoration-none">
          <?php endif; ?>
          
          <img src="/apex/<?= htmlspecialchars($banner['image_path']) ?>" class="d-block w-100" style="height: 80vh; min-height: 500px; object-fit: fill;" alt="Hero Banner">

          <?php if (!empty($banner['title']) || !empty($banner['subtitle'])): ?>
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="top: 0; bottom: 0; left: 0; right: 0;">
              <div class="text-center text-white px-3 animate-fade-up">
                  <?php if (!empty($banner['title'])): ?>
                      <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading); text-shadow: 2px 2px 8px rgba(0,0,0,0.8);"><?= htmlspecialchars($banner['title']) ?></h1>
                  <?php endif; ?>
                  <?php if (!empty($banner['subtitle'])): ?>
                      <p class="fs-4 mb-4 fw-light" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);"><?= htmlspecialchars($banner['subtitle']) ?></p>
                  <?php endif; ?>
              </div>
          </div>
          <?php endif; ?>

          <?php if (!empty($banner['link_url'])): ?>
          </a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
        <!-- Fallback if no banners are uploaded -->
        <div class="carousel-item active">
          <div class="d-flex align-items-center justify-content-center" style="height: 80vh; min-height: 500px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/images/projects-hero.jpg') center/cover no-repeat;">
            <div class="text-center text-white px-3 animate-fade-up">
                <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Premium Amenities</h1>
                <p class="fs-4 mb-4 fw-light text-shadow">Everything you need, right at your doorstep</p>
            </div>
          </div>
        </div>
    <?php endif; ?>
  </div>
  
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- About Section Summary -->
<section class="py-5 bg-light">
    <div class="container text-center py-5">
        <h2 class="display-5 fw-bold mb-4" style="color: var(--secondary-color); font-family: var(--font-heading);">Welcome to Our Premium Real Estate</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                <p class="fs-5 text-muted mb-4" style="line-height: 1.8;">
                    We are a premier real estate construction and consultancy company based in Faridabad, Delhi NCR. We specialize in delivering high-quality residential homes and premium builder floors tailored to your modern lifestyle.
                </p>
                <a href="about.php" class="btn btn-outline-warning fw-semibold px-4 py-2">Read More About Us</a>
            </div>
        </div>
    </div>
</section>


<!-- Testimonials Grid -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <h2 class="display-5 fw-bold text-center mb-5" style="color: var(--secondary-color); font-family: var(--font-heading);">What Our Clients Are Saying</h2>
        
        <div class="row g-4">
        <?php
        // Define the cards as PHP strings
        $testimonialCards = [
            '
            <div class="card h-100 shadow-sm border-0 hover-lift" style="border-radius: 1rem; overflow: hidden;">
                <img src="/apex/assets/images/project-1.jpg" class="card-img-top" alt="Project" style="height: 200px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="card-text text-muted fst-italic mb-4 flex-grow-1">"The team helped us find our absolute dream home in Sector 84. The transparency and support were unmatched."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="50" height="50" alt="Avatar" style="object-fit: cover; border: 2px solid var(--primary-color);">
                        <div>
                            <h6 class="mb-0 fw-bold">Rajesh Kumar</h6>
                            <small class="text-muted">Homeowner</small>
                        </div>
                    </div>
                </div>
            </div>
            ',
            '
            <div class="card h-100 shadow-sm border-0 hover-lift" style="border-radius: 1rem; overflow: hidden;">
                <img src="/apex/assets/images/project-3.jpg" class="card-img-top" alt="Project" style="height: 200px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="card-text text-muted fst-italic mb-4 flex-grow-1">"The luxury and attention to detail in BP Homes Barleria is breathtaking. Best decision of our lives."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" height="50" alt="Avatar" style="object-fit: cover; border: 2px solid var(--primary-color);">
                        <div>
                            <h6 class="mb-0 fw-bold">Anjali Sharma</h6>
                            <small class="text-muted">Investor</small>
                        </div>
                    </div>
                </div>
            </div>
            ',
            '
            <div class="card h-100 shadow-sm border-0 hover-lift" style="border-radius: 1rem; overflow: hidden;">
                <img src="/apex/assets/images/project-2.jpg" class="card-img-top" alt="Project" style="height: 200px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <p class="card-text text-muted fst-italic mb-4 flex-grow-1">"Smooth paperwork, zero hidden fees, and absolute professionalism. Highly recommended builder floors."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="https://randomuser.me/api/portraits/men/56.jpg" class="rounded-circle me-3" width="50" height="50" alt="Avatar" style="object-fit: cover; border: 2px solid var(--primary-color);">
                        <div>
                            <h6 class="mb-0 fw-bold">Vikram Singh</h6>
                            <small class="text-muted">Homeowner</small>
                        </div>
                    </div>
                </div>
            </div>
            '
        ];

        foreach ($testimonialCards as $card) {
            echo '<div class="col-md-4 mb-4">' . $card . '</div>';
        }
        ?>
        </div>
        
    </div>
</section>

<!-- Call to Action -->
<section class="py-5" style="background-color: var(--primary-color);">
    <div class="container py-5 text-center">
        <h2 class="display-5 text-white fw-bold mb-3" style="font-family: var(--font-heading);">Ready to find your dream home?</h2>
        <p class="fs-4 text-white mb-4 fw-light">Contact our expert consultants today for personalized advice and viewing arrangements.</p>
        <button class="btn btn-light btn-lg text-warning fw-bold px-5 py-3 shadow" data-bs-toggle="modal" data-bs-target="#enquireModal">Contact Us Now</button>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
