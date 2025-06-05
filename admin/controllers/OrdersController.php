<?php
require_once 'models/Order.php';

class OrdersController
{
    public function index()
{
    $orderModel = new Order();

    // Lấy từ khóa tìm kiếm từ GET
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

    // Nếu có từ khóa, tìm kiếm theo tên khách hàng
    if (!empty($keyword)) {
        $orders = $orderModel->searchByCustomerName($keyword);
    } else {
        $orders = $orderModel->all();
    }

    require 'views/orders/index.php';
}

    public function detail($id)
    {
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


    public function updateStatus()
    {
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
                'Đã huỷ'
            ];

            $invalidUpdate = false;
            $errorMessage = "";

            if (!in_array($currentStatus, $statusOrder) || !in_array($newStatus, $statusOrder)) {
                $invalidUpdate = true;
                $errorMessage = "Trạng thái không hợp lệ.";
            }

            $currentIndex = array_search($currentStatus, $statusOrder);
            $newIndex = array_search($newStatus, $statusOrder);

            if ($newStatus === 'Đã huỷ' && $currentStatus !== 'Chờ xác nhận') {
                $invalidUpdate = true;
                $errorMessage = "Chỉ có thể huỷ đơn ở trạng thái 'Chờ xác nhận'.";
            }

            if ($newStatus !== 'Đã huỷ' && $newIndex < $currentIndex) {
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

            // ✅ Cập nhật trạng thái đơn hàng
            $orderModel->updateStatus($id, $newStatus);

            // ✅ Nếu là "Hoàn thành" thì cập nhật thanh toán
            if ($newStatus === 'Hoàn thành') {
                $orderModel->updatePaymentStatus($id, 'Đã thanh toán');
            }

            header("Location: index.php?act=detailOrder&id=$id&success=update");
            exit;
        }
    }
}
