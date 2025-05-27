<?php require_once './views/layout/header.php'; ?>

<div class="page-banner-section section">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Shopping Cart</li>
        </ul>
    </div>
</div>

<div class="cart-section section section-padding">
    <div class="container">
        <h2 class="mb-4">Giỏ hàng của bạn</h2>

        <?php if (!empty($cartItems)): ?>
            <div class="table-responsive">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($cartItems as $item): ?>
                            <?php $subtotal = $item->price * $item->quantity; $total += $subtotal; ?>
                            <tr>
                                <td><?= htmlspecialchars($item->name) ?></td>
                                <td><img src="uploads/product/<?= htmlspecialchars($item->image) ?>" alt="<?= htmlspecialchars($item->name) ?>" width="60"></td>
                                <td>$<?= number_format($item->price, 2) ?></td>
                                <td><?= $item->quantity ?></td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                                <td>
                                    <a href="index.php?act=removeFromCart&item_id=<?= $item->id ?>" class="btn btn-danger btn-sm">X</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-4">
                <a href="index.php" class="btn btn-secondary">Tiếp tục mua sắm</a>
                <a href="index.php?act=checkout" class="btn btn-primary">Tiến hành thanh toán</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
            <a href="index.php" class="btn btn-primary">Quay lại cửa hàng</a>
        <?php endif; ?>
    </div>
</div>

<?php require_once './views/layout/footer.php'; ?>
