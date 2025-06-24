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
    $variantSize = $_POST['size'] ?? '';

    // Lấy danh sách biến thể theo sản phẩm
    $variants = $this->productModel->getVariantsByProductId($productId);

    $foundVariant = null;
    foreach ($variants as $variant) {
        if ($variant->size === $variantSize) {
            $foundVariant = $variant;
            break;
        }
    }
    if (!$foundVariant) {
        $_SESSION['add_to_cart_error'] = "Không tìm thấy biến thể sản phẩm.";
        header("Location: index.php?act=product_detail&id=$productId");
        exit;
    }

    $product = $this->productModel->getProductById($productId);
    if (!$product) {
        $_SESSION['add_to_cart_error'] = "Sản phẩm không tồn tại.";
        header("Location: index.php");
        exit;
    }

  

    $userId = $_SESSION['user']['id'];
    $cart = $this->cartModel->getCartByUserId($userId);
    $cartId = $cart ? $cart->id : $this->cartModel->createCart($userId);

    
    $this->cartModel->addItemToCart(
        $cartId,
        $productId,
        $foundVariant->id,        // variant_id
        $foundVariant->size,      // variant_size
        $foundVariant->price,
        $quantity
    );

    $_SESSION['add_to_cart_success'] = "Đã thêm '{$product->name}' (Size: {$foundVariant->size}) vào giỏ hàng.";
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
            'note' => $_POST['note'] ?? '',
            'payment_method' => $_POST['payment_method'] ?? 'cod'
        ];

        $userId = $_SESSION['user']['id'];
        $cart = $this->cartModel->getCartByUserId($userId);
        $cartItems = $this->cartModel->getCartItems($cart->id);
        foreach ($cartItems as $item) {
    if ($item->status == 0) {
        $_SESSION['checkout_error'] = "Giỏ hàng của bạn có sản phẩm đã bị ẩn. Vui lòng xoá sản phẩm đó để tiếp tục.";
        header("Location: index.php?act=cart");
        exit;
    }
}

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
    foreach ($cartItems as $item) {
    if ($item->status == 0) {
        $_SESSION['checkout_error'] = "Có sản phẩm đã bị ẩn trong giỏ hàng. Vui lòng xoá sản phẩm đó.";
        header("Location: index.php?act=cart");
        exit;
    }
}


    if (empty($cartItems)) {
        header('Location: index.php?act=cart');
        exit;
    }

    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item->price * $item->quantity;
    }
 $info = $_SESSION['checkout_info'];
   $paymentMethod = $info['payment_method'];
    // Tạo đơn hàng với trạng thái thanh toán là "Chưa thanh toán"
    $orderId = $this->orderModel->createOrder($userId, $total, 'Chưa thanh toán',$info['payment_method']);

    foreach ($cartItems as $item) {
        $this->orderModel->insertOrderDetail($orderId, $item->product_id, $item->quantity, $item->price,$item->variant_id);
    }
   
    $this->orderModel->insertOrderAddress($orderId, $info['name'], $info['email'], $info['phone'], $info['address'], $info['note'],);
 // Nếu thanh toán là COD → xử lý luôn
    if ($paymentMethod == 'cod') {
        $this->cartModel->clearCart($cart->id);
        unset($_SESSION['checkout_info']);
    $_SESSION['success'] = "Đơn hàng của bạn đã được đặt thành công!";
header("Location: index.php?act=myOrders");
exit;
    }
    // Nếu là VNPAY → chuyển hướng đến trang tạo thanh toán
    elseif ($paymentMethod == 'vnpay') {
        $_SESSION['order_id'] = $orderId;
        $_SESSION['total_payment'] = $total;
        header("Location: index.php?act=vnpay_payment");
        exit;
    }
    // ❌ Không cập nhật thanh toán ở đây nữa
    // ✅ Chỉ cập nhật khi chuyển trạng thái đơn hàng sang 'Hoàn thành'

    // $this->cartModel->clearCart($cart->id);
    // unset($_SESSION['checkout_info']);

    // echo "<script>alert('Đặt hàng thành công!'); window.location.href='index.php';</script>";
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
