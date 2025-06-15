<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý đơn hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Trang quản lý đơn hàng cho NN Shop" name="description" />
    <meta content="NN Dev Team" name="author" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <style>
        .order-status-waiting-confirmation { color:#ffb300; font-weight:600; } /* Chờ xác nhận */
        .order-status-waiting-pickup      { color:#9c27b0; font-weight:600; } /* Chờ lấy hàng  */
        .order-status-shipping            { color:#2196f3; font-weight:600; } /* Đang giao     */
        .order-status-shipped             { color:#00bcd4; font-weight:600; } /* Đã giao       */
        .order-status-completed           { color:#4caf50; font-weight:600; } /* Hoàn thành    */
        .order-status-cancelled           { color:#f44336; font-weight:600; } /* Đã hủy        */

        .payment-status-paid { color: green; font-weight: 600; }
        .payment-status-unpaid { color: red; font-weight: 600; }
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
                            <h4 class="mb-0">Danh sách đơn hàng</h4>
            
                        </div>
                    </div>

                    <!-- Thông báo cập nhật -->
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
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên, địa chỉ, ID đơn..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><i class="ri-search-line"></i> Tìm kiếm</button>
                        </div>
                    </form>

                    <!-- Bảng dữ liệu đơn hàng -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center"><input class="form-check-input" type="checkbox" id="selectAll"></th>
                                            <th>ID</th>
                                            <th>Khách hàng</th>
                                            <th>Điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Thanh toán</th>
                                            <th>Phương thức</th>
                                            <th>Ngày tạo</th>
                                            <th class="text-end">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                /* Map trạng thái → lớp màu */
                                                $statusClasses = [
                                                    'Chờ xác nhận'  => 'order-status-waiting-confirmation',
                                                    'Chờ lấy hàng'  => 'order-status-waiting-pickup',
                                                    'Đang giao hàng'=> 'order-status-shipping',
                                                    'Đã giao hàng'  => 'order-status-shipped',
                                                    'Hoàn thành'    => 'order-status-completed',
                                                    'Đã hủy'        => 'order-status-cancelled'
                                                ];
                                                ?>
                                        <?php if (!empty($orders)): ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox" name="selected[]" value="<?= $order['id'] ?>">
                                                    </td>
                                                    <td>#<?= $order['id'] ?></td>
                                                    <td><?= htmlspecialchars($order['shipping_name']) ?></td>
                                                    <td><?= htmlspecialchars($order['shipping_phone']) ?></td>
                                                    <td><?= number_format($order['total_amount'], 0, '.', ',') ?> VNĐ</td>
                                                    <td>
                                                        <span class="<?= $statusClasses[$order['status']] ?? 'order-status-cancelled' ?>">
                                                            <?= htmlspecialchars($order['status']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="<?= $order['payment_status'] === 'Đã thanh toán' ? 'payment-status-paid' : 'payment-status-unpaid' ?>">
                                                            <?= htmlspecialchars($order['payment_status']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= htmlspecialchars($order['payment_method'] ?? 'COD') ?></td>
                                                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                                    <td class="text-end">
                                                        <a href="index.php?act=detailOrder&id=<?= $order['id'] ?>" class="btn btn-sm btn-info d-inline-flex align-items-center gap-1 px-3 py-1 border rounded-pill shadow-sm">
                                                            <i class="ri-eye-line"></i> <span>Xem</span>
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

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>

    <script>
        document.getElementById('selectAll').onclick = function () {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        };
    </script>
</body>

</html>
