<?php
require_once './models/Cart.php';
require_once './models/Order.php';

class CartController
{
    protected $cartModel;
    protected $productModel;
    protected $orderModel;

    public function __construct()
    {
        $this->cartModel = new Cart();
        $this->productModel = new Products();
        $this->orderModel = new Order();
    }

    // Hiển thị giỏ hàng
    public function cart()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=loginForm');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $cart = $this->cartModel->getCartByUserId($userId);

        if (!$cart) {
            $cartId = $this->cartModel->createCart($userId);
        } else {
            $cartId = $cart->id;
        }

        $cartItems = $this->cartModel->getCartItems($cartId);
        require_once './views/cart.php';
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=loginForm');
            exit;
        }

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'] ?? 1;

        $product = $this->productModel->getProductById($productId);
        if (!$product) {
            header('Location: index.php');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $cart = $this->cartModel->getCartByUserId($userId);

        if (!$cart) {
            $cartId = $this->cartModel->createCart($userId);
        } else {
            $cartId = $cart->id;
        }

        $this->cartModel->addItemToCart($cartId, $productId, $quantity, $product->price);
        header('Location: index.php?act=cart');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart()
    {
        $itemId = $_GET['item_id'] ?? null;
        if ($itemId) {
            $this->cartModel->removeItemFromCart($itemId);
        }
        header('Location: index.php?act=cart');
    }

    // Hiển thị trang thanh toán
   public function checkout()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?act=loginForm');
        exit;
    }

    if (!isset($_POST['confirm_checkout'])) {
        header('Location: index.php?act=cart');
        exit;
    }

    // Lấy dữ liệu từ form modal
    $_SESSION['checkout_info'] = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'note' => $_POST['note'] ?? ''
    ];

    $userId = $_SESSION['user']['id'];
    $cart = $this->cartModel->getCartByUserId($userId);
    $cartItems = $this->cartModel->getCartItems($cart->id);

    require_once './views/checkout.php';
}


    // Đặt hàng (tạo đơn hàng + chi tiết)
   public function placeOrder()
{
    if (!isset($_SESSION['user']) || !isset($_SESSION['checkout_info'])) {
        header('Location: index.php?act=loginForm');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $cart = $this->cartModel->getCartByUserId($userId);
    $cartItems = $this->cartModel->getCartItems($cart->id);

    if (empty($cartItems)) {
        header('Location: index.php?act=cart');
        exit;
    }

    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item->price * $item->quantity;
    }

    // Tạo đơn hàng
    $orderId = $this->orderModel->createOrder($userId, $total);

    // Thêm chi tiết đơn hàng
    foreach ($cartItems as $item) {
        $this->orderModel->insertOrderDetail($orderId, $item->product_id, $item->quantity, $item->price);
    }

    // Thêm thông tin địa chỉ người nhận vào bảng order_addresses
    $info = $_SESSION['checkout_info'];
    $this->orderModel->insertOrderAddress($orderId, $info['name'], $info['email'], $info['phone'], $info['address'], $info['note']);

    // Xóa giỏ hàng
    $this->cartModel->clearCart($cart->id);

    // Xóa session info checkout
    unset($_SESSION['checkout_info']);

    echo "<script>alert('Đặt hàng thành công!'); window.location.href='index.php';</script>";
}

}
