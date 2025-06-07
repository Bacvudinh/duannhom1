<?php
require_once 'models/Order.php';

class OrdersController {
    public function index() {
        $orderModel = new Order();
        $orders = $orderModel->all();
        require 'views/orders/index.php';
    }

    public function     detail($id) {
        $orderModel = new Order();
        $order = $orderModel->find($id);

        if (!$order) {
            die("Không tìm thấy đơn hàng có ID: $id");
        }

        $order_items = $order['details'] ?? [];

        require 'views/orders/detail.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $newStatus = $_POST['status'];

            $orderModel = new Order();
            $order = $orderModel->find($id);

            if (!$order) {
                die("Đơn hàng không tồn tại.");
            }

            $currentStatus = $order['status'];

            $statusOrder = [
                'Chờ xác nhận',
                'Xác nhận',
                'Đang giao hàng',
                'Đã giao hàng',
                'Hoàn thành',
                'Đã hủy'
            ];

            $invalidUpdate = false;
            $errorMessage = "";

            if (!in_array($currentStatus, $statusOrder) || !in_array($newStatus, $statusOrder)) {
                $invalidUpdate = true;
                $errorMessage = "Trạng thái không hợp lệ.";
            }

            $currentIndex = array_search($currentStatus, $statusOrder);
            $newIndex = array_search($newStatus, $statusOrder);

            if ($newStatus === 'Đã hủy' && $currentStatus !== 'Chờ xác nhận') {
                $invalidUpdate = true;
                $errorMessage = "Chỉ có thể huỷ đơn ở trạng thái 'Chờ xác nhận'.";
            }

            if ($newStatus !== 'Đã hủy' && $newIndex < $currentIndex) {
                $invalidUpdate = true;
                $errorMessage = "Không thể chuyển về trạng thái trước đó.";
            }

            if ($currentStatus === 'Hoàn thành' && $newStatus !== 'Hoàn thành') {
                $invalidUpdate = true;
                $errorMessage = "Đơn hàng đã hoàn thành không thể thay đổi trạng thái.";
            }

            if ($invalidUpdate) {
                header("Location: index.php?act=detailOrder&id=$id&error=" . urlencode($errorMessage));
                exit;
            }

            $orderModel->updateStatus($id, $newStatus);
            header("Location: index.php?act=detailOrder&id=$id&success=update");
            exit;
        }
    }

    public function updatePaymentStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'] ?? null;
            $newStatus = $_POST['new_status'] ?? 'Đã thanh toán';

            if (!$orderId) {
                $_SESSION['error'] = "Thiếu thông tin đơn hàng.";
                header("Location: index.php?act=myOrders");
                exit;
            }

            $orderModel = new Order();
            $order = $orderModel->find($orderId);

            if (!$order) {
                $_SESSION['error'] = "Đơn hàng không tồn tại.";
                header("Location: index.php?act=myOrders");
                exit;
            }

            if ($order['payment_status'] === 'Đã thanh toán') {
                $_SESSION['error'] = "Đơn hàng này đã được thanh toán.";
                header("Location: index.php?act=orderDetails&order_id=$orderId");
                exit;
            }

            $orderModel->updatePaymentStatus($orderId, $newStatus);
            $_SESSION['message'] = "Đã cập nhật trạng thái thanh toán.";
            header("Location: index.php?act=orderDetails&order_id=$orderId");
            exit;
        }
    }
}
