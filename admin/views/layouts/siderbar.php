<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                    data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">


            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=/">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=Categories">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-categories"></span>Quản lí Danh mục</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=Product">
                        <i class="ri-dashboard-2-line"></i> Quản lí Sản phẩm </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=admin_sizes">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-categories"> Quản lí Size </span>
                    </a>
                </li>
                <div class="collapse menu-dropdown" id="sidebarDanhMuc">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="" class="nav-link" data-key="t-sweet-alerts">
                                Danh sách
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link" data-key="t-nestable-list">
                                Thêm mới
                            </a>
                        </li>
                    </ul>
                </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=admin_comments">
                        <i class="ri-shopping-cart-line"></i> <span data-key="t-orders">Quản lý bình luận</span>
                    </a>
                </li>
                <!-- Thêm Quản lý người dùng -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=Users">
                        <i class="ri-user-line"></i> <span data-key="t-users">Quản lý người dùng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=Orders">
                        <i class="ri-shopping-cart-line"></i> <span data-key="t-orders">Quản lý đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="../index.php?act=/">
                        <span data-key="t-orders">Quay lại trang chủ </span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>