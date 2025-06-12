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
        $sql = "SELECT ci.*, p.name, p.image, p.status, pv.size AS variant_size
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            JOIN product_variants pv ON ci.variant_id = pv.id
            WHERE ci.cart_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$cartId]);
    }


    public function addItemToCart($cartId, $productId, $variantId, $variantSize, $price, $quantity)
    {
        $sql = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ? AND variant_id = ?";
        $this->setQuery($sql);
        $item = $this->loadRow([$cartId, $productId, $variantId]);

        if ($item) {
            $sql = "UPDATE cart_items SET quantity = quantity + ? WHERE id = ?";
            $this->setQuery($sql);
            return $this->execute([$quantity, $item->id]);
        } else {
            $sql = "INSERT INTO cart_items(cart_id, product_id, variant_id, variant_size, price, quantity)
                    VALUES(?,?,?,?,?,?)";
            $this->setQuery($sql);
            return $this->execute([$cartId, $productId, $variantId, $variantSize, $price, $quantity]);
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
