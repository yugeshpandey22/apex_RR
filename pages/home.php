<?php 
require_once '../config/db.php';

// Fetch banners
$stmt = $pdo->prepare("SELECT * FROM banners ORDER BY created_at ASC");
$stmt->execute();
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all projects for the filter grid
$stmt = $pdo->prepare("SELECT * FROM projects ORDER BY created_at DESC");
$stmt->execute();
$all_projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php'; 
?>

<!-- Hero Section with Bootstrap Carousel -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  
  <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= BASE_URL ?>assets/images/hero-1.webp" class="d-block w-100" style="height: 80vh; min-height: 500px; object-fit: cover;" alt="Premium Amenities">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="top: 0; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5);">
            <div class="text-center text-white px-3 animate-fade-up">
                <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Premium Amenities</h1>
                <p class="fs-4 mb-4 fw-light text-shadow">Everything you need, right at your doorstep</p>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <img src="<?= BASE_URL ?>assets/images/rr%20home%20banner.webp" class="d-block w-100" style="height: 80vh; min-height: 500px; object-fit: cover;" alt="The Royal">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="top: 0; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5);">
            <div class="text-center text-white px-3 animate-fade-up">
                <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">The Royal</h1>
                <p class="fs-4 mb-4 fw-light text-shadow">Experience true luxury and elegance</p>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <img src="<?= BASE_URL ?>assets/images/apex%20banner.webp" class="d-block w-100" style="height: 80vh; min-height: 500px; object-fit: cover;" alt="The Price Simple Project">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="top: 0; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5);">
            <div class="text-center text-white px-3 animate-fade-up">
                <h1 class="display-3 fw-bold mb-3" style="font-family: var(--font-heading); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">The Price Simple Project</h1>
                <p class="fs-4 mb-4 fw-light text-shadow">Affordable living without compromise</p>
            </div>
          </div>
        </div>
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

<!-- Premium About Us Section -->
<section class="py-5 position-relative overflow-hidden" style="background-color: #fcfcfc;">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 position-relative text-center text-lg-start">
                <!-- Decorative Badge -->
                <div class="position-absolute d-none d-lg-block" style="top: -20px; left: -20px; background: var(--primary-color); color: var(--secondary-color); font-weight: bold; padding: 10px 20px; transform: rotate(-5deg); z-index: 2; box-shadow: 2px 2px 10px rgba(0,0,0,0.1);">
                    ABOUT US
                </div>
                <!-- Circle Image Collage -->
                <div class="position-relative d-inline-block" style="width: 100%; max-width: 500px; height: 500px;">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Landscape Architecture" class="rounded-circle shadow-lg position-absolute border border-white border-4" style="width: 250px; height: 250px; object-fit: cover; top: 0; left: 0; z-index: 1;">
                    
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Apartment Exterior" class="rounded-circle shadow-lg position-absolute border border-white border-4" style="width: 300px; height: 300px; object-fit: cover; bottom: 0; right: 0; z-index: 2;">
                    
                    <img src="<?= BASE_URL ?>assets/images/project-1.jpg" alt="RR Homes Front View" class="rounded-circle shadow-lg position-absolute border border-white border-4" style="width: 200px; height: 200px; object-fit: cover; top: 30%; left: 30%; z-index: 3;">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 animate-fade-up">
                <h2 class="display-4 fw-bold mb-4" style="color: var(--secondary-color); font-family: var(--font-heading);">About <span class="text-warning">RR HOMES</span></h2>
                <div class="ap-divider ms-0 mb-4 bg-warning"></div>
                <p class="fs-5 text-muted mb-4" style="line-height: 1.8;">
                    RR homes offer a wide range of builder floors in Faridabad at a very reasonable cost. RR Homes works to develop residential units that are spacious, appealing, and rich in aesthetics. We ensure to provide age-proof homes through the best construction material, latest construction techniques, and a dedicated after-sales team.
                </p>
                <a href="about" class="btn btn-dark fw-bold px-5 py-3 shadow hover-lift">Read More About Us</a>
            </div>
        </div>
    </div>
