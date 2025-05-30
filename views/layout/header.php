<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bee Coffee & Tea</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Kofi - Coffee Shop Website Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/Screenshot 2025-05-16 100627.png">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="header sticky-header section">
        <div class="container-fluid">
            <div class="row align-items-center">

                <!-- Logo Start -->
                <div class="col-lg-2 col d-flex align-items-center">
                    <div class="header-logo d-flex align-items-center" style="margin-right: 100px;">
                        <a href="index.php?act=/" class="d-flex align-items-center gap-2 text-decoration-none">
                            <img src="assets/images/logo/Screenshot 2025-05-16 100627.png" alt="Bee Coffee" class="logo-img">
                            <span class="logo-text">Bee Coffee &amp; Tea</span>
                        </a>
                    </div>
                </div>
                <!-- Logo End -->

                <!-- Menu Start -->
                <div class="col d-none d-lg-block">
                    <nav class="main-menu">
                        <ul>
                            <li><a href="index.php?act=/">Home</a></li>
                            <li><a href="index.php?act=listproducts">Shop</a></li>
                            <li><a href="index.php?act=contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Menu End -->

                <!-- Action Start -->
                <div class="col-auto">
                    <div class="header-action">
                        <div class="header-action-item">
                            <button class="header-action-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-search">
                                <i class="sli-magnifier"></i>
                            </button>
                        </div>
                        <div class="header-action-item">
                            <a href="index.php?act=cart" class="header-action-toggle">
                                <i class="sli-basket-loaded">

                                </i>
                                <span class="amout"></span>
                            </a>
                            
                        </div>
                        <div class="header-action-item dropdown">
                            <button class="header-action-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="sli-settings"></i>
                            </button>

                            <div class="dropdown-menu header-dropdown-menu">

                                <h6 class="header-dropdown-menu-title">Account</h6>
                                     
                                <ul>
                                    <?php if (isset($_SESSION['user']) && is_array($_SESSION['user'])): ?>
                                        <li>
                                            <span>
                                                Xin chào,
                                                <?= htmlspecialchars($_SESSION['user']['NAME'] ?? 'Khách') ?>
                                            </span>
                                        </li>
                                        <li><a href="index.php?act=myOrders">Đơn hàng của tôi</a></li>
                                        <li><a href="index.php?act=logout">Đăng xuất</a></li>
                                    <?php else: ?>
                                        <li><a href="index.php?act=loginForm">Đăng nhập</a></li>
                                        <li><a href="index.php?act=registerForm">Đănh kí</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="header-action-item d-lg-none">
                            <button class="header-action-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-header">
                                <i class="sli-menu"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Action End -->

            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end w-100 bg-dark border-0" id="offcanvas-search">
        <div class="offcanvas-body d-flex align-items-center justify-content-center">
            <button type="button" class="btn-close offcanvas-search-close-btn text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            <div class="offcanvas-search-form">
                <form class="d-flex" action="index.php" method="get">
                    <input type="hidden" name="act" value="listproducts">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>