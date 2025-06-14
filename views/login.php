<?php
require_once './views/layout/header.php'; // Header
?>

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li>Login</li>
        </ul>
    </div>
</div>
<!-- Page Banner Section End -->

<!-- Custom CSS for Sign In button -->
<style>
    .btn-login {
        background: linear-gradient(135deg,hsl(50, 88.10%, 49.40%),rgb(125, 179, 0));
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        width: 100%;
        font-weight: bold;
        transition: 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #0056b3, #004494);
        transform: scale(1.02);
    }

    .login-register-form h3.title {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .login-register-form p {
        color: #6c757d;
    }

    .form-field {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
    }

    .form-field:focus {
        border-color:hsl(71, 61.80%, 49.20%);
        box-shadow: 0 0 0 0.15rem rgba(167, 230, 40, 0.25);
        outline: none;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    .login-register-form {
        max-width: 400px;
        margin: 0 auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }
</style>

<!-- Login Section Start -->
<div class="section section-padding">
    <div class="container">
        <div class="login-register-form">
            <h3 class="title">Login</h3>
            <p>Please login using your account details below.</p>

            <form method="POST" action="index.php?act=login">
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <input class="form-field" name="email" type="email" placeholder="Email" required>
                    </div>
                    <div class="col">
                        <input class="form-field" name="password" type="password" placeholder="Password" required>
                    </div>

                    <?php if (!empty($error)) : ?>
                        <div class="col">
                            <div class="error-message">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col">
                        <button type="submit" class="btn-login">Sign In</button>
                    </div>

                    <div class="col text-center">
                        Don't have an account? <a href="register.html"><b>Create One</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once './views/layout/footer.php'; // Footer ?>
