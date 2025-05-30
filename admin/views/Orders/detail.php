<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Quản lý đơn hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
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

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Danh sách đơn hàng</h4>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <?php
                            if ($_GET['success'] == 'update') echo "Cập nhật đơn hàng thành công!";
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                                        </div>
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Khách hàng (User ID)</th>
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
                                                            <td><?= htmlspecialchars($order['id']) ?></td>
                                                            <td><?= htmlspecialchars($order['user_id']) ?></td>
                                                            <td><?= number_format($order['total_amount'], 2, '.', ',') ?>₫</td>
                                                            <td class="<?= 
                                                                $order['status'] == 'pending' ? 'order-status-pending' : 
                                                                ($order['status'] == 'completed' ? 'order-status-completed' : 'order-status-cancelled') ?>">
                                                                <?= ucfirst($order['status']) ?>
                                                            </td>
                                                            <td><?= $order['created_at'] ?></td>
                                                            <td class="text-end">
                                                                <div class="hstack gap-3 flex-wrap justify-content-end">
                                                                    <a href="index.php?act=detailOrder&id=<?= $order['id'] ?>" class="btn btn-sm btn-info">
                                                                        <i class="ri-eye-line"></i> Xem
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center">Không có đơn hàng nào.</td>
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
        </div>
    </div>

    <?php require_once "views/layouts/libs_js.php"; ?>

    <script>
        // Select all checkboxes
        document.getElementById('selectAll').onclick = function () {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        };
    </script>
</body>

</html>
