<?php
require_once 'models/Dashboard.php';

class DashboardController
{
    private $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = new Dashboard();
    }

    public function index()
    {
        $filter = $_GET['filter'] ?? '1Y'; // Lấy mốc thời gian từ query param (ALL, 1M, 6M, 1Y)

        // Lấy range thời gian cho sản phẩm bán chạy (today, yesterday, last7days, ...)
        $range = $_GET['range'] ?? 'yesterday';

        $data = $this->dashboardModel->index($filter,$range);
        require_once 'views/dashboard.php';
    }
}
