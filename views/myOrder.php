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
                    <th>Phương Thức TT</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order->id) ?></td>
                        <td><?= htmlspecialchars($order->created_at) ?></td>
                        <td><?= htmlspecialchars($order->payment_method) ?></td>
                        <td><?= number_format($order->total_amount, 0, '.', ',') ?> VNĐ</td>
                        <td class="
                                <?= $order->status == 'Chờ xác nhận' ? 'order-status-waiting-confirmation' : ($order->status == 'Chờ lấy hàng' ? 'order-status-waiting-pickup' : ($order->status == 'Đang giao hàng' ? 'order-status-shipping' : ($order->status == 'Đã giao hàng' ? 'order-status-shipped' : ($order->status == 'Hoàn thành' ? 'order-status-completed' :
                                    'order-status-cancelled')))) ?>">
                            <?= $statuses[$order->status] ?? ucfirst($order->status) ?>
                        </td>
                        <td>
                            <span class="<?= ($order->payment_status ?? 'Chưa thanh toán') === 'Đã thanh toán'
                                                ? 'payment-status-paid'
                                                : 'payment-status-unpaid'; ?>">
                                <?= $order->payment_status ?? 'Chưa thanh toán' ?>
                            </span>
                        </td>
                        <td>
                            <a href="index.php?act=orderDetails&order_id=<?= $order->id ?>" class="btn btn-sm btn-primary">
                                Xem chi tiết
                            </a>
                            <?php if (in_array($order->status, ['Chờ xác nhận', 'Xác nhận'])): ?>
                                <a href="index.php?act=cancelOrder&order_id=<?= $order->id ?>"
                                    onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')"
                                    class="btn btn-sm btn-danger mt-1">
                                    Hủy đơn
                                </a>

                            <?php endif; ?>
                              <?php if ($order->payment_method === 'cod' && $order->status === 'Đã giao hàng' && $order->payment_status !== 'Đã thanh toán'): ?>
        <form method="post" action="index.php?act=updatePaymentStatus">
            <input type="hidden" name="order_id" value="<?= $order->id ?>">
            <input type="hidden" name="new_status" value="Đã thanh toán">
            <button type="submit" class="btn btn-sm btn-success mt-1">Đã thanh toán</button>
        </form>
    <?php endif; ?>

    <?php if ($order->payment_method === 'vnpay' && $order->status === 'Đã giao hàng' && $order->customer_confirmed == 0): ?>
        <form action="index.php?act=confirmReceived" method="post">
            <input type="hidden" name="order_id" value="<?= $order->id ?>">
            <button type="submit" class="btn btn-sm btn-success mt-1">Tôi đã nhận hàng</button>
        </form>
    <?php endif; ?>

                            </form>
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