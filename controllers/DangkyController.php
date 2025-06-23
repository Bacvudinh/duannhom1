<?php 
class DangkyController  {

  
private $orderModel;
private $cartModel;
public function __construct()
{
    $this->orderModel = new Order();
    $this->cartModel = new Cart();
}


public function vnpay_payment()
{
    // Kiểm tra xem đã có thông tin đơn hàng chưa
    if (!isset($_SESSION['order_id']) || !isset($_SESSION['total_payment'])) {
        header("Location: index.php"); // Nếu không có, quay lại trang chủ
        exit;
    }

    // Lấy ID đơn hàng và tổng tiền từ session
    $orderId = $_SESSION['order_id'];
    $total = $_SESSION['total_payment'];

    date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ về Việt Nam

    // Địa chỉ URL thanh toán của VNPAY
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    // Đường dẫn trở về sau khi thanh toán xong
    $vnp_Returnurl = "http://localhost/duannhom1/index.php?act=vnpay_return";

    // Cấu hình thông tin merchant
    $vnp_TmnCode = "TGYIFNQW"; // Mã website (do VNPAY cấp)
    $vnp_HashSecret = "XRMVCANZ4KJUORGMNFW93DXDWPM4OAOH"; // Chuỗi bí mật (dùng để tạo chữ ký bảo mật)

    // Các thông tin thanh toán
    $vnp_TxnRef = $orderId; // Mã giao dịch (ở đây dùng ID đơn hàng)
    $vnp_OrderInfo = "Thanh toan don hang #" . $orderId; // Nội dung đơn hàng
    $vnp_OrderType = "billpayment"; // Loại thanh toán
    $vnp_Amount = $total * 100; // Số tiền (VNPAY dùng đơn vị VNĐ * 100)
    $vnp_Locale = "vn"; // Ngôn ngữ giao diện
    $vnp_BankCode = "VNBANK"; // Mã ngân hàng (nếu cố định)
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // IP của người dùng

    // Tạo mảng dữ liệu để gửi
    $inputData = array(
        "vnp_Version" => "2.1.0", // Phiên bản API
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay", // Lệnh thanh toán
        "vnp_CreateDate" => date('YmdHis'), // Ngày giờ giao dịch (yyyyMMddHHmmss)
        "vnp_CurrCode" => "VND", // Đơn vị tiền
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl, // URL trả về sau khi thanh toán
        "vnp_TxnRef" => $vnp_TxnRef
    );

    // Sắp xếp lại mảng theo thứ tự tăng dần key để tạo chuỗi ký tự
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";

    foreach ($inputData as $key => $value) {
        // Tạo chuỗi hashdata để ký
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }

        // Tạo query string để gắn vào URL
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    // Gắn hash vào URL thanh toán
    $vnp_Url .= "?" . $query;
    $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Tạo chữ ký SHA512
    $vnp_Url .= 'vnp_SecureHash=' . $vnp_SecureHash;

    // Chuyển người dùng sang trang thanh toán của VNPAY
    header('Location: ' . $vnp_Url);
    exit;
}

public function vnpay_return()
{
    // Nếu thanh toán thành công (mã phản hồi của VNPAY là "00")
    if ($_GET['vnp_ResponseCode'] == '00') {
        $orderId = $_GET['vnp_TxnRef']; // Lấy mã đơn hàng từ kết quả trả về

        // Cập nhật trạng thái thanh toán trong CSDL
        $this->orderModel->updatePaymentStatus($orderId, 'Đã thanh toán');

        // Lấy giỏ hàng của người dùng từ session và xoá
        $cart = $this->cartModel->getCartByUserId($_SESSION['user']['id']);
        $this->cartModel->clearCart($cart->id);

        // Dọn dẹp session liên quan tới thanh toán
        unset($_SESSION['checkout_info']);
        unset($_SESSION['order_id']);
        unset($_SESSION['total_payment']);

        // Gửi thông báo thành công qua session
        $_SESSION['success'] = "Thanh toán thành công. Cảm ơn bạn đã đặt hàng tại Shop!";
        header('Location: index.php?act=myOrders'); // Chuyển tới trang đơn hàng của tôi
        exit;
    } else {
        // Nếu thanh toán thất bại hoặc bị huỷ
        $_SESSION['error'] = "Thanh toán thất bại hoặc bị hủy.";
        header('Location: index.php');
        exit;
    }
}




}
?>