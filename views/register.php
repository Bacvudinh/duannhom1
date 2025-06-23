<?php require_once './views/layout/header.php'; // Header ?>
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

<!-- Custom CSS -->
<style>
    .btn-register {
        background: linear-gradient(135deg,hsl(60, 70.20%, 44.70%),rgb(224, 238, 74));
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        width: 100%;
        font-weight: bold;
        font-size: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #218838, #1e7e34);
        transform: scale(1.02);
    }

    .form-field {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
    }

    .form-field:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, 0.25);
        outline: none;
    }

    .login-register-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .login-register-form h3.title {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .login-register-form p {
        color: #6c757d;
    }
</style>

<!-- Register Section Start -->
<div class="section section-padding">
    <div class="container">
        <div class="login-register-form">
            <h3 class="title">Create Account</h3>
            <p>Please register using the account details below.</p>

            <form method="POST" action="index.php?act=register">
                <div class="row row-cols-1 g-4">

                    <div class="col">
                        <label for="name">Họ và tên:</label>
                        <input class="form-field" type="text" id="name" name="name" required placeholder="Nhập họ tên">
                    </div>

                    <div class="col">
                        <label for="email">Email:</label>
                        <input class="form-field" type="email" id="email" name="email" required placeholder="Nhập email">
                    </div>

                    <div class="col">
                        <label for="password">Mật khẩu:</label>
                        <input class="form-field" type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
                    </div>

                    <div class="col">
                        <label for="confirm_password">Nhập lại mật khẩu:</label>
                        <input class="form-field" type="password" id="confirm_password" name="confirm_password" required placeholder="Nhập lại mật khẩu">
                    </div>

                    <div class="col">
                        <label for="phone">Số điện thoại:</label>
                        <input class="form-field" type="text" id="phone" name="phone" required placeholder="Nhập số điện thoại">
                    </div>

                    <div class="col">
                        <label for="address">Địa chỉ:</label>
                        <input class="form-field" type="text" id="address" name="address" required placeholder="Nhập địa chỉ">
                    </div>

                    <div class="col">
                        <button type="submit" class="btn-register">Đăng ký</button>
                    </div>

                    <div class="col text-center">
                        Đã có tài khoản? <a href="index.php?act=loginForm"><b>Đăng nhập</b></a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- Register Section End -->

<!-- Footer Section Start -->
<?php require_once './views/layout/footer.php'; ?>
<!-- Footer Section End -->

<!-- JS Vendor, Plugins & Activation Script Files -->
<script src="assets/js/vendor/modernizr-3.11.7.min.js"></script>
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/plugins/swiper-bundle.min.js"></script>
<script src="assets/js/plugins/jquery.countdown.min.js"></script>
<script src="assets/js/plugins/svg-inject.min.js"></script>
<script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
<script src="assets/js/plugins/ion.rangeSlider.min.js"></script>
<script src="assets/js/plugins/jquery.zoom.min.js"></script>
<script src="assets/js/plugins/resize-sensor.js"></script>
<script src="assets/js/plugins/jquery.sticky-sidebar.min.js"></script>
<script src="assets/js/active.js"></script>

</body>
