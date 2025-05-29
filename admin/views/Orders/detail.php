<!doctype html>
<html lang="en">
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
    <div id="layout-wrapper">
        <?php require_once "views/layouts/siderbar.php"; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4>Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h4>
                            <a href="index.php?act=Orders" class="btn btn-secondary"><i class="ri-arrow-left-line"></i> Quay lại</a>
                        </div>
                    </div>

                    <div class="card order-info">
                        <div class="card-body">
                            <h5 class="mb-3">Thông tin đơn hàng</h5>
                            <ul class="list-unstyled mb-0">
                                <li><strong>Khách hàng (User ID):</strong> <?= htmlspecialchars($order['user_id']) ?></li>
                                <li><strong>Tổng tiền:</strong> <?= number_format($order['total_amount']) ?>₫</li>
                                <li><strong>Trạng thái:</strong>
                                    <span class="status-label <?= $order['status'] == 'pending' ? 'text-warning' : ($order['status'] == 'completed' ? 'text-success' : 'text-danger') ?>">
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                </li>
                                <li><strong>Ngày đặt:</strong> <?= $order['created_at'] ?></li>
                                <li><strong>Ghi chú:</strong> <?= htmlspecialchars($order['note'] ?? 'Không có') ?></li>
                            </ul>
                        </div>
                    </div>

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
                                                    <td><?= number_format($order['total_amount'], 2, '.', ',') ?>₫</td>
                                                    <td><?= $item['quantity'] ?></td>
                                                    <td><?= number_format($item['price'] * $item['quantity']) ?>₫</td>
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
</body>
</html>
