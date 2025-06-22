<?php
class Dashboard extends BaseModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function index($filter = '1Y', $range = 'yesterday')
        {
            return [
                'totalRevenue' => $this->getTotalRevenue($range),
                'totalOrders' => $this->getTotalOrders($range),
                'totalCustomers' => $this->getTotalCustomers($range),
                'myBalance' => $this->getMyBalance($range),
                'revenueChart' => $this->getRevenueStatistics($filter),
                'bestSellingProducts' => $this->getBestSellingProducts($range),
                'latestOrders' => $this->getLatestOrders($range)
            ];
        }

    private function getTotalOrders($range = 'yesterday')
        {
            $where = $this->getDateCondition($range);
            $stmt = $this->conn->query("SELECT COUNT(*) AS total_orders FROM orders o WHERE $where");
            return $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'] ?? 0;
        }

    private function getTotalCustomers($range = 'yesterday')
        {
            $where = str_replace('o.', 'u.', $this->getDateCondition($range)); // đổi bảng
            $stmt = $this->conn->query("SELECT COUNT(*) AS total_customers FROM users u WHERE $where");
            return $stmt->fetch(PDO::FETCH_ASSOC)['total_customers'] ?? 0;
        }

    private function getTotalRevenue($range = 'yesterday')
{
    $where = $this->getDateCondition($range);
    $sql = "
        SELECT IFNULL(SUM(od.price * od.quantity), 0) AS revenue
        FROM orders o
        JOIN order_details od ON o.id = od.order_id
        WHERE o.status = 'Hoàn thành' AND $where
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;
}

private function getMyBalance($range = 'yesterday')
{
    return $this->getTotalRevenue($range); // giống nhau
}

private function getRevenueStatistics($interval = '1Y')
{
    $map = [
        'ALL' => '',
        '1M' => 'INTERVAL 1 MONTH',
        '6M' => 'INTERVAL 6 MONTH',
        '1Y' => 'INTERVAL 1 YEAR',
    ];

    $condition = isset($map[$interval]) && $interval !== 'ALL'
        ? "AND o.created_at >= DATE_SUB(NOW(), {$map[$interval]})"
        : '';

    $sql = "
        SELECT DATE_FORMAT(o.created_at, '%Y-%m') AS month, 
               IFNULL(SUM(od.price * od.quantity), 0) AS revenue
        FROM orders o
        JOIN order_details od ON o.id = od.order_id
        WHERE o.status = 'Hoàn thành'
          $condition
        GROUP BY month
        ORDER BY month ASC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    private function getBestSellingProducts($range = 'yesterday')
{
    // Dùng lại hàm getDateCondition nếu bạn đã có
    $where = $this->getDateCondition($range); // Tái sử dụng với các hàm khác

    $sql = "
        SELECT 
            p.id, p.name, p.price, p.image, p.stock,
            SUM(od.quantity) AS total_sold,
            SUM(od.quantity * od.price) AS total_revenue
        FROM orders o
        JOIN order_details od ON o.id = od.order_id
        JOIN products p ON p.id = od.product_id
        WHERE o.status = 'Hoàn thành' AND $where
        GROUP BY p.id
        HAVING total_sold > 0
        ORDER BY total_sold DESC
        LIMIT 5
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
   private function getLatestOrders($range = 'yesterday', $limit = 5)
{
    $where = $this->getDateCondition($range);
    $sql = "
        SELECT o.id, o.id AS order_id, u.NAME AS customer_name,
               o.created_at AS order_date, o.status, o.total_amount
        FROM orders o
        JOIN users u ON u.id = o.user_id
        WHERE $where
        ORDER BY o.created_at DESC
        LIMIT :limit
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
private function getDateCondition($range)
{
    return match ($range) {
        'today' => "DATE(o.created_at) = CURDATE()",
        'yesterday' => "DATE(o.created_at) = CURDATE() - INTERVAL 1 DAY",
        'last7days' => "o.created_at >= CURDATE() - INTERVAL 7 DAY",
        'last30days' => "o.created_at >= CURDATE() - INTERVAL 30 DAY",
        'thismonth' => "MONTH(o.created_at) = MONTH(CURDATE()) AND YEAR(o.created_at) = YEAR(CURDATE())",
        'lastmonth' => "MONTH(o.created_at) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(o.created_at) = YEAR(CURDATE() - INTERVAL 1 MONTH)",
        '1Y' => "o.created_at >= CURDATE() - INTERVAL 1 YEAR",
        default => "1=1",
    };
}

}
?>
