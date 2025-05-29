<?php
require_once './models/Order.php';

class OrderController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order();
    }
    // Hiển thị danh sách đơn hàng của người dùng
    public function myOrders()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=loginForm');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrdersByUserId($userId);

        require_once './views/myOrder.php';
    }

    // Hiển thị chi tiết của đơn hàng
    public function orderDetails()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=loginForm');
            exit;
        }

        $orderId = $_GET['order_id'] ?? null;
        if (!$orderId) {
            header('Location: index.php?act=myOrders');
            exit;
        }

        $orderItems = $this->orderModel->getOrderDetails($orderId);
        require_once './views/orderDetail.php';
    }
}
