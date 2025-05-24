 <?php
 require_once './views/layout/header.php'; // Header
 ?>
<body>
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Register</li>
            </ul>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- Register Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="login-register-form">
                <h3 class="title">Create Account</h3>
                <p>Please Register using account detail bellow.</p>
           <form method="POST" action="index.php?act=register">
    <div class="row row-cols-1 g-4">
        <div class="col"> 
            <label for="name">Họ và tên:</label><br>
            <input class="form-field" type="text" id="name" name="name" required placeholder="Nhập họ tên">
        </div>

        <div class="col">
            <label for="email">Email:</label><br>
            <input class="form-field" type="email" id="email" name="email" required placeholder="Nhập email">
        </div>

        <div class="col">
            <label for="password">Mật khẩu:</label><br>
            <input class="form-field" type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
        </div>

        <div class="col">
            <label for="confirm_password">Nhập lại mật khẩu:</label><br>
            <input class="form-field" type="password" id="confirm_password" name="confirm_password" required placeholder="Nhập lại mật khẩu">
        </div>

        <div class="col">
            <label for="phone">Số điện thoại:</label><br>
            <input class="form-field" type="text" id="phone" name="phone" required placeholder="Nhập số điện thoại">
        </div>

        <div class="col">
            <label for="address">Địa chỉ:</label><br>
            <input class="form-field" type="text" id="address" name="address" required placeholder="Nhập địa chỉ">
        </div>

        <div class="col">
            <input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Đăng ký">
        </div>

        <div class="col">
            Đã có tài khoản? <a href="login.html"><b>Đăng nhập</b></a>
        </div>
    </div>
</form>

            </div>
        </div>
    </div>
    <!-- Register Section End -->

    <!-- Footer Section Start -->
    <div class="footer-section section">
        <!-- Footer Top Section Start -->
        <div class="footer-top section">
            <div class="container">
                <div class="row mb-n8 gy-lg-0 gy-4">

                    <!-- Footer Widget Start -->
                    <div class="col-lg-4 col-sm-6 col-12 mb-8">
                        <div class="footer-widget footer-widget-dark">
                            <h5 class="footer-widget-title">About Info</h5>
                            <p>This is the perfect place to find a nice and cozy spot to sip some. You'll find the Java Jungle.</p>
                            <ul class="footer-widget-list-icon">
                                <li><i class="sli-location-pin"></i>Addresss: 123 Pall Mall, London England</li>
                                <li><i class="sli-envelope"></i>Email: hello@example.com</li>
                                <li><i class="sli-phone"></i>Phone: (012) 345 6789</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                    <!-- Footer Widget Start -->
                    <div class="col-lg-3 col-sm-6 col-12 mb-8">
                        <div class="footer-widget footer-widget-dark">
                            <h5 class="footer-widget-title">Information</h5>
                            <ul class="footer-widget-list">
                                <li><a href="#">Returns Policy</a></li>
                                <li><a href="#">Support Policy</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                    <!-- Footer Widget Start -->
                    <div class="col-lg-3 col-sm-6 col-12 mb-8">
                        <div class="footer-widget footer-widget-dark">
                            <h5 class="footer-widget-title">Quick Links</h5>
                            <ul class="footer-widget-list">
                                <li><a href="about-us.html">About us</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                    <!-- Footer Widget Start -->
                    <div class="col-lg-2 col-sm-6 col-12 mb-8">
                        <div class="footer-widget footer-widget-dark">
                            <h5 class="footer-widget-title">Follow Us On</h5>
                            <ul class="footer-widget-list-icon">
                                <li><a href="#"><i class="sli-social-facebook"></i>Facebook</a></li>
                                <li><a href="#"><i class="sli-social-twitter"></i>Twitter</a></li>
                                <li><a href="#"><i class="sli-social-instagram"></i>Instagram</a></li>
                                <li><a href="#"><i class="sli-social-youtube"></i>Youtube</a></li>
                                <li><a href="#"><i class="sli-social-pinterest"></i>Pinterest</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget End -->

                </div>
            </div>
        </div>
        <!-- Footer Top Section End -->

        <!-- Footer Bottom Section Start -->
        <div class="footer-bottom footer-bottom-dark section">
            <div class="container">
                <div class="row justify-content-between align-items-center mb-n2">

                    <!-- Footer Widget Start -->
                    <div class="col-md-auto col-12 mb-2">
                        <p class="footer-copyright footer-copyright-dark text-center">Copyright <b class="text-primary">Kofi</b> &copy;2023</p>
                    </div>
                    <!-- Footer Widget End -->

                    <!-- Footer Widget Start -->
                    <div class="col-md-auto col-12 mb-2">
                        <div class="footer-payment text-center"><img loading="lazy" src="assets/images/footer/footer-payment.png" alt="footer payment" width="342" height="30"></div>
                    </div>
                    <!-- Footer Widget End -->

                </div>
            </div>
        </div>
        <!-- Footer Bottom Section End -->

    </div>
    <!-- Footer Section End -->

    <button class="scroll-to-top"><i class="sli-arrow-up"></i></button>

    <!-- JS Vendor, Plugins & Activation Script Files -->

    <!-- Vendors JS -->
    <script src="assets/js/vendor/modernizr-3.11.7.min.js"></script>
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Plugins JS -->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/svg-inject.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/resize-sensor.js"></script>
    <script src="assets/js/plugins/jquery.sticky-sidebar.min.js"></script>

    <!-- Activation JS -->
    <script src="assets/js/active.js"></script>

</body>