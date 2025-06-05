<?php
class Cart extends BaseModel
{
    protected $table = 'carts';

    public function getCartByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$userId]);
    }

    public function createCart($userId)
    {
        $sql = "INSERT INTO {$this->table}(user_id) VALUES(?)";
        $this->setQuery($sql);
        $this->execute([$userId]);
        return $this->pdo->lastInsertId();
    }

    public function getCartItems($cartId)
    {
        $sql = "SELECT ci.*, p.name, p.image FROM cart_items ci 
        JOIN products p ON ci.product_id = p.id WHERE ci.cart_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$cartId]);
    }

    public function addItemToCart($cartId, $productId, $quantity, $price)
    {
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ chưa
        $sql = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
        $this->setQuery($sql);
        $item = $this->loadRow([$cartId, $productId]);

        if ($item) {
            $sql = "UPDATE cart_items SET quantity = quantity + ? WHERE id = ?";
            $this->setQuery($sql);
            return $this->execute([$quantity, $item->id]);
        } else {
            $sql = "INSERT INTO cart_items(cart_id, product_id, quantity, price) VALUES(?,?,?,?)";
            $this->setQuery($sql);
            return $this->execute([$cartId, $productId, $quantity, $price]);
        }
    }

    public function removeItemFromCart($itemId)
    {
        $sql = "DELETE FROM cart_items WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$itemId]);
    }

    public function clearCart($cartId)
    {
        $sql = "DELETE FROM cart_items WHERE cart_id = ?";
        $this->setQuery($sql);
        return $this->execute([$cartId]);
    }
    public function updateItemQuantity($itemId, $quantity)
{
    $sql = "UPDATE cart_items SET quantity = ? WHERE id = ?";
    $this->setQuery($sql);
    return $this->execute([(int)$quantity, (int)$itemId]);
}
    
}
