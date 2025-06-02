<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Chi tiết đơn hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
        .order-status-pending {
            color: orange;
            font-weight: 600;
        }

        .order-status-completed {
            color: green;
            font-weight: 600;
        }

        .order-status-cancelled {
            color: red;
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

                    <!-- Tiêu đề -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h4>
                            </div>
                        </div>
                    </div>

                    <!-- Thông báo -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($_GET['error']) ?></div>
                    <?php endif; ?>
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success mt-3">Cập nhật trạng thái thành công!</div>
                    <?php endif; ?>

                    <!-- Thông tin đơn hàng -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <p><strong>Khách hàng (User ID):</strong> <?= htmlspecialchars($order['user_id']) ?></p>
                            <p><strong>Trạng thái:</strong> 
                                <span class="<?php
                                    echo $order['status'] === 'Chờ xác nhận' ? 'order-status-pending' :
                                        ($order['status'] === 'Hoàn thành' ? 'order-status-completed' : 'order-status-cancelled');
                                ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </p>
                            <p><strong>Ngày đặt hàng:</strong> <?= $order['created_at'] ?></p>
                            <p><strong>Tổng tiền:</strong> <?= number_format($order['total_amount'], 0, '.', ',') ?>₫</p>

                            <!-- Form cập nhật trạng thái -->
                            <form method="POST" action="index.php?act=updateOrderStatus" class="row g-3 align-items-end">
                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Cập nhật trạng thái</label>
                                    <select class="form-select" name="status" id="status" required>
                                        <option value="Chờ xác nhận" <?= $order['status'] == 'Chờ xác nhận' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                        <option value="Chờ lấy hàng" <?= $order['status'] == 'Chờ lấy hàng' ? 'selected' : '' ?>>Chờ lấy hàng</option>
                                        <option value="Đang giao hàng" <?= $order['status'] == 'Đang giao hàng' ? 'selected' : '' ?>>Đang giao hàng</option>
                                        <option value="Đã giao hàng" <?= $order['status'] == 'Đã giao hàng' ? 'selected' : '' ?>>Đã giao hàng</option>
                                        <option value="Hoàn thành" <?= $order['status'] == 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="Đã huỷ" <?= $order['status'] == 'Đã huỷ' ? 'selected' : '' ?>>Đã huỷ</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Chi tiết sản phẩm -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5>Chi tiết sản phẩm trong đơn hàng</h5>
                            <?php if (!empty($order_items)): ?>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order_items as $item): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                                                    <td><?= number_format($item['price'], 0, '.', ',') ?>₫</td>
                                                    <td><?= $item['quantity'] ?></td>
                                                    <td><?= number_format($item['price'] * $item['quantity'], 0, '.', ',') ?>₫</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p>Không có sản phẩm nào trong đơn hàng này.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>
</body>

</html>
