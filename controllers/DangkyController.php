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
    if (!isset($_SESSION['order_id']) || !isset($_SESSION['total_payment'])) {
        header("Location: index.php");
        exit;
    }

    $orderId = $_SESSION['order_id'];
    $total = $_SESSION['total_payment'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
   $vnp_Returnurl = "http://localhost/duannhom1/index.php?act=vnpay_return";
    // Thông tin cấu hình VNPAY
    // Bạn cần thay đổi các thông tin này theo cấu hình của bạn

    $vnp_TmnCode = "TGYIFNQW"; // Mã website của bạn
    $vnp_HashSecret = "XRMVCANZ4KJUORGMNFW93DXDWPM4OAOH"; // Chuỗi bí mật

    $vnp_TxnRef = $orderId;
    $vnp_OrderInfo = "Thanh toan don hang #" . $orderId;
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $total * 100;
    $vnp_Locale = "vn";
    $vnp_BankCode = "VNBANK";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef
    );

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url .= "?" . $query;
    $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnp_SecureHash;

    header('Location: ' . $vnp_Url);
    exit;
}
public function vnpay_return()
{
    if ($_GET['vnp_ResponseCode'] == '00') {
        $orderId = $_GET['vnp_TxnRef'];
        $this->orderModel->updatePaymentStatus($orderId, 'Đã thanh toán');

        // Xoá giỏ hàng
        $cart = $this->cartModel->getCartByUserId($_SESSION['user']['id']);
        $this->cartModel->clearCart($cart->id);

        unset($_SESSION['checkout_info']);
        unset($_SESSION['order_id']);
        unset($_SESSION['total_payment']);

        echo "<script>alert('Thanh toán thành công!');</script>";
        header('Location: index.php?act=myOrders');
    } else {
        echo "<script>alert('Thanh toán thất bại!'); window.location.href='index.php';</script>";
    }
}


}
?>