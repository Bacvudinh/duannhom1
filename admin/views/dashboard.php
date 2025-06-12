<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Trang tổng quan | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Dashboard thống kê quản lý NN Shop" name="description" />
    <meta content="NN Dev Team" name="author" />
    <?php require_once "views/layouts/libs_css.php"; ?>

    <style>
        /* Màu chữ cho trạng thái (dùng ở trang chi tiết / nơi cần text màu) */
        .order-status-waiting-confirmation { color:#ffb300; font-weight:600; } /* Chờ xác nhận */
        .order-status-waiting-pickup      { color:#9c27b0; font-weight:600; } /* Chờ lấy hàng  */
        .order-status-shipping            { color:#2196f3; font-weight:600; } /* Đang giao     */
        .order-status-shipped             { color:#00bcd4; font-weight:600; } /* Đã giao       */
        .order-status-completed           { color:#4caf50; font-weight:600; } /* Hoàn thành    */
        .order-status-cancelled           { color:#f44336; font-weight:600; } /* Đã hủy        */

        .payment-status-paid   { color:#4caf50; font-weight:600; }
        .payment-status-unpaid { color:#f44336; font-weight:600; }

        /* Badge nền cho bảng “Đơn hàng gần nhất” */
        .badge-waiting-confirmation { background:#ffb300; color:#fff; font-weight:600; }
        .badge-waiting-pickup      { background:#9c27b0; color:#fff; font-weight:600; }
        .badge-shipping            { background:#2196f3; color:#fff; font-weight:600; }
        .badge-shipped             { background:#00bcd4; color:#fff; font-weight:600; }
        .badge-completed           { background:#4caf50; color:#fff; font-weight:600; }
        .badge-cancelled           { background:#f44336; color:#fff; font-weight:600; }
    </style>
</head>

<body>
<?php
/* Map trạng thái → lớp badge (dùng cho cột Trạng thái) */
$badgeClasses = [
    'Chờ xác nhận'  => 'badge-waiting-confirmation',
    'Chờ lấy hàng'  => 'badge-waiting-pickup',
    'Đang giao hàng'=> 'badge-shipping',
    'Đã giao hàng'  => 'badge-shipped',
    'Hoàn thành'    => 'badge-completed',
    'Đã hủy'        => 'badge-cancelled'
];
?>

<div id="layout-wrapper">
    <?php require_once "views/layouts/siderbar.php"; ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- Tiêu đề -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Tổng quan cửa hàng</h4>
                        </div>
                    </div>
                </div>

                <!-- Thống kê nhanh -->
                <div class="row">
                    <?php
                    $stats = [
                        ['label'=>'Tổng doanh thu','icon'=>'bx-dollar-circle',
                         'value'=>number_format($data['totalRevenue'],0,',','.').' VND','color'=>'success'],
                        ['label'=>'Tổng đơn hàng','icon'=>'bx-shopping-bag',
                         'value'=>$data['totalOrders'],'color'=>'info'],
                        ['label'=>'Khách hàng','icon'=>'bx-user',
                         'value'=>$data['totalCustomers'],'color'=>'warning'],
                        ['label'=>'Số dư hiện tại','icon'=>'bx-wallet',
                         'value'=>number_format($data['myBalance'],0,',','.').' VND','color'=>'primary']
                    ];
                    foreach ($stats as $stat): ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            <span class="avatar-title bg-<?= $stat['color'] ?>-subtle text-<?= $stat['color'] ?> rounded fs-3">
                                                <i class="bx <?= $stat['icon'] ?>"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-1 text-uppercase fw-medium fs-12"><?= $stat['label'] ?></p>
                                            <h4 class="mb-0 fs-20 fw-semibold ff-secondary"><?= $stat['value'] ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Sản phẩm bán chạy nhất -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title mb-0">Top sản phẩm bán chạy</h4></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sản phẩm</th><th>Giá</th><th>Đã bán</th>
                                                <th>Tồn kho</th><th>Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data['bestSellingProducts'] as $p): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($p['name']) ?></td>
                                                <td><?= number_format($p['price'],0,',','.') ?> VND</td>
                                                <td><?= $p['total_sold'] ?></td>
                                                <td><?= $p['stock'] ?></td>
                                                <td><?= number_format($p['total_revenue'],0,',','.') ?> VND</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($data['bestSellingProducts'])): ?>
                                            <tr><td colspan="5" class="text-center text-muted">Không có dữ liệu.</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Đơn hàng gần nhất -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title mb-0">Đơn hàng gần nhất</h4></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Mã đơn</th><th>Khách hàng</th><th>Ngày đặt</th>
                                                <th>Trạng thái</th><th>Tổng tiền</th><th>Chi tiết</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data['latestOrders'] as $o): ?>
                                            <tr>
                                                <td>#<?= $o['id'] ?></td>
                                                <td><?= htmlspecialchars($o['customer_name']) ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($o['order_date'])) ?></td>
                                                <td>
                                                    <span class="badge <?= $badgeClasses[$o['status']] ?? 'badge-cancelled' ?>">
                                                        <?= htmlspecialchars($o['status']) ?>
                                                    </span>
                                                </td>
                                                <td><?= number_format($o['total_amount'],0,',','.') ?> VND</td>
                                                <td>
                                                    <a href="index.php?act=detailOrder&id=<?= $o['id'] ?>" 
                                                       class="btn btn-sm btn-outline-primary">Xem</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($data['latestOrders'])): ?>
                                            <tr><td colspan="6" class="text-center text-muted">Không có đơn hàng nào.</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- container-fluid -->
        </div><!-- page-content -->
    </div><!-- main-content -->
</div><!-- layout-wrapper -->

<?php require_once "views/layouts/libs_js.php"; ?>
</body>
</html>
