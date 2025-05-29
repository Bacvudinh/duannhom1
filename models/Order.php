<?php
class Order extends BaseModel
{
    protected $table = 'orders';

    public function createOrder($userId, $total)
    {
        $sql = "INSERT INTO {$this->table}(user_id, total_amount) VALUES (?, ?)";
        $this->setQuery($sql);
        $this->execute([$userId, $total]);
        return $this->pdo->lastInsertId();
    }

    public function insertOrderDetail($orderId, $productId, $quantity, $price)
    {
        $sql = "INSERT INTO order_details(order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$orderId, $productId, $quantity, $price]);
    }
public function getOrdersByUserId($userId)
{
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
    $this->setQuery($sql);
    return $this->loadAllRows([$userId]);
}

public function getOrderDetails($orderId)
{
    $sql = "SELECT od.*, p.name AS product_name, p.image 
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = ?";
    $this->setQuery($sql);
    return $this->loadAllRows([$orderId]);
}

}
