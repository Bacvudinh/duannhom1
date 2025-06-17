<?php require_once './views/layout/header.php'; ?>

<div class="container section-padding">
     <?php
        /* Ánh xạ trạng thái → lớp CSS */
        $statusClasses = [
            'Chờ xác nhận'   => 'order-status-waiting-confirmation',
            'Chờ lấy hàng'   => 'order-status-waiting-pickup',
            'Đang giao hàng' => 'order-status-shipping',
            'Đã giao hàng'   => 'order-status-shipped',
            'Hoàn thành'     => 'order-status-completed',
            'Đã hủy'         => 'order-status-cancelled'
        ];
        ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php elseif (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <h2 class="mb-4">Chi tiết đơn hàng #<?= htmlspecialchars($order->id ?? '') ?></h2>

    <div class="row">
        <!-- Thông tin chung -->
        <div class="col-md-6 mb-4">
            <h4>Thông tin chung</h4>
            <p><strong>Mã đơn hàng:</strong> <?= htmlspecialchars($order->order_code ?? $order->id) ?></p>
            <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($order->created_at) ?></p>
            <p><strong>Trạng thái đơn:</strong>
                <span class="<?= $statusClasses[$order->status] ?? 'order-status-cancelled' ?>">
                    <?= htmlspecialchars($order->status) ?>
                </span>
            </p>
            <p><strong>Phương thức giao:</strong> <?= htmlspecialchars($order->payment_method    ?? 'COD') ?></p>
            <p><strong>Thanh toán:</strong>
                <span class="<?= ($order->payment_status ?? 'Chưa thanh toán') === 'Đã thanh toán'
                    ? 'payment-status-paid'
                    : 'payment-status-unpaid' ?>">
                    <?= htmlspecialchars($order->payment_status ?? 'Chưa thanh toán') ?>
                </span>
            </p>
            <p><strong>Ghi chú:</strong> <?= htmlspecialchars($orderAddress->note ?: 'Không có') ?></p>
        </div>

        <!-- Thông tin người nhận -->
        <div class="col-md-6 mb-4">
            <h4>Thông tin người nhận</h4>
            <p><strong>Họ tên:</strong> <?= htmlspecialchars($orderAddress->name) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($orderAddress->email) ?></p>
            <p><strong>SĐT:</strong> <?= htmlspecialchars($orderAddress->phone) ?></p>
            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($orderAddress->address) ?></p>
        </div>
    </div>
   

    <?php if (!empty($orderItems)): ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Size</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($orderItems as $item): ?>
                    <?php
                        $subtotal  = $item->price * $item->quantity;
                        $total    += $subtotal;
                        $imagePath = 'uploads/product/' . ($item->image ?? '');
                        $hasImage  = !empty($item->image) && file_exists($imagePath);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item->product_name) ?></td>
                        <td>
                            <?php if ($hasImage): ?>
                                <img src="<?= htmlspecialchars($imagePath) ?>" alt="" style="width:100px;height:100px;object-fit:cover;">
                            <?php else: ?>
                                Không có ảnh
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($item->variant_size ?? 'Mặc định') ?></td>
                        <td><?= number_format($item->price, 0, ',', '.') ?></td>
                        <td><?= (int)$item->quantity ?></td>
                        <td><?= number_format($subtotal, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>

                <!-- Hành động: Hủy / Đã thanh toán -->
                

                <!-- Tổng tiền -->
                <tr>
                    <td colspan="5" class="text-end"><strong>Tổng tiền:</strong></td>
                    <td><strong><?= number_format($total, 0, ',', '.') ?> VNĐ</strong></td>
                </tr>
                <tr>
                    <td colspan="6" class="text-end">
                        <?php if (in_array($order->status, ['Chờ xác nhận', 'Xác nhận'])): ?>
                            <a href="index.php?act=cancelOrder&order_id=<?= $order->id ?>"
                               onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')"
                               class="btn btn-sm btn-danger">
                               Hủy đơn
                            </a>
                        <?php elseif ($order->status === 'Đã giao hàng' && ($order->payment_status ?? 'Chưa thanh toán') === 'Chưa thanh toán'): ?>
                            <form method="post" action="index.php?act=updatePaymentStatus" class="d-inline">
                                <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                <input type="hidden" name="new_status" value="Đã thanh toán">
                                <button type="submit" class="btn btn-sm btn-success">Đã thanh toán</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Không tìm thấy chi tiết đơn hàng này.</div>
    <?php endif; ?>

    <a href="index.php?act=myOrders" class="btn btn-secondary mt-3">Quay lại danh sách đơn hàng</a>
</div>

<?php require_once './views/layout/footer.php'; ?>
