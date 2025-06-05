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
                                <h4 class="mb-sm-0">Danh sách đơn hàng</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Thông báo -->
                    <?php if (isset($_GET['success']) && $_GET['success'] === 'update'): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        Cập nhật đơn hàng thành công!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>

                    <!-- Form tìm kiếm -->
                    <form method="GET" action="index.php" class="row g-3 mb-3">
                        <input type="hidden" name="act" value="Orders">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control"
                                placeholder="Tìm theo tên, địa chỉ, ID đơn..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>

                    <!-- Bảng danh sách đơn hàng -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                    <thead>
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
                                                        <input class="form-check-input" type="checkbox" name="selected[]"
                                                            value="<?= $order['id'] ?>">
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
                                                    <a href="index.php?act=detailOrder&id=<?= $order['id'] ?>"
                                                        class="btn btn-sm btn-primary">
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
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>

    <script>
    // Chọn tất cả checkbox
    document.getElementById('selectAll').onclick = function () {
        const checkboxes = document.querySelectorAll('input[name="selected[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    };
    </script>
</body>

</html>
