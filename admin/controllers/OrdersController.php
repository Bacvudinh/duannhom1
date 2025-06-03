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
        $newStatus = $_POST['status'];

        $orderModel = new Order();
        $order = $orderModel->find($id);

        if (!$order) {
            die("Đơn hàng không tồn tại.");
        }

        $currentStatus = $order['status'];

        // Thứ tự trạng thái
        $statusOrder = [
            'Chờ xác nhận',
            'Chờ lấy hàng',
            'Đang giao hàng',
            'Đã giao hàng',
            'Hoàn thành',
            'Đã huỷ' // Ngoại lệ, xử lý riêng
        ];

        $invalidUpdate = false;
        $errorMessage = "";

        // Kiểm tra trạng thái không tồn tại
        if (!in_array($currentStatus, $statusOrder) || !in_array($newStatus, $statusOrder)) {
            $invalidUpdate = true;
            $errorMessage = "Trạng thái không hợp lệ.";
        }

        // Ngăn chuyển về trạng thái trước
        $currentIndex = array_search($currentStatus, $statusOrder);
        $newIndex = array_search($newStatus, $statusOrder);

        // Cho phép chuyển sang "Đã huỷ" nếu đang là "Chờ xác nhận"
        if ($newStatus === 'Đã huỷ' && $currentStatus !== 'Chờ xác nhận') {
            $invalidUpdate = true;
            $errorMessage = "Chỉ có thể huỷ đơn ở trạng thái 'Chờ xác nhận'.";
        }

        // Ngăn quay lui trạng thái (trừ khi là huỷ hợp lệ)
        if ($newStatus !== 'Đã huỷ' && $newIndex < $currentIndex) {
            $invalidUpdate = true;
            $errorMessage = "Không thể chuyển về trạng thái trước đó.";
        }

        // Đơn đã hoàn thành thì không thay đổi nữa
        if ($currentStatus === 'Hoàn thành' && $newStatus !== 'Hoàn thành') {
            $invalidUpdate = true;
            $errorMessage = "Đơn hàng đã hoàn thành không thể thay đổi trạng thái.";
        }

        if ($invalidUpdate) {
            header("Location: index.php?act=detailOrder&id=$id&error=" . urlencode($errorMessage));
            exit;
        }

        // Hợp lệ → cập nhật trạng thái
        $orderModel->updateStatus($id, $newStatus);

        header("Location: index.php?act=detailOrder&id=$id&success=update");
        exit;
    }
}


}