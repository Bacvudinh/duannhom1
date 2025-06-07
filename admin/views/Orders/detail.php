<!doctype html>
<html lang="en"
    data-layout="vertical"
    data-topbar="light"
    data-sidebar="dark"
    data-sidebar-size="lg"
    data-sidebar-image="none"
    data-preloader="disable"
    data-theme="default"
    data-theme-colors="default">

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

        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- Tiêu đề -->
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h4>
                            <a href="index.php?act=Orders" class="btn btn-secondary">Quay lại danh sách</a>
                        </div>
                    </div>

                    <!-- Thông báo -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($_GET['error']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Cập nhật trạng thái thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Thông tin đơn hàng -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Thông tin đơn hàng</h5>
                            <ul class="list-unstyled mb-4">
                                <li><strong>Khách hàng:</strong> <?= htmlspecialchars($order['user_name']) ?></li>
                                <li><strong>Trạng thái:</strong>
                                    <span class="<?php
                                        echo $order['status'] === 'Chờ xác nhận' ? 'order-status-pending' :
                                             ($order['status'] === 'Hoàn thành' ? 'order-status-completed' : 'order-status-cancelled');
                                    ?>">
                                        <?= htmlspecialchars($order['status']) ?>
                                    </span>
                                </li>
                                <li><strong>Ngày đặt hàng:</strong> <?= $order['created_at'] ?></li>
                                <li><strong>Tổng tiền:</strong> <?= number_format($order['total_amount'], 0, '.', ',') ?>₫</li>
                            </ul>

                            <!-- Cập nhật trạng thái -->
                            <form method="POST" action="index.php?act=updateOrderStatus" class="row g-3 align-items-end">
                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Cập nhật trạng thái</label>
                                    <select class="form-select" name="status">
                                        <option value="Chờ xác nhận" <?= $order['status'] === 'Chờ xác nhận' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                        <option value="Chờ lấy hàng" <?= $order['status'] === 'Chờ lấy hàng' ? 'selected' : '' ?>>Chờ lấy hàng</option>
                                        <option value="Đang giao hàng" <?= $order['status'] === 'Đang giao hàng' ? 'selected' : '' ?>>Đang giao hàng</option>
                                        <option value="Hoàn thành" <?= $order['status'] === 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="Đã hủy" <?= $order['status'] === 'Đã hủy' ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Chi tiết sản phẩm -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Sản phẩm trong đơn hàng</h5>

                            <?php if (!empty($order_items)): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Địa chỉ</th>
                                                <th>Điện thoại</th>
                                                <th>Email</th>
                                                <th>Trạng thái</th>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order_items as $item): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($item['shipping_address']) ?></td>
                                                    <td><?= htmlspecialchars($item['shipping_phone']) ?></td>
                                                    <td><?= htmlspecialchars($item['shipping_email']) ?></td>
                                                    <td><?= htmlspecialchars($item['status']) ?></td>
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
                                <p class="text-muted">Không có sản phẩm nào trong đơn hàng này.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © NN Shop.
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            Thiết kế & phát triển bởi nhóm bạn.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>
</body>

</html>
