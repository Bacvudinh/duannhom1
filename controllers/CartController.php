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

        $userId = $_SESSION['user']['id'];
        $cart = $this->cartModel->getCartByUserId($userId);
        $cartItems = $this->cartModel->getCartItems($cart->id);

        require_once './views/checkout.php';
    }

    // Đặt hàng (tạo đơn hàng + chi tiết)
    public function placeOrder()
    {
        if (!isset($_SESSION['user'])) {
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

        // Tính tổng đơn hàng
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

        // Xóa giỏ hàng
        $this->cartModel->clearCart($cart->id);

        // Thông báo & chuyển hướng
        echo "<script>alert('Đặt hàng thành công!'); window.location.href='index.php';</script>";
    }
}
