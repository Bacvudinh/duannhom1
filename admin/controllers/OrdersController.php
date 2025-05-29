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
}