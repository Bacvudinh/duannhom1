<?php
    session_start();
    // Require file Common
    require_once './commons/env.php'; // Khai báo biến môi trường
    require_once './commons/function.php'; // Hàm hỗ trợ


    // Require toàn bộ file Models
    require_once './models/BaseModel.php'; // Model cơ sở
    require_once './models/Categories.php'; // Model danh sách loại
    require_once './models/Products.php'; // Model sản phẩm

    // Require toàn bộ file Controllers
    require_once './controllers/HomeController.php';
    require_once './controllers/LoginController.php';
    require_once './controllers/CartController.php';
    // Require toàn bộ file Models
    require_once './models/User.php';


    // Require toàn bộ file Controllers
    require_once './controllers/HomeController.php';
    require_once './controllers/ProductController.php';
    // require_once './views/layout/header.php'; // Header

    // Route
    $act = $_GET['act'] ?? '/';


    // Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

    match ($act) {
        // Trang chủ
        '/'                 => (new HomeController())->index(),
        'listproducts' => (new ProductController())->index(),
        'product_detail' => (new ProductController())->productDetail(),
        'loginForm'                 => (new LoginController())->showLogin(),
        'login'                 => (new LoginController())->login(),
        'cart'                     =>(new CartController())->cart(),
        'logout'     => (new LoginController())->logout(),
    };
    require_once './views/layout/footer.php'; // Footer