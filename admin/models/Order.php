<?php
class Order extends BaseModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối PDO
    }

    public function all()
    {
        $sql = "
        SELECT 
            o.id,
            o.user_id,
            o.status,
            o.created_at,
            o.payment_status,
            o.payment_method,
            odr.address AS shipping_address,
            odr.phone AS shipping_phone,
            odr.name AS shipping_name,
            odr.email AS shipping_email,
            IFNULL(SUM(od.price * od.quantity), 0) AS total_amount
        FROM orders o
        LEFT JOIN order_details od ON o.id = od.order_id
        LEFT JOIN order_addresses odr ON odr.order_id = o.id
        GROUP BY o.id, o.user_id, o.status, o.created_at, 
                 odr.address, odr.phone, odr.name, odr.email,
                 o.payment_status
        ORDER BY o.created_at DESC
    ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        // Lấy thông tin đơn hàng
        $stmt = $this->conn->prepare("
        SELECT 
            o.*,
            u.name AS user_name,
            u.email AS user_email
        FROM orders o
        INNER JOIN users u ON o.user_id = u.id
        WHERE o.id = ?
    ");
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) return null;

        // Lấy chi tiết sản phẩm trong đơn hàng (không dùng variant)
        $stmt = $this->conn->prepare("
        SELECT 
    od.*,
    p.name AS product_name,
    pv.size AS variant_size, -- ✅ Lấy size thật
    od.price AS price,
    p.image AS product_img,
    odr.address AS shipping_address,
    odr.phone AS shipping_phone,
    odr.name AS shipping_name,
    odr.email AS shipping_email
FROM order_details od
JOIN products p ON od.product_id = p.id
LEFT JOIN product_variants pv ON od.variant_id = pv.id -- ✅ Thêm dòng này
LEFT JOIN order_addresses odr ON odr.order_id = od.order_id
WHERE od.order_id = ?

    ");
        $stmt->execute([$id]);
        $order['details'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $order;
    }


    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    // ✅ Hàm sửa đúng
    public function updatePaymentStatus($orderId, $paymentStatus)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
        return $stmt->execute([$paymentStatus, $orderId]);
    }
    public function searchByCustomerName($keyword)
{
    $sql = "
        SELECT 
            o.id,
            o.user_id,
            o.status,
            o.created_at,
            o.payment_status,
            o.payment_method,
            
            odr.address AS shipping_address,
            odr.phone AS shipping_phone,
            odr.name AS shipping_name,
            odr.email AS shipping_email,
            IFNULL(SUM(od.price * od.quantity), 0) AS total_amount
        FROM orders o
        LEFT JOIN order_details od ON o.id = od.order_id
        LEFT JOIN order_addresses odr ON odr.order_id = o.id
        WHERE odr.name LIKE :keyword OR odr.phone LIKE :keyword
        GROUP BY o.id, o.user_id, o.status, o.created_at, 
                 odr.address, odr.phone, odr.name, odr.email
        ORDER BY o.created_at DESC
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function updatePaymentMethod($orderId, $paymentMethod)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET payment_method = ? WHERE id = ?");
        return $stmt->execute([$paymentMethod, $orderId]);
    }
}
