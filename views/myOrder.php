<?php require_once './views/layout/header.php'; ?>

<div class="container section-padding">
    <h2 class="mb-4">Đơn hàng của bạn</h2>

    <?php if (!empty($orders)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order->id) ?></td>
                        <td><?= htmlspecialchars($order->created_at) ?></td>
                       <td><?= number_format($order->total_amount, 2) ?>₫</td>

                        <td>
                            <a href="index.php?act=orderDetails&order_id=<?= $order->id ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3">Quay lại cửa hàng</a>
</div>

<?php require_once './views/layout/footer.php'; ?>
