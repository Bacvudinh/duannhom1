<?php

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/CategoriesController.php';
// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/'                     => (new DashboardController())->index(),
    'Categories'            => (new CategoriesController())->index(),
    'addCategories'         => (new CategoriesController())->add(),
    'saveCategory'          => (new CategoriesController())->save(),
    'editCategories'        => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->edit($_GET['id']) : (new CategoriesController())->index(),
    'updateCategory'        => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->update($_GET['id']) : (new CategoriesController())->index(),
    'deleteCategory'        => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->delete($_GET['id']) : (new CategoriesController())->index(),
    'xoadm'                 => isset($_GET['id']) && ($_GET['id']) ? (new CategoriesController())->delete($_GET['id']) : (new CategoriesController())->index(), // Thêm case này
};