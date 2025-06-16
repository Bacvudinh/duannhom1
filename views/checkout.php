<?php require_once './views/layout/header.php'; ?>

<div class="page-banner-section section">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Checkout</li>
        </ul>
    </div>
</div>

<div class="checkout-section section section-padding">
    <div class="container">
        <h2>Thông tin thanh toán</h2>

        <?php if (!empty($cartItems)): ?>
        <form action="index.php?act=placeOrder" method="post">
            <div class="row">
                <div class="col-md-6">
                    <?php $info = $_SESSION['checkout_info'] ?? []; ?>
                    <h4>Thông tin người nhận</h4>
                    <p><strong>Họ tên:</strong> <?= htmlspecialchars($info['name'] ?? '') ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($info['email'] ?? '') ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($info['address'] ?? '') ?></p>
                    <p><strong>SĐT:</strong> <?= htmlspecialchars($info['phone'] ?? '') ?></p>
                    <p><strong>Ghi chú:</strong> <?= htmlspecialchars($info['note'] ?? 'Không có') ?></p>
                    <p><strong>Phương thức thanh toán:</strong>
                        <?php
        $pm = $info['payment_method'] ?? 'cod';
        echo match ($pm) {
            'cod' => 'Thanh toán khi nhận hàng (COD)',
            'vnpay' => 'Thanh toán qua VNPAY',
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            default => 'Không xác định'
        };
    ?>
                    </p>

                </div>

                <div class="col-md-6">
                    <h4>Đơn hàng của bạn</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($cartItems as $item): ?>
                            <?php $subtotal = $item->price * $item->quantity;
                                    $total += $subtotal; ?>
                            <tr>
                                <td><?= htmlspecialchars($item->name) ?></td>
                                <td><?= $item->quantity ?></td>
                                <td><?= number_format($subtotal, 2) ?>VNĐ</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2"><strong>Tổng cộng:</strong></td>
                                <td><strong><?= number_format($total, 2) ?>VNĐ</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
                </div>
            </div>
        </form>
        <?php else: ?>
        <p>Giỏ hàng của bạn đang trống.</p>
        <a href="index.php" class="btn btn-primary">Quay lại cửa hàng</a>
        <?php endif; ?>
    </div>
</div>

<?php require_once './views/layout/footer.php'; ?>