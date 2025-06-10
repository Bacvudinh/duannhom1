<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Danh sách đơn hàng | NN Shop</title>
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

        .payment-status-paid {
            color: green;
            font-weight: 600;
        }

        .payment-status-unpaid {
            color: orange;
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

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between">
                            <h4>Danh sách đơn hàng</h4>
                        </div>
                    </div>

                    <!-- Thông báo -->
                    <?php if (isset($_GET['success']) && $_GET['success'] === 'update'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Cập nhật đơn hàng thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Form tìm kiếm -->
                    <form method="GET" action="index.php" class="row g-3 align-items-center mb-3">
                        <input type="hidden" name="act" value="Orders">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control"
                                placeholder="Tìm theo tên, địa chỉ, ID đơn..."
                                value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>

                    <!-- Bảng đơn hàng -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </th>
                                            <th>ID</th>
                                            <th>Tên KH</th>
                                            <th>Điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái đơn</th>
                                            <th>Thanh toán</th>
                                            <th>Phương thức</th>
                                            <th>Ngày tạo</th>
                                            <th class="text-end">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($orders)): ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox" name="selected[]" value="<?= $order['id'] ?>">
                                                    </td>
                                                    <td><?= $order['id'] ?></td>
                                                    <td><?= htmlspecialchars($order['shipping_name']) ?></td>
                                                    <td><?= htmlspecialchars($order['shipping_phone']) ?></td>
                                                    <td><?= number_format($order['total_amount'], 0, '.', ',') ?> VNĐ</td>
                                                    <td>
                                                        <span class="<?php
                                                            echo $order['status'] === 'Chờ xác nhận' ? 'order-status-pending' :
                                                                 ($order['status'] === 'Hoàn thành' ? 'order-status-completed' : 'order-status-cancelled');
                                                        ?>">
                                                            <?= htmlspecialchars($order['status']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="<?= $order['payment_status'] === 'Đã thanh toán' ? 'payment-status-paid' : 'payment-status-unpaid' ?>">
                                                            <?= htmlspecialchars($order['payment_status']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= htmlspecialchars($order['payment_method'] ?? 'COD') ?></td>
                                                    <td><?= $order['created_at'] ?></td>
                                                    <td class="text-end">
                                                        <a href="index.php?act=detailOrder&id=<?= $order['id'] ?>" class="btn btn-sm btn-primary">
                                                            Xem chi tiết
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="10" class="text-center text-muted">Không có đơn hàng nào.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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

    <!-- Nút back to top -->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <!-- Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>

    <script>
        // Chọn tất cả checkbox
        document.getElementById('selectAll').onclick = function () {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        };
    </script>
</body>
</html>
