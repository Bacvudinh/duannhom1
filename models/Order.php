<?php

class Order extends BaseModel
{
    protected $table = 'orders';

    // Tạo đơn hàng mới
    public function createOrder($userId, $total, $paymentStatus = 'Chưa thanh toán', $paymentMethod = 'cod')
    {
        $sql = "INSERT INTO {$this->table} (user_id, total_amount, payment_status, payment_method) VALUES (?, ?, ?, ?)";
        $this->setQuery($sql);
        $this->execute([$userId, $total, $paymentStatus, $paymentMethod]);
        return $this->pdo->lastInsertId();
    }

    public function insertOrderDetail($orderId, $productId, $quantity, $price, $variant_id)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price, variant_id)
            VALUES (?, ?, ?, ?, ?)"; // ĐÚNG THỨ TỰ
        $this->setQuery($sql);
        return $this->execute([$orderId, $productId, $quantity, $price, $variant_id]);
    }


    public function insertOrderAddress($orderId, $name, $email, $phone, $address, $note = '')
    {
        $sql = "INSERT INTO order_addresses (order_id, name, email, phone, address, note)
                VALUES (?, ?, ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$orderId, $name, $email, $phone, $address, $note]);
    }

    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$userId]);
    }

    public function getOrderDetails($orderId)
    {
        $sql = "SELECT 
                od.*, 
                p.name AS product_name, 
                p.image, 
                pv.size AS variant_size
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            LEFT JOIN product_variants pv ON od.variant_id = pv.id
            WHERE od.order_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$orderId]);
    }


    // --- Thêm hàm lấy thông tin người nhận ---
    public function getOrderAddress($orderId)
    {
        $sql = "SELECT * FROM order_addresses WHERE order_id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$orderId]); // lấy 1 dòng duy nhất
    }

    public function cancelOrderIfPending($orderId, $userId)
    {
        $sql = "UPDATE {$this->table}
            SET status = 'Đã huỷ'
            WHERE id = ? AND user_id = ? AND status IN ('Chờ xác nhận', 'Xác nhận')";
        $this->setQuery($sql);
        $stmt = $this->execute([$orderId, $userId]);
        return $stmt->rowCount() > 0;
    }


    public function decreaseStock($productId, $quantity)
    {
        $sql = "UPDATE products SET stock = stock - ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$quantity, $productId]);
    }

    public function increaseProductStock($productId, $quantity)
    {
        $sql = "UPDATE products SET stock = stock + ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$quantity, $productId]);
    }

    public function updatePaymentStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET payment_status = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$status, $orderId]);
    }
    public function updatecustomer_confirmed($orderId)
{
    $sql = "UPDATE orders SET customer_confirmed = 1 WHERE id = ?";
    $this->setQuery($sql);
    return $this->execute([$orderId]);
}


    public function updateOrderStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$status, $orderId]);
    }
    public function getOrderById($orderId)
    {
        $sql = "SELECT o.*, oa.note, oa.name, oa.phone, oa.address, oa.email
            FROM orders o
            LEFT JOIN order_addresses oa ON oa.order_id = o.id
            WHERE o.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$orderId]);
    }
}
