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

                    <!-- Tiêu đề trang -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <h4 class="mb-0">Danh sách đơn hàng</h4>
                                <a href="index.php?act=createOrder" class="btn btn-soft-success">
                                    <i class="ri-add-circle-line me-1"></i> Thêm đơn hàng
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Thông báo thành công -->
                    <?php if (isset($_GET['success']) && $_GET['success'] === 'update'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Cập nhật đơn hàng thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                    <!-- Danh sách đơn hàng -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
                                            <th>Điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th class="text-end">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($orders)): ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="selected[]" value="<?= $order['id'] ?>">
                                                        </div>
                                                    </td>
                                                    <td><?= $order['id'] ?></td>
                                                    <td><?= htmlspecialchars($order['shipping_name']) ?></td>
                                                    <td><?= htmlspecialchars($order['shipping_phone']) ?></td>
                                                    <td><?= number_format($order['total_amount'], 0, '.', ',') ?>₫</td>
                                                    <td>
                                                        <span class="<?php
                                                            echo $order['status'] === 'Chờ xác nhận' ? 'order-status-pending' :
                                                                 ($order['status'] === 'Hoàn thành' ? 'order-status-completed' : 'order-status-cancelled');
                                                        ?>">
                                                            <?= htmlspecialchars($order['status']) ?>
                                                        </span>
                                                    </td>
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
                                                <td colspan="8" class="text-center text-muted">Không có đơn hàng nào.</td>
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

    <!-- Nút back-to-top -->
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

    <!-- Customizer -->
    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2"
             data-bs-toggle="offcanvas"
             data-bs-target="#theme-settings-offcanvas"
             aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- JavaScript -->
    <?php require_once "views/layouts/libs_js.php"; ?>

    <!-- Chọn tất cả checkbox -->
    <script>
        document.getElementById('selectAll').onclick = function () {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        };
    </script>
</body>
</html>
