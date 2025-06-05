<?php require_once './views/layout/header.php'; ?>
<div class="container section-padding">
    <h2 class="mb-4">Chi tiết đơn hàng #<?= htmlspecialchars($_GET['order_id'] ?? '') ?></h2>

    <?php if (!empty($orderAddress)): ?>
        <div class="mb-4">
            <h4>Thông tin người nhận</h4>
            <p><strong>Họ tên:</strong> <?= htmlspecialchars($orderAddress->name) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($orderAddress->email) ?></p>
            <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($orderAddress->phone) ?></p>
            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($orderAddress->address) ?></p>
            <p><strong>Phương thức giao hàng:</strong> <?= htmlspecialchars($orderAddress->shipping_method ?? 'COD') ?></p> 
            <p><strong>Ghi chú:</strong> <?= htmlspecialchars($orderAddress->note ?: 'Không có') ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($orderItems)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($orderItems as $item): ?>
                    <?php
                        $subtotal = $item->price * $item->quantity;
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item->product_name) ?></td>
                        <td>
                            <?php if (!empty($item->image) && file_exists('uploads/product/' . $item->image)): ?>
                                <img src="uploads/product/<?= htmlspecialchars($item->image) ?>" alt="<?= htmlspecialchars($item->product_name) ?>" style="width:100px; height:100px; object-fit: cover;">
                            <?php else: ?>
                                <span>Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td><?= number_format($item->price, 0, ',', '.') ?>₫</td>
                        <td><?= htmlspecialchars($item->quantity) ?></td>
                        <td><?= number_format($subtotal, 0, ',', '.') ?>₫</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Tổng tiền:</strong></td>
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
