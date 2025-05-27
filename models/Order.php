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
}
