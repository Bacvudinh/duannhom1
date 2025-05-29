<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>Chi tiết đơn hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
        .order-info, .order-items {
            margin-bottom: 20px;
        }
        .table-nowrap td {
            white-space: normal;
        }
        .status-label {
            font-weight: 600;
        }
    </style>
</head>
<body>
   <?php if (isset($_GET['success']) && $_GET['success'] === 'update'): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div class="toast align-items-center text-white bg-success border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>✔️ Cập nhật thành công!</strong> Trạng thái đơn hàng đã được cập nhật.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Đóng"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

    <div id="layout-wrapper">
        <?php require_once "views/layouts/siderbar.php"; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- Header -->
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4>Chi tiết đơn hàng #<?= htmlspecialchars($order['id'] ?? '') ?></h4>
                            <a href="index.php?act=Orders" class="btn btn-secondary">
                                <i class="ri-arrow-left-line"></i> Quay lại
                            </a>
                        </div>
                    </div>

                    <!-- Order Info -->
                    <div class="card order-info">
                        <div class="card-body">
                            <h5 class="mb-3">Thông tin đơn hàng</h5>
                            <ul class="list-unstyled mb-0">
                                <li><strong>Khách hàng (User ID):</strong> <?= htmlspecialchars($order['user_id'] ?? '') ?></li>
                                <li><strong>Tổng tiền:</strong> <?= number_format($order['total_amount'] ?? 0) ?>₫</li>
                                <li>
                                    <form method="POST" action="index.php?act=updateOrderStatus" class="d-flex align-items-center gap-2">
                                        <input type="hidden" name="id" value="<?= $order['id'] ?? '' ?>">
                                        <strong>Trạng thái:</strong>
                                        <select name="status" class="form-select form-select-sm w-auto" required>
                                            <?php 
                                                $statuses = [
                                                    'pending' => 'Đang chờ xử lý',
                                                    'preparing' => 'Đang chuẩn bị',
                                                    'completed' => 'Đã hoàn thành',
                                                    'cancelled' => 'Đã huỷ'
                                                ];
                                                foreach ($statuses as $key => $label): 
                                            ?>
                                                <option value="<?= $key ?>" <?= ($order['status'] ?? '') === $key ? 'selected' : '' ?>>
                                                    <?= $label ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                    </form>
                                </li>
                                <li><strong>Ngày đặt:</strong> <?= htmlspecialchars($order['created_at'] ?? '') ?></li>
                                <li><strong>Ghi chú:</strong> <?= htmlspecialchars($order['note'] ?? 'Không có') ?></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card order-items">
                        <div class="card-body">
                            <h5 class="mb-3">Sản phẩm trong đơn hàng</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($order_items)): ?>
                                            <?php foreach ($order_items as $index => $item): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= htmlspecialchars($item['product_name'] ?? 'Chưa rõ') ?></td>
                                                    <td><?= number_format($item['price'] ?? 0, 0, '.', ',') ?>₫</td>
                                                    <td><?= $item['quantity'] ?? 0 ?></td>
                                                    <td><?= number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0)) ?>₫</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Không có sản phẩm nào trong đơn hàng.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>
    <script>
    setTimeout(() => {
        const alertBox = document.querySelector('.alert');
        if (alertBox) {
            alertBox.classList.remove('show');
            alertBox.classList.add('fade');
        }
    }, 4000); // 4 giây
</script>
</body>
</html>
