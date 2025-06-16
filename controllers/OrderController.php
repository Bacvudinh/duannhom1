<?php
require_once './models/Order.php';

class OrderController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order();
    }

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

    // Sửa hàm hiển thị chi tiết đơn hàng
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

        // ✅ Lấy thông tin đơn hàng (chứa payment_status, note...)
        $order = $this->orderModel->getOrderById($orderId);

        $orderItems = $this->orderModel->getOrderDetails($orderId);
        $orderAddress = $this->orderModel->getOrderAddress($orderId);

        require_once './views/orderDetail.php';
    }

    public function cancelOrder()
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

        $result = $this->orderModel->cancelOrderIfPending($orderId, $_SESSION['user']['id']);

        if ($result) {
            $items = $this->orderModel->getOrderDetails($orderId);
            foreach ($items as $item) {
                $this->orderModel->increaseProductStock($item->product_id, $item->quantity);
            }

            $_SESSION['message'] = "Đơn hàng #$orderId đã được hủy thành công.";
        } else {
            $_SESSION['error'] = "Không thể hủy đơn hàng #$orderId. Đơn hàng không hợp lệ hoặc đã được xử lý.";
        }
        header('Location: index.php?act=myOrders');
        exit;
    }
    public function updatePaymentStatus()
    {
        $orderId = $_POST['order_id'] ?? null;
        $newPaymentStatus = $_POST['new_status'] ?? null;

        if ($orderId && $newPaymentStatus) {
            // Cập nhật trạng thái thanh toán
            $this->orderModel->updatePaymentStatus($orderId, $newPaymentStatus);
            // Đồng thời cập nhật trạng thái đơn hàng sang "Hoàn thành"
            $this->orderModel->updateOrderStatus($orderId, 'Hoàn thành');
            $this->orderModel->$_SESSION['message'] = 'Xác nhận thanh toán thành công. Đơn hàng đã hoàn thành.';
            $this->confirmReceived();

        } else {
            $_SESSION['error'] = 'Thiếu thông tin để cập nhật.';
        }

        header('Location: index.php?act=myOrders');
        exit;
    }
    public function confirmReceived()
    {
        $orderId = $_POST['order_id'];
        $this->orderModel->updatecustomer_confirmed($orderId);

        
        $this->orderModel->updateOrderStatus($orderId, 'Hoàn thành');

        header("Location: index.php?act=orderDetails&order_id=$orderId");
    }
}
