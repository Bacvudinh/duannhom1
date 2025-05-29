<?php

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/CategoriesController.php';
require_once 'controllers/ProductController.php'; // DÒNG NÀY ĐÃ ĐƯỢC THÊM VÀO!
require_once 'controllers/UsersController.php';
require_once 'controllers/OrdersController.php';


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
};
