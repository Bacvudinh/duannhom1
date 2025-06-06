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

    <!-- Thông báo lỗi -->
    <!-- Login Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="login-register-form">
                <h3 class="title">Login</h3>
                <p>Please Register using account detail bellow.</p>
                <form method="POST" action="index.php?act=login">
                    <div class="row row-cols-1 g-4">
                        <div class="col"><input class="form-field" name="email" type="email" placeholder="Email"></div>
                        <div class="col"><input class="form-field" name="password" type="password" placeholder="Password"></div>
                         <?php if (!empty($error)) : ?>
                                <div style="color: red; font-size: 14px; margin-top: 5px;">
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            <?php endif; ?>
                        <div class="col"><input class="btn btn-dark btn-primary-hover rounded-0 w-100" type="submit" value="Sign In"></div>
                        <div class="col">Don't have an account? <a href="register.html"><b>Create One</b></a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   