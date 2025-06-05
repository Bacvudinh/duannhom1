<?php
class ProductVariant extends BaseModel
{
    protected $table = 'product_variants';

    public function addVariant($product_id, $size_id, $price)
    {
        $sql = "INSERT INTO $this->table (product_id, size, price) VALUES (?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$product_id, $size_id, $price]);
    }

public function getProductVariants($productId)
{
    $sql = "SELECT * FROM product_variants WHERE product_id = ? ORDER BY size";
    $this->setQuery($sql);
    return $this->loadAllRows([$productId]);
}

    public function deleteByProductId($product_id)
    {
        $sql = "DELETE FROM $this->table WHERE product_id = ?";
        $this->setQuery($sql);
        return $this->execute([$product_id]);
    }


    public function updateVariant($id, $size_id, $price)
    {
        $sql = "UPDATE $this->table SET size_id = ?, price = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$size_id, $price, $id]);
    }

    public function deleteVariant($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}