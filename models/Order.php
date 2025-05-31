<?php

class Order extends BaseModel
{
    protected $table = 'orders';

    // Tạo đơn hàng mới
    public function createOrder($userId, $total)
    {
        $sql = "INSERT INTO {$this->table} (user_id, total_amount) VALUES (?, ?)";
        $this->setQuery($sql);
        $this->execute([$userId, $total]);
        return $this->pdo->lastInsertId();
    }

    // Thêm chi tiết đơn hàng
    public function insertOrderDetail($orderId, $productId, $quantity, $price)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$orderId, $productId, $quantity, $price]);
    }
    public function insertOrderAddress($orderId, $name, $email, $phone, $address, $note = '')
    {
        $sql = "INSERT INTO order_addresses (order_id, name, email, phone, address, note)
            VALUES (?, ?, ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$orderId, $name, $email, $phone, $address, $note]);
    }

    // Lấy danh sách đơn hàng theo người dùng
    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$userId]);
    }

    // Lấy chi tiết đơn hàng theo ID đơn
    public function getOrderDetails($orderId)
    {
        $sql = "
            SELECT od.*, p.name AS product_name, p.image 
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = ?
        ";
        $this->setQuery($sql);
        return $this->loadAllRows([$orderId]);
    }

    // Hủy đơn hàng nếu đang ở trạng thái "chờ xác nhận"
    public function cancelOrderIfPending($orderId, $userId)
    {
        $sql = "UPDATE {$this->table} 
                SET status = 'Đã huỷ' 
                WHERE id = ? AND user_id = ? AND status = 'Chờ xác nhận'";
        $this->setQuery($sql);
        $stmt = $this->execute([$orderId, $userId]);  // Lấy PDOStatement
        return $stmt->rowCount() > 0;
    }
    public function decreaseStock($productId, $quantity)
    {
        $sql = "UPDATE products SET stock = stock - ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$quantity, $productId]);
    }
    // public function getOrderAddress($orderId)
    // {
    //     $sql = "SELECT * FROM order_addresses WHERE order_id = ?";
    //     $this->setQuery($sql);
    //     return $this->loadRow([$orderId]);
    // }
    public function increaseProductStock($productId, $quantity)
    {
        $sql = "UPDATE products SET stock = stock + ? WHERE id = ?";

        $this->setQuery($sql);
        return $this->execute([$quantity, $productId]);
    }
}
