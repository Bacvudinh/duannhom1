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

    // ✅ Hủy đơn hàng (chỉ nếu đang ở trạng thái 'waiting_confirmation')
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

        // Gọi model để hủy đơn
        $result = $this->orderModel->cancelOrderIfPending($orderId, $_SESSION['user']['id']);

        if ($result) {
            // Lấy danh sách sản phẩm trong đơn để cộng lại stock
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
}
