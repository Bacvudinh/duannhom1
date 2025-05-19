<?php
class Products extends BaseModel
{
public function getProducts($keyword = null)
{
    if ($keyword) {
        // Nếu có từ khóa tìm kiếm
        $sql = "SELECT * FROM `products` WHERE name LIKE ? OR description LIKE ?";
        $this->setQuery($sql);
        return $this->loadAllRows(['%' . $keyword . '%', '%' . $keyword . '%']);
    } else {
        // Nếu không có từ khóa, lấy tất cả sản phẩm
        $sql = "SELECT * FROM `products`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
}
    public function getProductById($id)
    {
        $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            JOIN categories ON products.category_id = categories.id
            WHERE products.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    
    public function getProductByName($name)
    {
        $sql = "SELECT * FROM products WHERE name LIKE ?";
        $this->setQuery($sql);
        return $this->loadAllRows(['%' . $name . '%']);
    }
    public function getRelatedProducts($category_id, $exclude_id, $limit = 4)
{
    $sql = "SELECT * FROM products WHERE category_id = ? AND id != ? ORDER BY id DESC LIMIT $limit";
    $this->setQuery($sql);
    return $this->loadAllRows([$category_id, $exclude_id]);
}
public function deleteProductsByCategoryId($categoryId) {
    $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0"); // Vô hiệu hóa kiểm tra khóa ngoại

    $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE category_id = :category_id");
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    $result = $stmt->execute();

    $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1"); // Kích hoạt lại kiểm tra khóa ngoại

    return $result;
}
}