<!-- Real Estate Presence Section -->
<section class="py-5 bg-dark text-white position-relative">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 animate-fade-up">
                <div class="badge bg-warning text-dark mb-3 px-3 py-2 fs-6 shadow-sm">TRUSTED BY 20,000+ FAMILIES</div>
                <h2 class="display-4 fw-bold mb-4" style="font-family: var(--font-heading);">Discover Our Prime <br><span class="text-warning">Real Estate Presence</span></h2>
                <p class="fs-5 fw-light mb-5" style="line-height: 1.8; color: #ccc;">
                    Explore our vast portfolio of world-class residential and commercial spaces. RR Homes strategically develops properties in elite locations, ensuring unmatched connectivity, serene environments, and ultra-modern luxury for generations to come.
                </p>
                
                <div class="row g-4 text-center text-lg-start mb-5">
                    <div class="col-6">
                        <div class="p-3 border border-secondary rounded">
                            <h3 class="display-5 fw-bold text-warning mb-0">25+</h3>
                            <p class="mb-0 text-light">Premium Projects</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border border-secondary rounded">
                            <h3 class="display-5 fw-bold text-warning mb-0">10M+</h3>
                            <p class="mb-0 text-light">Sq.Ft. Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 animate-fade-up" style="animation-delay: 0.2s;">
                <div class="ncr-map-container bg-dark border border-secondary p-3 shadow-lg position-relative overflow-hidden" style="aspect-ratio: 1.5/1; border-radius: 12px;">
                    <!-- Base Dotted Map Image (Using a public transparent dotted map SVG as placeholder) -->
                    <div class="w-100 h-100 position-absolute top-0 start-0" style="background-image: radial-gradient(#6c757d 2px, transparent 2px); background-size: 20px 20px; opacity: 0.3; mask-image: linear-gradient(to bottom, transparent, white 10%, white 90%, transparent); -webkit-mask-image: linear-gradient(to bottom, transparent, white 10%, white 90%, transparent);"></div>
                    
                    <!-- Animated SVG overlay -->
                    <svg viewBox="0 0 800 400" class="position-absolute top-0 start-0 w-100 h-100" preserveAspectRatio="xMidYMid meet">
                        <defs>
                            <linearGradient id="path-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="rgba(255,193,7,0)" />
                                <stop offset="5%" stop-color="#ffc107" />
                                <stop offset="95%" stop-color="#ffc107" />
                                <stop offset="100%" stop-color="rgba(255,193,7,0)" />
                            </linearGradient>
                            
                            <filter id="glow">
                                <feMorphology operator="dilate" radius="0.5" />
                                <feGaussianBlur stdDeviation="1" result="coloredBlur" />
                                <feMerge>
                                    <feMergeNode in="coloredBlur" />
                                    <feMergeNode in="SourceGraphic" />
                                </feMerge>
                            </filter>
                        </defs>

                        <!-- Path 1 (Delhi to Faridabad) -->
                        <g>
                            <path class="animated-path" d="M 400 150 Q 450 180 550 250" fill="none" stroke="url(#path-gradient)" stroke-width="2" style="animation-delay: 0s;"></path>
                            <!-- Start Point (Delhi) -->
                            <g class="map-point">
                                <circle cx="400" cy="150" r="4" fill="#ffc107" filter="url(#glow)"></circle>
                                <circle cx="400" cy="150" r="4" fill="#ffc107" class="pulse-ring"></circle>
                                <foreignObject x="350" y="105" width="100" height="40" class="d-none d-md-block">
                                    <div class="bg-white text-dark border rounded shadow-sm text-center py-1 px-2" style="font-size: 12px; font-weight: bold;">Delhi</div>
                                </foreignObject>
                            </g>
                            <!-- End Point (Faridabad) -->
                            <g class="map-point">
                                <circle cx="550" cy="250" r="5" fill="#ffc107" filter="url(#glow)"></circle>
                                <circle cx="550" cy="250" r="5" fill="#ffc107" class="pulse-ring" style="animation-delay: 1s;"></circle>
                                <foreignObject x="500" y="270" width="100" height="40" class="d-none d-md-block">
                                    <div class="bg-white text-dark border rounded shadow-sm text-center py-1 px-2" style="font-size: 12px; font-weight: bold;">Faridabad</div>
                                </foreignObject>
                            </g>
                        </g>

                        <!-- Path 2 (Gurugram to Delhi) -->
                        <g>
                            <path class="animated-path" d="M 250 220 Q 300 180 400 150" fill="none" stroke="url(#path-gradient)" stroke-width="2" style="animation-delay: 1.5s;"></path>
                            <!-- Start Point (Gurugram) -->
                            <g class="map-point">
                                <circle cx="250" cy="220" r="4" fill="#ffc107" filter="url(#glow)"></circle>
                                <circle cx="250" cy="220" r="4" fill="#ffc107" class="pulse-ring" style="animation-delay: 2.5s;"></circle>
                                <foreignObject x="200" y="235" width="100" height="40" class="d-none d-md-block">
                                    <div class="bg-white text-dark border rounded shadow-sm text-center py-1 px-2" style="font-size: 12px; font-weight: bold;">Gurugram</div>
                                </foreignObject>
                            </g>
                        </g>
                        
                        <!-- Path 3 (Noida to Delhi) -->
                        <g>
                            <path class="animated-path" d="M 550 120 Q 480 130 400 150" fill="none" stroke="url(#path-gradient)" stroke-width="2" style="animation-delay: 3s;"></path>
                            <!-- Start Point (Noida) -->
                            <g class="map-point">
                                <circle cx="550" cy="120" r="4" fill="#ffc107" filter="url(#glow)"></circle>
                                <circle cx="550" cy="120" r="4" fill="#ffc107" class="pulse-ring" style="animation-delay: 4s;"></circle>
                                <foreignObject x="500" y="75" width="100" height="40" class="d-none d-md-block">
                                    <div class="bg-white text-dark border rounded shadow-sm text-center py-1 px-2" style="font-size: 12px; font-weight: bold;">Noida</div>
                                </foreignObject>
                            </g>
                        </g>

                    </svg>
                </div>

                <style>
                .pulse-ring {
                    animation: pulse-animation 2s ease-out infinite;
                }
                @keyframes pulse-animation {
                    0% { r: 4; opacity: 0.8; }
                    100% { r: 15; opacity: 0; }
                }
                .animated-path {
                    stroke-dasharray: 600;
                    stroke-dashoffset: 600;
                    animation: dash 4s ease-in-out infinite alternate;
                }
                @keyframes dash {
                    0% { stroke-dashoffset: 600; }
                    100% { stroke-dashoffset: 0; }
                }
                </style>
            </div>
        </div>
    </div>
