<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Dashboard | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "layouts/libs_css.php";
    ?>

</head>

<body>
    <div id="layout-wrapper">

        <?php require_once "layouts/header.php"; ?>
        <?php require_once "layouts/siderbar.php"; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="d-flex flex-column gap-4">

                        <!-- Greeting -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="fs-16 mb-1">Good Morning, Admin!</h4>
                                <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                            </div>
                            <div>
                                <button type="button" class="btn btn-soft-info btn-icon waves-effect layout-rightside-btn">
                                    <i class="ri-pulse-line"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="row g-4">
                            <?php $stats = [
                                ['label' => 'Tổng doanh thu', 'icon' => 'bx-dollar-circle', 'value' => number_format($data['totalRevenue'], 0, ',', '.') . ' VND', 'trend' => '+100%', 'color' => 'success'],
                                ['label' => 'Orders', 'icon' => 'bx-shopping-bag', 'value' => $data['totalOrders'], 'trend' => '-3.57%', 'color' => 'danger'],
                                ['label' => 'Customers', 'icon' => 'bx-user-circle', 'value' => $data['totalCustomers'], 'trend' => '+29.08%', 'color' => 'success'],
                                ['label' => 'My Balance', 'icon' => 'bx-wallet', 'value' => number_format($data['myBalance'], 2, '.', '') . ' VND', 'trend' => '+0.00%', 'color' => 'primary']
                            ]; ?>

                            <?php foreach ($stats as $stat): ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"><?= $stat['label'] ?></p>
                                                <h5 class="text-<?= $stat['color'] ?> fs-14 mb-0">
                                                    <i class="ri-arrow-right-<?= $stat['trend'][0] === '+' ? 'up' : 'down' ?>-line fs-13 align-middle"></i>
                                                    <?= $stat['trend'] ?>
                                                </h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4">
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                                    <?= $stat['value'] ?>
                                                </h4>
                                                <span class="avatar-title bg-<?= $stat['color'] ?>-subtle rounded fs-3">
                                                    <i class="bx <?= $stat['icon'] ?> text-<?= $stat['color'] ?>"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Best Selling Products -->
                        <div class="card card-height-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Sản phẩm bán chạy nhất</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-muted dropdown-btn" data-bs-toggle="dropdown">
                                        <?= ucfirst(str_replace(['today','yesterday','last7days','last30days','thismonth','lastmonth'], ['Today','Yesterday','Last 7 Days','Last 30 Days','This Month','Last Month'], $range)) ?>
                                        <i class="mdi mdi-chevron-down ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <?php foreach (['today','yesterday','last7days','last30days','thismonth','lastmonth'] as $r): ?>
                                            <a class="dropdown-item" href="?act=dashboard&range=<?= $r ?>"><?= ucfirst(str_replace('last', 'Last ', $r)) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Đã bán</th>
                                                <th>Tồn kho</th>
                                                <th>Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['bestSellingProducts'] as $product): ?>
                                                <tr>
                                                    <td class="d-flex align-items-center gap-2">
                                                        <img src="assets/images/products/<?= htmlspecialchars($product['image'] ?? 'default.png') ?>" class="img-thumbnail" style="width:40px; height:40px; object-fit:cover;" alt="">
                                                        <div>
                                                            <h6 class="mb-0"><?= htmlspecialchars($product['name']) ?></h6>
                                                            <small class="text-muted"><?= date('d M Y', strtotime('-1 day')) ?></small>
                                                        </div>
                                                    </td>
                                                    <td><?= number_format($product['price'], 2) ?> VND</td>
                                                    <td><?= $product['total_sold'] ?></td>
                                                    <td><?= $product['stock'] ?></td>
                                                    <td><?= number_format($product['total_revenue'], 2) ?> VND</td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if (empty($data['bestSellingProducts'])): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">Không có dữ liệu trong khoảng thời gian này.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Latest Orders -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Đơn hàng gần nhất</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Mã đơn</th>
                                                <th>Khách hàng</th>
                                                <th>Ngày đặt</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng tiền</th>
                                                <th>Chi tiết</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['latestOrders'] as $order): ?>
                                                <tr>
                                                    <td>#<?= $order['order_id'] ?></td>
                                                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                                    <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                                                    <td><span class="badge bg-<?= $order['status'] === 'Hoàn thành' ? 'success' : 'secondary' ?>"><?= $order['status'] ?></span></td>
                                                    <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VND</td>
                                                    <td><a href="?act=order-detail&id=<?= $order['order_id'] ?>" class="btn btn-sm btn-outline-primary">Xem</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if (empty($data['latestOrders'])): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">Không có đơn hàng nào gần đây.</td>
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

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © NN Shop.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
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

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <?php require_once "layouts/libs_js.php"; ?>
</body>

</html>