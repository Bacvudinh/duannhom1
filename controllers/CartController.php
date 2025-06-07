<?php
require_once './models/Cart.php';
require_once './models/Order.php';
require_once './models/Products.php';

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

    $productId = $_POST['product_id'] ?? 0;
    $quantity = max(1, (int)($_POST['quantity'] ?? 1));

    $product = $this->productModel->getProductById($productId);
    if (!$product) {
        $_SESSION['add_to_cart_error'] = "Sản phẩm không tồn tại.";
        header('Location: index.php');
        exit;
    }

    // ✅ Kiểm tra tồn kho nhưng KHÔNG trừ số lượng
  
    $userId = $_SESSION['user']['id'];
    $cart = $this->cartModel->getCartByUserId($userId);
    $cartId = $cart ? $cart->id : $this->cartModel->createCart($userId);

    // ✅ Thêm vào giỏ mà KHÔNG giảm tồn kho
    $this->cartModel->addItemToCart($cartId, $productId, $quantity, $product->price);

    $_SESSION['add_to_cart_success'] = "Đã thêm '{$product->name}' vào giỏ hàng.";
    header("Location: index.php?act=product_detail&id=$productId");
    exit;
}



    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart()
    {
        $itemId = $_GET['item_id'] ?? null;
        if ($itemId) {
            // Lấy thông tin item trước khi xóa
            $sql = "SELECT * FROM cart_items WHERE id = ?";
            $this->cartModel->setQuery($sql);
            $item = $this->cartModel->loadRow([$itemId]);

            if ($item) {
                // Lấy thông tin sản phẩm từ model Products
                $product = $this->productModel->getProductById($item->product_id);

                if ($product) {
                    // Cộng lại stock
                    $newStock = $product->stock + $item->quantity;
                    $this->productModel->updateProductStock($product->id, $newStock);
                }

                // Sau khi cộng lại kho thì mới xóa khỏi giỏ
                $this->cartModel->removeItemFromCart($itemId);
            }
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

    // Tạo đơn hàng với trạng thái thanh toán là "Chưa thanh toán"
    $orderId = $this->orderModel->createOrder($userId, $total, 'Chưa thanh toán');

    foreach ($cartItems as $item) {
        $this->orderModel->insertOrderDetail($orderId, $item->product_id, $item->quantity, $item->price);
    }

    $info = $_SESSION['checkout_info'];
    $this->orderModel->insertOrderAddress($orderId, $info['name'], $info['email'], $info['phone'], $info['address'], $info['note']);

    // ❌ Không cập nhật thanh toán ở đây nữa
    // ✅ Chỉ cập nhật khi chuyển trạng thái đơn hàng sang 'Hoàn thành'

    $this->cartModel->clearCart($cart->id);
    unset($_SESSION['checkout_info']);

    echo "<script>alert('Đặt hàng thành công!'); window.location.href='index.php';</script>";
}

    public function updateCart()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=loginForm');
            exit;
        }

        // Lấy danh sách số lượng từ POST
        foreach ($_POST['quantities'] as $itemId => $quantity) {
            $this->cartModel->updateItemQuantity($itemId, $quantity);
        }

        // Chuyển hướng về giỏ hàng
        header('Location: index.php?act=cart');
    }
}