</section>

<!-- Premium Specifications Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            
            <!-- Left Side: Architectural Collage Grid -->
            <div class="col-lg-6">
                <div class="row g-3 position-relative">
                    <!-- Central Badge -->
                    <div class="position-absolute top-50 start-50 translate-middle z-3 bg-white p-3 shadow-lg text-center" style="border: 2px solid var(--primary-color);">
                        <h4 class="fw-bold mb-0" style="color: var(--secondary-color); letter-spacing: 2px;">SPECIFICATIONS</h4>
                    </div>
                    
                    <div class="col-6"><img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Interior" class="img-fluid rounded shadow-sm w-100" style="height: 200px; object-fit: cover;"></div>
                    <div class="col-6"><img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Kitchen" class="img-fluid rounded shadow-sm w-100" style="height: 200px; object-fit: cover;"></div>
                    <div class="col-6"><img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Switches" class="img-fluid rounded shadow-sm w-100" style="height: 200px; object-fit: cover;"></div>
                    <div class="col-6"><img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Materials" class="img-fluid rounded shadow-sm w-100" style="height: 200px; object-fit: cover;"></div>
                </div>
            </div>
            
            <!-- Right Side: Details List -->
            <div class="col-lg-6 ps-lg-5 animate-fade-up">
                <h2 class="display-5 fw-bold mb-4" style="color: var(--secondary-color); font-family: var(--font-heading);">Unmatched <span class="text-warning">Quality Standards</span></h2>
                <ul class="list-unstyled">
                    <li class="mb-4 d-flex">
                        <i class="fa-solid fa-check-circle text-warning fs-4 me-3 mt-1"></i>
                        <span class="fs-5 text-muted"><strong>Earthquake Resistant</strong> RCC Frame Structure. Tested by Qualified Architects & Engineers.</span>
                    </li>
                    <li class="mb-4 d-flex">
                        <i class="fa-solid fa-check-circle text-warning fs-4 me-3 mt-1"></i>
                        <span class="fs-5 text-muted"><strong>FLOORING</strong> – Premium Vitrified Tiles (32”X64”).</span>
                    </li>
                    <li class="mb-4 d-flex">
                        <i class="fa-solid fa-check-circle text-warning fs-4 me-3 mt-1"></i>
                        <span class="fs-5 text-muted"><strong>Kitchen Counter</strong> – Pre-Polished Granite Platform with Two Stainless Steel Sinks.</span>
                    </li>
                    <li class="mb-4 d-flex">
                        <i class="fa-solid fa-check-circle text-warning fs-4 me-3 mt-1"></i>
                        <span class="fs-5 text-muted"><strong>Wire & Switches</strong> – Copper Concealed Wires (ISI MARK) in All Rooms.</span>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
</section>

