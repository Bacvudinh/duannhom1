<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ


// Require toàn bộ file Models
require_once './models/BaseModel.php'; // Model cơ sở
require_once './models/Categories.php'; // Model danh sách loại
require_once './models/Products.php'; // Model sản phẩm
require_once './models/Cart.php'; // Model giỏ hàng
require_once './models/Comment.php'; // Model bình luận

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/LoginController.php';
require_once './controllers/CartController.php';
require_once './controllers/CommentController.php';
// Require toàn bộ file Models
require_once './models/User.php';
require_once './models/Order.php';
require_once './controllers/OrderController.php'; // Thêm dòng này vào
// Require toàn bộ file Controllers
require_once './controllers/LoginController.php';
require_once './controllers/CartController.php';
require_once './controllers/OrderController.php';
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './controllers/CommentController.php';
 // Thêm dòng này vào

// require_once './views/layout/header.php'; // Header

// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match


match ($act) {
    // Trang chủ
    '/'                 => (new HomeController())->index(),
    'listproducts' => (new ProductController())->index(),
    'product_detail' => (new ProductController())->productDetail(),
    'addComment' => (new CommentController())->handleAddComment($_GET['product_id'] ?? 0),
    'deleteComment' => (new CommentController())->deleteComment($_GET['id'], $_GET['product_id']),
    'loginForm'                 => (new LoginController())->showLogin(),
    'login'                 => (new LoginController())->login(),
    'cart'                     => (new CartController())->cart(),
    'logout'     => (new LoginController())->logout(),
    'registerForm' => (new LoginController())->showRegisterForm(),
    'register' => (new LoginController())->register(),
    'addToCart'         => (new CartController())->addToCart(),
    'removeFromCart'    => (new CartController())->removeFromCart(),
    'checkout'      => (new CartController())->checkout(),
    'placeOrder'    => (new CartController())->placeOrder(),
    'myOrders'           => (new OrderController())->myOrders(),
    'orderDetails'       => (new OrderController())->orderDetails(),
    'cancelOrder'        => (new OrderController())->cancelOrder(),
    'updateCart'         =>(new CartController())->updateCart(),
};




require_once './views/layout/footer.php'; // Footer