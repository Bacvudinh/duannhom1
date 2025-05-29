<?php
require_once 'models/Order.php';

class OrdersController {
    public function index() {
        $orderModel = new Order();
        $orders = $orderModel->all();
        require 'views/orders/index.php';
    }

    public function detail($id) {
    $orderModel = new Order();
    $order = $orderModel->find($id);

    if (!$order) {
        // Có thể chuyển hướng hoặc thông báo lỗi thân thiện
        die("Không tìm thấy đơn hàng có ID: $id");
    }

    // Gán chi tiết sản phẩm nếu có
    $order_items = $order['details'] ?? [];

    require 'views/orders/detail.php';
    }
    public function updateStatus() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $orderModel = new Order();
        $orderModel->updateStatus($id, $status);

        // Redirect lại trang chi tiết đơn hàng với thông báo
        header("Location: index.php?act=detailOrder&id=$id&success=update");
        exit;
    }
}
}