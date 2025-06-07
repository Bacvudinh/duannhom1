<?php require_once './views/layout/header.php'; ?>
<div class="container section-padding">
    <h2 class="mb-4">Chi tiết đơn hàng #<?= htmlspecialchars($_GET['order_id'] ?? '') ?></h2>

    <?php if (!empty($orderAddress)): ?>
        <div class="mb-4">
            <h4>Thông tin người nhận</h4>
            <p><strong>Họ tên:</strong> <?= htmlspecialchars($orderAddress->name ?? 'Không có') ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($orderAddress->email ?? 'Không có') ?></p>
            <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($orderAddress->phone ?? 'Không có') ?></p>
            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($orderAddress->address ?? 'Không có') ?></p>
            <p><strong>Phương thức giao hàng:</strong> <?= htmlspecialchars($orderAddress->shipping_method ?? 'COD') ?></p>
            <p><strong>Trạng thái thanh toán:</strong> <?= htmlspecialchars($order->payment_status ?? 'Chưa thanh toán') ?></p>
            <p><strong>Ghi chú:</strong> <?= htmlspecialchars($orderAddress->note ?: 'Không có') ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($orderItems)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($orderItems as $item): ?>
                    <?php
                        $subtotal = $item->price * $item->quantity;
                        $total += $subtotal;
                        $imagePath = 'uploads/product/' . ($item->image ?? '');
                        $hasImage = !empty($item->image) && file_exists($imagePath);
                        $variantSize = $item->variant_size ?? 'Mặc định';
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item->product_name ?? 'Sản phẩm') ?></td>
                        <td>
                            <?php if ($hasImage): ?>
                                <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($item->product_name ?? '') ?>" style="width:100px; height:100px; object-fit: cover;">
                            <?php else: ?>
                                <span>Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($variantSize) ?></td>
                        <td><?= number_format($item->price, 0, ',', '.') ?></td>
                        <td><?= (int)$item->quantity ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="text-end"><strong>Tổng tiền:</strong></td>
                    <td><strong><?= number_format($total, 0, ',', '.') ?>₫</strong></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Không tìm thấy chi tiết đơn hàng này.</div>
    <?php endif; ?>

    <a href="index.php?act=myOrders" class="btn btn-secondary mt-3">Quay lại danh sách đơn hàng</a>
</div>
<?php require_once './views/layout/footer.php'; ?>
