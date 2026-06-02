<footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center mb-4">
                    <a href="<?= BASE_URL ?>pages/rr-home-project.php" class="bg-white p-3 rounded-3 shadow d-inline-block">
                        <img src="<?= BASE_URL ?>assets/images/rr-home-logo.png" alt="RR Home" style="max-height: 55px; width: auto; object-fit: contain;">
                    </a>
                </div>
                <ul class="list-unstyled text-secondary mt-3">
                    <li class="mb-4 d-flex align-items-start hover-warning transition-all">
                        <div class="text-warning mt-1 me-3"><i class="fa-solid fa-location-dot fs-5"></i></div>
                        <span><strong class="text-white fw-semibold fs-5">RR Homes, Puri VIP Floors</strong><br>Sector 81, Faridabad,<br>Haryana 121007</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center hover-warning transition-all">
                        <div class="text-warning me-3"><i class="fa-solid fa-phone fs-5"></i></div>
                        <a href="tel:+919971199138" class="text-secondary text-decoration-none hover-warning fs-5">+91 99711 99138</a>
                    </li>
                    <li class="mb-4 d-flex align-items-center hover-warning transition-all">
                        <div class="text-warning me-3"><i class="fa-solid fa-envelope fs-5"></i></div>
                        <a href="mailto:info@rrhomes.com" class="text-secondary text-decoration-none hover-warning">info@rrhomes.com</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0 ps-lg-5">
                <h4 class="text-white mb-4 fs-5 fw-bold position-relative pb-2" style="border-bottom: 2px solid #ffc107; display: inline-block;">Quick Links</h4>
                <ul class="list-unstyled mb-5">
                    <li class="mb-3"><a href="<?= BASE_URL ?>pages/home.php" class="text-secondary text-decoration-none hover-warning transition-all d-flex align-items-center"><i class="fa-solid fa-angle-right me-2 text-warning fs-6"></i>Home</a></li>
                    <li class="mb-3"><a href="<?= BASE_URL ?>pages/about.php" class="text-secondary text-decoration-none hover-warning transition-all d-flex align-items-center"><i class="fa-solid fa-angle-right me-2 text-warning fs-6"></i>About Us</a></li>
                    <li class="mb-3"><a href="<?= BASE_URL ?>pages/projects.php" class="text-secondary text-decoration-none hover-warning transition-all d-flex align-items-center"><i class="fa-solid fa-angle-right me-2 text-warning fs-6"></i>Projects</a></li>
                    <li class="mb-3"><a href="<?= BASE_URL ?>pages/contact.php" class="text-secondary text-decoration-none hover-warning transition-all d-flex align-items-center"><i class="fa-solid fa-angle-right me-2 text-warning fs-6"></i>Contact Us</a></li>
                </ul>

            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="d-flex align-items-center mb-4">
                    <a href="<?= BASE_URL ?>pages/apex-project.php" class="bg-white p-3 rounded-3 shadow d-inline-block">
                        <img src="<?= BASE_URL ?>assets/images/apex_logo.png" alt="Apex" style="max-height: 55px; width: auto; object-fit: contain;">
                    </a>
                </div>
                <ul class="list-unstyled text-secondary mt-3">
                    <li class="mb-4 d-flex align-items-start hover-warning transition-all">
                        <div class="text-warning mt-1 me-3"><i class="fa-solid fa-building fs-5"></i></div> 
                        <span><strong class="text-white fw-semibold fs-5">Ultra Luxury 3 BHK Apartments</strong><br>Sector 83, Faridabad</span>
                    </li>
                    <li class="mb-4 d-flex align-items-start hover-warning transition-all">
                        <div class="text-warning mt-1 me-3"><i class="fa-solid fa-phone fs-5"></i></div> 
                        <div>
                            <a href="tel:+919899143065" class="text-secondary text-decoration-none hover-warning d-block fs-5 mb-1">+91 98991 43065</a>
                            <a href="tel:+919971199138" class="text-secondary text-decoration-none hover-warning d-block fs-5">+91 99711 99138</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="row mt-5 pt-4 border-top border-secondary">
            <div class="col-md-6 text-center text-md-start text-secondary mb-3 mb-md-0">
                <p class="mb-0">&copy; <?php echo date("Y"); ?> RR Homes. All Rights Reserved. | Designed by Mineib</p>
            </div>
            <div class="col-md-6 text-center text-md-end text-secondary">
                <a href="#" class="text-secondary text-decoration-none hover-warning me-3">Privacy Policy</a>
                <a href="#" class="text-secondary text-decoration-none hover-warning">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/919971199138" class="whatsapp-float d-flex align-items-center justify-content-center shadow-lg hover-lift" target="_blank" style="position: fixed; width: 60px; height: 60px; bottom: 40px; right: 40px; background-color: #25d366; color: #FFF; border-radius: 50px; text-align: center; font-size: 35px; z-index: 9999; text-decoration: none;">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<?php include __DIR__ . '/scripts.php'; ?>
</body>
</html>



