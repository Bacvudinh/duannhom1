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

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "layouts/header.php";

        require_once "layouts/siderbar.php";
        ?>
        
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1">Good Morning, Admin!</h4>
                                                <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                            </div>
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <div class="col-auto">
                                                            <!-- <button type="button" class="btn btn-soft-success material-shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button> -->
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-info btn-icon waves-effect material-shadow-none waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <div class="col-xl-3 col-md-6">
    <!-- card -->
    <div class="card card-animate">
    <div class="card-body">
        <!-- Header -->
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 overflow-hidden">
                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng doanh thu</p>
            </div>
            <div class="flex-shrink-0">
                <h5 class="text-success fs-14 mb-0">
                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +100%
                </h5>
            </div>
        </div>

        <!-- Body Content -->
        <div class="d-flex align-items-end justify-content-between mt-4">
            <div>
                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                    <?= number_format($data['totalRevenue'], 0, ',', '.') ?> VND
                </h4>
                <a href="#" class="text-decoration-underline">Xem chi tiết</a>
            </div>
            <div class="avatar-sm flex-shrink-0">
                <span class="avatar-title bg-success-subtle rounded fs-3">
                    <i class="bx bx-dollar-circle text-success"></i>
                </span>
            </div>
        </div>
    </div>
</div>

</div><!-- end col -->

                                    <div class="row">
    <!-- Tổng số đơn hàng -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-danger fs-14 mb-0">
                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                            <span class="counter-value" data-target="<?= $data['totalOrders'] ?>">0</span>
                        </h4>
                        <a href="#" class="text-decoration-underline">View all orders</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-info-subtle rounded fs-3">
                            <i class="bx bx-shopping-bag text-info"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tổng số khách hàng -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-success fs-14 mb-0">
                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                            <span class="counter-value" data-target="<?= $data['totalCustomers'] ?>">0</span>
                        </h4>
                        <a href="#" class="text-decoration-underline">See details</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                            <i class="bx bx-user-circle text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Số dư hiện tại (My Balance / Tổng doanh thu đã thanh toán) -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">My Balance</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-muted fs-14 mb-0">+0.00 %</h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                            <span class="counter-value" data-target="<?= number_format($data['myBalance'], 2, '.', '') ?>"></span> VND
                        </h4>
                        <a href="#" class="text-decoration-underline">Withdraw money</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                            <i class="bx bx-wallet text-primary"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->


                             <div class="row">
    <div class="col-xl-8">
        <div class="card">
            <!-- Tiêu đề và nút lọc -->
            <div class="card-header border-0 align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Doanh thu</h4>
                <div>
                    <?php 
                        $currentFilter = $_GET['filter'] ?? '1Y'; // Mặc định lọc theo 1 năm
                        $filters = ['ALL', '1M', '6M', '1Y']; // Các mốc thời gian
                        foreach ($filters as $f):
                    ?>
                        <a href="?filter=<?= $f ?>" 
                           class="btn btn-soft-<?= $currentFilter == $f ? 'primary' : 'secondary' ?> material-shadow-none btn-sm">
                            <?= $f ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Thống kê 4 ô số liệu -->
            <div class="card-header p-0 border-0 bg-light-subtle">
                <div class="row g-0 text-center">
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1">
                                <span class="counter-value" data-target="<?= number_format($data['totalOrders'], 0, ',', '.') ?>">0</span>
                            </h5>
                            <p class="text-muted mb-0">Đơn hàng</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1">
                                <span class="counter-value" data-target="<?= number_format($data['totalRevenue'], 0, ',', '.') ?>">0</span> VND
                            </h5>
                            <p class="text-muted mb-0">Doanh thu</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1"><span class="counter-value" data-target="0">0</span></h5>
                            <p class="text-muted mb-0">Hoàn tiền</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                            <h5 class="mb-1 text-success"><span class="counter-value" data-target="0">0</span>%</h5>
                            <p class="text-muted mb-0">Tỷ lệ chuyển đổi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ ApexCharts -->
            <div class="card-body p-0 pb-2">
                <div class="w-100">
                    <div id="customer_impression_charts" 
                         data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                         class="apex-charts" dir="ltr" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


                              <div class="col-xxl-4">
    <div class="card card-height-100">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bán chạy nhất</h4>
            <div class="flex-shrink-0">
                <div class="dropdown card-header-dropdown">
                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted">
                            <?= ucfirst(str_replace(
                                ['today', 'yesterday', 'last7days', 'last30days', 'thismonth', 'lastmonth'],
                                ['Today', 'Yesterday', 'Last 7 Days', 'Last 30 Days', 'This Month', 'Last Month'],
                                $range
                            )) ?>
                            <i class="mdi mdi-chevron-down ms-1"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="?act=dashboard&range=today">Today</a>
                        <a class="dropdown-item" href="?act=dashboard&range=yesterday">Yesterday</a>
                        <a class="dropdown-item" href="?act=dashboard&range=last7days">Last 7 Days</a>
                        <a class="dropdown-item" href="?act=dashboard&range=last30days">Last 30 Days</a>
                        <a class="dropdown-item" href="?act=dashboard&range=thismonth">This Month</a>
                        <a class="dropdown-item" href="?act=dashboard&range=lastmonth">Last Month</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                    <thead class="text-muted table-light">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Đã bán</th>
                            <th>Tồn kho</th>
                            <th>Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['bestSellingProducts'] as $product): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/products/<?= htmlspecialchars($product['image'] ?? 'default.png') ?>" 
                                        alt="" class="img-fluid d-block" />
                                        <div>
                                            <h5 class="fs-14 my-1">
                                                <a href="#" class="text-reset"><?= htmlspecialchars($product['name']) ?></a>
                                            </h5>
                                            <span class="text-muted"><?= date('d M Y', strtotime('-1 day')) ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?= number_format($product['price'], 2) ?> VND</h5>
                                    <span class="text-muted">Price</span>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?= $product['total_sold'] ?></h5>
                                    <span class="text-muted">Orders</span>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?= $product['stock'] ?></h5>
                                    <span class="text-muted">Stock</span>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?= number_format($product['total_revenue'], 2) ?> VND </h5>
                                    <span class="text-muted">Amount</span>
                                </td>
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


                                                    </table>
                        

                                                
                                            </div>
                                        </div>
                                    </div>

                                   <!-- end row-->

                            </div> <!-- end .h-100-->

                        </div> <!-- end col -->
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Velzon.
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
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <?php
    require_once "layouts/libs_js.php";
    ?>
    <!-- Script xử lý biểu đồ Apex -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const rawData = <?= json_encode($data['revenueChart']) ?>;  // Dữ liệu từ backend

    const categories = rawData.map(item => item.date);  // Ngày tháng
    const seriesData = rawData.map(item => parseFloat(item.revenue));  // Doanh thu

    const options = {
        chart: {
            type: 'area',
            height: 350
        },
        series: [{
            name: "Doanh thu",
            data: seriesData
        }],
        xaxis: {
            categories: categories,
            type: 'datetime',
            labels: {
                formatter: function (value) {
                    const date = new Date(value);
                    return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;  // Định dạng ngày tháng
                }
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yyyy'  // Định dạng tooltip ngày tháng
            },
            y: {
                formatter: function (val) {
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(val);  // Định dạng tiền tệ VND
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        colors: ['#556ee6']
    };

    const chart = new ApexCharts(document.querySelector("#customer_impression_charts"), options);
    chart.render();
</script>
</body>

</html>