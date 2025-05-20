<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from htmldemo.net/kofi/kofi/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 May 2025 23:51:46 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bee Coffee & tea</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Kofi - Coffee Shop Website Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/Screenshot 2025-05-16 100627.png">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <!-- Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;family=Oswald:wght@200;300;400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="assets/css/plugins/simple-line-icons.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/ion.rangeSlider.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <div class="header sticky-header section">
        <div class="container-fluid">
            <div class="row align-items-center">

                <!-- Logo Start -->
                <div class="col-lg-2 col d-flex align-items-center">
                    <div class="header-logo d-flex align-items-center" style="margin-right: 100px;">
                        <a href="index.html" class="d-flex align-items-center gap-2 text-decoration-none">
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
                            <li class="has-sub-menu">
                                <a href="index.php?act=/">Home</a>
                            </li>
                            <li>
                                <a href="index.php?act=listproducts">Shop</a>

                                <ul class="mega-menu">
                                    <li>
                                        <a href="">Product Pages</a>

                                        <ul>
                                            <li><a href="product-details.html">Product Details</a></li>
                                            <li><a href="product-details-sticky-content.html">Product Details Sticky Content</a></li>
                                            <li><a href="product-details-thumbnail-right.html">Product Details Right Thumbnail</a></li>
                                            <li><a href="product-details-gallery.html">Product Details Gallery</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="index-4.html">Others</a>

                                        <ul>
                                            <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>


                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub-menu">
                                <a href="index.html">Pages</a>

                                <ul class="sub-menu">
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="index?act=login">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Menu End -->

                <!-- Action Start -->
                <div class="col-auto">
                    <div class="header-action">
                        <div class="header-action-item">
                            <button class="header-action-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-search"><i class="sli-magnifier"></i>
                            </button>
                        </div>
                        <div class="header-action-item">
                            <a href="shopping-cart.html" class="header-action-toggle">
                                <i class="sli-basket-loaded">
                                    <span class="count">02</span>
                                </i>
                                <span class="amount">$229.00</span>
                            </a>
                        </div>
                        <div class="header-action-item dropdown">
                            <button class="header-action-toggle" type="button" data-bs-toggle="dropdown"><i class="sli-settings"></i></button>
                            <div class="dropdown-menu header-dropdown-menu">
                                <h6 class="header-dropdown-menu-title">Account</h6>
                                <ul>
                                    <li><a href="index.php?act=loginForm">Login</a></li>
                                    <li><a href="register.html">Register</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="header-action-item d-lg-none">
                            <button class="header-action-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-header"><i class="sli-menu"></i></button>
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