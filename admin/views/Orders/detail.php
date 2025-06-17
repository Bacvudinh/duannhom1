<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark">

<head>
    <meta charset="utf-8" />
    <title>Chi tiết đơn hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/layouts/libs_css.php"; ?>
    <!-- CSS thêm vào (đặt trong <style> hoặc file riêng) -->
    <style>
        .order-status-waiting-confirmation {
            color: #ffb300;
            font-weight: 600;
        }

        /* Chờ xác nhận */
        .order-status-waiting-pickup {
            color: #9c27b0;
            font-weight: 600;
        }

        /* Chờ lấy hàng  */
        .order-status-shipping {
            color: #2196f3;
            font-weight: 600;
        }

        /* Đang giao     */
        .order-status-shipped {
            color: #00bcd4;
            font-weight: 600;
        }

        /* Đã giao       */
        .order-status-completed {
            color: #4caf50;
            font-weight: 600;
        }

        /* Hoàn thành    */
        .order-status-cancelled {
            color: #f44336;
            font-weight: 600;
        }

        /* Đã hủy        */

        .payment-status-paid {
            color: green;
            font-weight: 600;
        }

        .payment-status-unpaid {
            color: red;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php
    /* Map trạng thái → lớp màu */
    $statusClasses = [
        'Chờ xác nhận'  => 'order-status-waiting-confirmation',
        'Chờ lấy hàng'  => 'order-status-waiting-pickup',
        'Đang giao hàng' => 'order-status-shipping',
        'Đã giao hàng'  => 'order-status-shipped',
        'Hoàn thành'    => 'order-status-completed',
        'Đã hủy'        => 'order-status-cancelled'
    ];
    ?>
    <div id="layout-wrapper">
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

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
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= htmlspecialchars($_GET['error']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            Cập nhật trạng thái thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Thông tin đơn hàng -->
                    <div class="card card-animate mb-4">
                        <div class="card-body">
                            <!-- Tiêu đề chính nổi bật hơn -->
                            <h4 class="card-title mb-4 fw-bold text-primary">Thông tin đơn hàng</h4>

                            <div class="row">
                                <!-- Cột thông tin chung -->
                                <div class="col-md-6 border-end-md pe-md-4 mb-3 mb-md-0">
                                    <h6 class="fw-semibold mb-3">Thông tin chung</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Khách hàng:</strong>
                                            <?= htmlspecialchars($order['user_name'] ?? 'Chưa có') ?></li>

                                        <li><strong>Trạng thái đơn hàng:</strong>
                                            <span
                                                class="<?= $statusClasses[$order['status']] ?? 'order-status-cancelled' ?>">
                                                <?= htmlspecialchars($order['status']) ?>
                                            </span>
                                        </li>

                                        <li><strong>Trạng thái thanh toán:</strong>
                                            <span class="<?= $order['payment_status'] === 'Đã thanh toán'
                                                                ? 'payment-status-paid'
                                                                : 'payment-status-unpaid' ?>">
                                                <?= htmlspecialchars($order['payment_status']) ?>
                                            </span>
                                        </li>
                                        <li><strong>Phuong thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method'] ?? 'COD') ?></li>
                                        <li><strong>Ngày đặt hàng:</strong>
                                            <?= htmlspecialchars($order['created_at']) ?></li>
                                        <li><strong>Tổng tiền:</strong>
                                            <?= number_format($order['total_amount'], 0, '.', ',') ?>₫</li>
                                    </ul>
                                </div>

                                <!-- Cột thông tin khách hàng -->
                                <div class="col-md-6 ps-md-4">
                                    <h6 class="fw-semibold mb-3">Thông tin khách hàng</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Địa chỉ:</strong>
                                            <?= htmlspecialchars($order_items[0]['shipping_address'] ?? 'Không có') ?>
                                        </li>
                                        <li><strong>Điện thoại:</strong>
                                            <?= htmlspecialchars($order_items[0]['shipping_phone'] ?? 'Không có') ?>
                                        </li>
                                        <li><strong>Email:</strong>
                                            <?= htmlspecialchars($order_items[0]['shipping_email'] ?? 'Không có') ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Cập nhật trạng thái -->
                            <form method="POST" action="index.php?act=updateOrderStatus"
                                class="row g-3 align-items-end mt-3">
                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                <div class="col-md-4">
                                    <select class="form-select" name="status" onchange="this.form.submit()">
                                        <?php
                                        $statuses = [
                                            'Chờ xác nhận',
                                            'Xác nhận',
                                            'Đang giao hàng',
                                            'Đã giao hàng',
                                            'Hoàn thành',
                                            'Đã hủy'
                                        ];
                                        foreach ($statuses as $status):
                                            if (
                                                $status === 'Hoàn thành' &&
                                                ($order['payment_status'] !== 'Đã thanh toán' || $order['customer_confirmed'] != 1)
                                            ) continue;
                                        ?>
                                            <option value="<?= $status ?>"
                                                <?= $order['status'] === $status ? 'selected' : '' ?>>
                                                <?= $status ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>



                    <!-- Chi tiết sản phẩm -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Sản phẩm trong đơn hàng</h5>

                            <?php if (!empty($order_items)): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-center">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Hình ảnh </th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Size</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $grand_total = 0;
                                            foreach ($order_items as $item):
                                                $item_total = $item['price'] * $item['quantity'];
                                                $grand_total += $item_total;
                                            ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                                                    <td><img src="../uploads/product/<?= htmlspecialchars($item['product_img']) ?>"
                                                            alt="<?= htmlspecialchars($item['product_img']) ?>"
                                                            style="width:100px;height:100px;"></td>
                                                    <td><?= number_format($item['price'], 0, '.', ',') ?> VNĐ</td>
                                                    <td><?= $item['quantity'] ?></td>
                                                    <td><?= htmlspecialchars($item['variant_size']) ?></td>
                                                    <td><?= number_format($item_total, 0, '.', ',') ?> VNĐ</td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                                                <td class="fw-bold"><?= number_format($grand_total, 0, '.', ',') ?> VNĐ</td>
                                            </tr>
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

            <!-- Footer -->
            <footer class="footer mt-auto">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © NN Shop.
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