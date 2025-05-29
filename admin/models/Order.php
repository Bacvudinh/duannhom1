<?php
class Order {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // Hàm connectDB() phải tồn tại và trả về PDO
    }

    public function all() {
    $sql = "
        SELECT 
            o.id,
            o.user_id,
            o.status,
            o.created_at,
            IFNULL(SUM(od.price * od.quantity), 0) AS total_amount
        FROM orders o
        LEFT JOIN order_details od ON o.id = od.order_id
        GROUP BY o.id
        ORDER BY o.created_at DESC
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

   public function find($id) {
    // Lấy thông tin đơn hàng
    $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        return null;
    }

    // Lấy chi tiết sản phẩm trong đơn hàng (có tên sản phẩm)
    $stmt = $this->conn->prepare("
        SELECT od.*, p.name AS product_name 
        FROM order_details od 
        JOIN products p ON od.product_id = p.id 
        WHERE od.order_id = ?
    ");
    $stmt->execute([$id]);
    $order['details'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $order; 
    }
    public function updateStatus($id, $status) {
    $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    return $stmt->execute([$status, $id]);
}
}