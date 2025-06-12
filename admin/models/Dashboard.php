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
            'totalRevenue' => $this->getTotalRevenue(),
            'totalOrders' => $this->getTotalOrders(),
            'totalCustomers' => $this->getTotalCustomers(),
            'myBalance' => $this->getMyBalance(),
            'revenueChart' => $this->getRevenueStatistics($filter),
            'bestSellingProducts' => $this->getBestSellingProducts($range),
            'latestOrders' => $this->getLatestOrders()
        ];
    }

    private function getTotalOrders()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total_orders FROM orders");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'] ?? 0;
    }

    private function getTotalCustomers()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total_customers FROM users");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_customers'] ?? 0;
    }

    private function getTotalRevenue()
    {
        $sql = "
            SELECT IFNULL(SUM(od.price * od.quantity), 0) AS revenue
            FROM orders o
            JOIN order_details od ON o.id = od.order_id
            WHERE o.status = 'Hoàn thành'
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;
    }

    private function getMyBalance()
    {
        $sql = "
            SELECT IFNULL(SUM(od.price * od.quantity), 0) AS balance
            FROM orders o
            JOIN order_details od ON o.id = od.order_id
            WHERE o.status = 'Hoàn thành'
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['balance'] ?? 0;
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
        $where = match ($range) {
            'today' => "DATE(o.created_at) = CURDATE()",
            'yesterday' => "DATE(o.created_at) = CURDATE() - INTERVAL 1 DAY",
            'last7days' => "o.created_at >= CURDATE() - INTERVAL 7 DAY",
            'last30days' => "o.created_at >= CURDATE() - INTERVAL 30 DAY",
            'thismonth' => "MONTH(o.created_at) = MONTH(CURDATE()) AND YEAR(o.created_at) = YEAR(CURDATE())",
            'lastmonth' => "MONTH(o.created_at) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(o.created_at) = YEAR(CURDATE() - INTERVAL 1 MONTH)",
            default => "DATE(o.created_at) = CURDATE() - INTERVAL 1 DAY",
        };

        $sql = "
            SELECT 
                p.id, p.name, p.price, p.image, p.stock,
                SUM(od.quantity) AS total_sold,
                SUM(od.quantity * od.price) AS total_revenue
            FROM orders o
            JOIN order_details od ON o.id = od.order_id
            JOIN products p ON p.id = od.product_id
            WHERE o.status = 'Hoàn thành'
              AND $where
            GROUP BY p.id
            HAVING total_sold > 0
            ORDER BY total_sold DESC
            LIMIT 5
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($products) && $range !== 'last7days') {
            return $this->getBestSellingProducts('last7days');
        }

        return $products;
    }
   private function getLatestOrders($limit = 5)
{
    $sql = "
        SELECT 
            o.id AS order_id,
            u.NAME AS customer_name,
            o.created_at AS order_date,
            o.status,
            o.total_amount
        FROM orders o
        JOIN users u ON u.id = o.user_id
        ORDER BY o.created_at DESC
        LIMIT :limit
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>
