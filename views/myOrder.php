<?php require_once './views/layout/header.php'; ?>

<div class="container section-padding">
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php elseif (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <h2 class="mb-4">Đơn hàng của bạn</h2>

    <?php if (!empty($orders)): ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order->id) ?></td>
                        <td><?= htmlspecialchars($order->created_at) ?></td>
                        <td><?= number_format($order->total_amount, 0, '.', ',') ?>₫</td>
                        <td class="<?= 
                            $order->status == 'Chờ xác nhận' ? 'order-status-waiting-confirmation' :
                            ($order->status == 'Chờ lấy hàng' ? 'order-status-waiting-pickup' :
                            ($order->status == 'Đang giao hàng' ? 'order-status-shipping' :
                            ($order->status == 'Đã giao hàng' ? 'order-status-shipped' :
                            ($order->status == 'Hoàn thành' ? 'order-status-completed' :
                            'order-status-cancelled')))) ?>">
                            <?= $statuses[$order->status] ?? ucfirst($order->status) ?>
                        </td>
                        <td><?= htmlspecialchars($order->payment_status) ?? 'Chưa thanh toán' ?></td>
                        <td>
                            <a href="index.php?act=orderDetails&order_id=<?= $order->id ?>" class="btn btn-sm btn-primary">
                                Xem chi tiết
                            </a>
                            <?php if ($order->status == 'Chờ xác nhận'): ?>
                                <a href="index.php?act=cancelOrder&order_id=<?= $order->id ?>" 
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')"
                                class="btn btn-sm btn-danger mt-1">
                                    Hủy đơn
                                </a>
                            <?php endif; ?>
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