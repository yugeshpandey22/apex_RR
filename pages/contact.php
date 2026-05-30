<?php include '../includes/header.php'; ?>

<!-- Page Header -->
<section class="w-100 p-0 m-0 text-center">
    <img src="/apex/assets/images/contact%20banner.webp" alt="Contact Us" class="img-fluid w-100 d-block" style="aspect-ratio: 1894 / 620; max-height: 620px; object-fit: cover; object-position: center;">
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="bg-light p-5 rounded-3 h-100 shadow-sm border-0">
                    <h2 class="h3 fw-bold mb-4" style="color: var(--secondary-color);">Get In Touch</h2>
                    
                    <div class="d-flex mb-4">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Office Address</h4>
                            <p class="text-muted mb-0">RR Homes, Puri VIP Floors<br>Sector 81, Faridabad<br>Haryana 121007</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Phone Number</h4>
                            <p class="text-muted mb-0">+91 99711 99138</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="h5 fw-bold mb-1">Email Address</h4>
                            <p class="text-muted mb-0">info@rrhomes.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="bg-white p-5 rounded-3 shadow-sm border-0 h-100">
                    <h2 class="h3 fw-bold mb-4" style="color: var(--secondary-color);">Send Us a Message</h2>
                    <form action="send-enquiry.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name</label>
                                <input type="text" class="form-control p-3" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control p-3" name="email" placeholder="john@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="tel" class="form-control p-3" name="phone" placeholder="+91 xxxxx xxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control p-3" name="subject" placeholder="Property Inquiry">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Your Message</label>
                                <textarea class="form-control p-3" rows="5" name="message" placeholder="I am interested in..." required></textarea>
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