<!-- Properties Filter Grid -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5 animate-fade-up">
            <h2 class="display-4 fw-bold mb-3" style="color: var(--secondary-color); font-family: var(--font-heading);">Explore Our Exclusive Real Estate Deals</h2>
            <p class="fs-5 text-muted max-w-75 mx-auto">Handpicked, verified, and budget-friendly premium properties. Use our filters to find your perfect match.</p>
        </div>

        <!-- Filter Tabs -->
        <ul class="nav nav-pills justify-content-center mb-5" id="propertyTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold px-4 py-2 mx-1 shadow-sm" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-pane" type="button" role="tab" aria-controls="all-pane" aria-selected="true" title="View our entire inventory of exclusive deals.">All Properties</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2 mx-1 shadow-sm" id="residential-tab" data-bs-toggle="tab" data-bs-target="#residential-pane" type="button" role="tab" aria-controls="residential-pane" aria-selected="false" title="Dream homes, apartments, and villas tailored for family living.">Residential</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2 mx-1 shadow-sm" id="commercial-tab" data-bs-toggle="tab" data-bs-target="#commercial-pane" type="button" role="tab" aria-controls="commercial-pane" aria-selected="false" title="High-return office spaces, retail shops, and commercial land.">Commercial</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2 mx-1 shadow-sm" id="plots-tab" data-bs-toggle="tab" data-bs-target="#plots-pane" type="button" role="tab" aria-controls="plots-pane" aria-selected="false" title="Legally verified plots with high appreciation potential.">Plots/Land</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="propertyTabsContent">
            
            <?php 
            // Group projects by category
            $categories = ['all' => $all_projects, 'residential' => [], 'commercial' => [], 'plots' => []];
            foreach ($all_projects as $p) {
                if ($p['category'] === 'rr_home') {
                    $categories['residential'][] = $p;
                } elseif ($p['category'] === 'apex') {
                    $categories['commercial'][] = $p;
                }
                // Assuming no plots currently in DB, they would go to 'plots' array
            }
            $tags = ['Exclusive Deal', 'Best Seller', 'Price Dropped', 'Hot Property'];
            ?>

            <?php foreach ($categories as $catKey => $catProjects): ?>
            <div class="tab-pane fade <?= $catKey === 'all' ? 'show active' : '' ?>" id="<?= $catKey ?>-pane" role="tabpanel" aria-labelledby="<?= $catKey ?>-tab" tabindex="0">
                <div class="row g-4 justify-content-center">
                    <?php if (count($catProjects) > 0): ?>
                        <?php foreach ($catProjects as $index => $proj): 
                            $stmt_img = $pdo->prepare("SELECT file_path FROM project_media WHERE project_id = ? LIMIT 1");
                            $stmt_img->execute([$proj['id']]);
                            $img = $stmt_img->fetchColumn();
                            $t = strtolower($proj['title']);
                            if (!$img) {
                                if (strpos($t, 'royal') !== false) {
                                    $img_src = BASE_URL . "assets/images/rr%20home%20banner.webp";
                                } elseif (strpos($t, 'prince') !== false || strpos($t, 'price') !== false) {
                                    $img_src = BASE_URL . "assets/images/hero-1.webp";
                                } elseif (strpos($t, 'simple') !== false) {
                                    $img_src = BASE_URL . "assets/images/apex%20banner.webp";
                                } else {
                                    $fallback_images = ["assets/images/project-1.jpg", "assets/images/project-2.jpg", "assets/images/project-3.jpg"];
                                    $img_src = BASE_URL . $fallback_images[$index % count($fallback_images)];
                                }
                            } else {
                                $img_src = BASE_URL . $img;
                            }
                            $randomTag = $tags[$index % count($tags)];
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0 project-card hover-lift position-relative">
                                <!-- Property Tag -->
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 p-2 fs-6 shadow-sm z-1"><?= $randomTag ?></span>
                                
                                <img src="<?= htmlspecialchars($img_src) ?>" class="card-img-top object-fit-cover" alt="<?= htmlspecialchars($proj['title']) ?>" style="height: 250px;">
                                <div class="card-body p-4 text-center">
                                    <h3 class="card-title h4 fw-bold mb-3 text-truncate"><?= htmlspecialchars($proj['title']) ?></h3>
                                    <p class="card-text text-muted mb-4"><?= htmlspecialchars(substr($proj['short_description'], 0, 80)) ?>...</p>
                                    <a href="project-details?id=<?= $proj['id'] ?>" class="btn btn-warning text-dark w-100 fw-semibold py-2 shadow">View Deal</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <h4 class="text-muted">No properties found in this category yet.</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            
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
