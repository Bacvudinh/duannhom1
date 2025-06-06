<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php?act=loginForm');
    exit;
}
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Models của client để dùng vì tuấn anh làm nhầm model bên client 
require_once '../models/BaseModel.php'; // Model cơ sởz

require_once '../models/Categories.php'; // Model danh sách loại    
require_once '../models/Products.php'; // Model sản phẩm
require_once '../models/Cart.php'; // Model giỏ hàng
require_once '../models/Comment.php'; // Model bình luận
// kết thúc

require_once 'models/ProductVariant.php'; // không cần ../ vì đã nằm trong admin/

require_once "models/CommentModel.php"; // đường dẫn đến model CommentModel


require_once 'models/Size.php';




// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/CategoriesController.php';
require_once 'controllers/ProductController.php'; 
require_once 'controllers/UsersController.php';
require_once 'controllers/OrdersController.php';
require_once 'controllers/CommentController.php'; 
    require_once 'controllers/SizeController.php'; // Model size





// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match


// ... (các dòng require_once và $act = $_GET['act'] ?? '/' ...)

match ($act) {
    // Dashboards
    '/'                     => (new DashboardController())->index(),
    'Categories'            => (new CategoriesController())->index(),
    'addCategories'         => (new CategoriesController())->add(),
    'saveCategory'          => (new CategoriesController())->save(),
    'editCategories'        => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->edit($_GET['id']) : (new CategoriesController())->index(),
    'updateCategory'        => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->update($_GET['id']) : (new CategoriesController())->index(),
    'deleteCategory'        => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->delete($_GET['id']) : (new CategoriesController())->index(),

    // Products (đây là các trường hợp đã có)
    'Product'              => (new ProductsController())->index(),
    'addProduct'            => (new ProductsController())->add(),
    'saveProduct'           => (new ProductsController())->save(),
    'editProduct'           => isset($_GET['id']) && ($_GET['id']) ? (new ProductsController())->edit($_GET['id']) : (new ProductsController())->index(),
    'productVariants'       => isset($_GET['id']) && ($_GET['id']) ? (new ProductsController())->productVariants($_GET['id']) : (new ProductsController())->index(),
    'deleteVariant'          => isset($_GET['id']) && ($_GET['id']) ? (new ProductsController())->deleteVariant($_GET['id']) : (new ProductsController())->index(),
    'updateProduct'         => isset($_GET['id']) && ($_GET['id']) ? (new ProductsController())->update($_GET['id']) : (new ProductsController())->index(),
    'deleteProduct'         => isset($_GET['id']) && ($_GET['id']) ? (new ProductsController())->delete($_GET['id']) : (new ProductsController())->index(),

    // Users (quản lý người dùng)
    'Users'                 => (new UsersController())->index(),
    'editUser'              => isset($_GET['id']) && ($_GET['id']) ? (new UsersController())->edit($_GET['id']) : (new UsersController())->index(),
    'updateUser'            => isset($_GET['id']) && ($_GET['id']) ? (new UsersController())->update($_GET['id']) : (new UsersController())->index(),
    'toggleStatusUser'      => isset($_GET['id']) && ($_GET['id']) ? (new UsersController())->toggleStatus($_GET['id']) : (new UsersController())->index(),
    'toggleRole'        => isset($_GET['id']) ? (new UsersController())->toggleRole($_GET['id']) : (new UsersController())->index(),
    'detailUser' => isset($_GET['id']) ? (new UsersController())->detail($_GET['id']) : (new UsersController())->index(),

    // Orders
    'Orders'               => (new OrdersController())->index(),
    'detailOrder'          => isset($_GET['id']) ? (new OrdersController())->detail($_GET['id']) : (new OrdersController())->index(),
    'updateOrderStatus' => (new OrdersController())->updateStatus(),
    default => throw new Exception("Action '$act' không tìm thấy."),
    // Comment admin
    'admin_comments'         => (new CommentController())->index(),
    'admin_comment_edit'     => (new CommentController())->edit(),
    'admin_comment_update'   => (new CommentController())->update(),
    'admin_comment_delete'   => (new CommentController())->delete(),
    'admin_comment_toggle'   => (new CommentController())->toggle(),
        // sizesize admin
    'admin_sizes'         => (new SizeController())->index(),
    'admin_size_add'        => (new SizeController())->add(),
    'admin_size_save'       => (new SizeController())->save(),
    'admin_size_edit'     => (new SizeController())->edit(),
    'admin_size_update'   => (new SizeController())->update(),
    'admin_size_delete'   => (new SizeController())->delete(),
    'admin_size_toggle'   => (new SizeController())->toggle(),
};
