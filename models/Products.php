<?php
// models/Products.php

// Đảm bảo rằng BaseModel được include ở đây hoặc đã được autoload
// require_once 'BaseModel.php'; 

class Products extends BaseModel
{
    protected $table = 'products';

    public function getProducts($keyword = null, $limit = '', $offset = 0)
    {
        $sql = "SELECT p.*, c.name AS category_name 
            FROM `products` AS p 
            JOIN `categories` AS c ON p.category_id = c.id 
            WHERE p.status = 1 ";
              
        $params = [];

        if ($keyword) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        // Lọc theo danh mục
        if (!empty($_GET['category'])) {
            $placeholders = implode(',', array_fill(0, count($_GET['category']), '?'));
            $sql .= " AND p.category_id IN ($placeholders)";
            $params = array_merge($params, $_GET['category']);
        }

        // Lọc theo giá
        if (!empty($_GET['min_price'])) {
            $sql .= " AND p.price >= ?";
            $params[] = $_GET['min_price'];
        }

        if (!empty($_GET['max_price'])) {
            $sql .= " AND p.price <= ?";
            $params[] = $_GET['max_price'];
        }

        // Phân trang
        $limit = $_GET['limit'] ?? 100;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $sql .= " LIMIT $limit OFFSET $offset";

        $this->setQuery($sql);
        return $this->loadAllRows($params);
    }
    // Hàm này dùng để lấy tất cả sản phẩm cho trang quản trị ( tách riêng để lấy cho admin )
     public function getProductsforadmin($keyword = null)
    {
        $sql = "SELECT p.*, c.name AS category_name 
            FROM `products` AS p 
            JOIN `categories` AS c ON p.category_id = c.id 
            WHERE 1 ";
              
        $params = [];

        if ($keyword) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        // Lọc theo danh mục
        if (!empty($_GET['category'])) {
            $placeholders = implode(',', array_fill(0, count($_GET['category']), '?'));
            $sql .= " AND p.category_id IN ($placeholders)";
            $params = array_merge($params, $_GET['category']);
        }

        // Lọc theo giá
        if (!empty($_GET['min_price'])) {
            $sql .= " AND p.price >= ?";
            $params[] = $_GET['min_price'];
        }

        if (!empty($_GET['max_price'])) {
            $sql .= " AND p.price <= ?";
            $params[] = $_GET['max_price'];
        }

        // Phân trang
     
        $this->setQuery($sql);
        return $this->loadAllRows($params);
    }
    public function countProducts($keyword = null)
    {
        $sql = "SELECT COUNT(*) FROM `{$this->table}` AS p ";
        $params = [];

        if ($keyword) {
            $sql .= "WHERE p.name LIKE ? OR p.description LIKE ?";
            $params = ['%' . $keyword . '%', '%' . $keyword . '%'];
        }

        $this->setQuery($sql);
        return $this->execute($params)->fetchColumn(); // trả về số lượng
    }

    public function getProductById($id)
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM `{$this->table}` AS p
                JOIN `categories` AS c ON p.category_id = c.id
                WHERE p.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function getProductByName($name)
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE name LIKE ?";
        $this->setQuery($sql);
        return $this->loadAllRows(['%' . $name . '%']);
    }

    public function getRelatedProducts($category_id, $exclude_id, $limit = 4)
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE category_id = ? AND id != ? ORDER BY id DESC LIMIT {$limit}";
        $this->setQuery($sql);
        return $this->loadAllRows([$category_id, $exclude_id]);
    }

    public function deleteProductsByCategoryId($categoryId)
    {
        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0");

        $sql = "DELETE FROM `{$this->table}` WHERE category_id = ?";
        $this->setQuery($sql);
        $result = $this->execute([$categoryId]);

        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1");

        return $result;
    }

    public function addProduct($name, $price, $categoryId,$status, $description = null, $image = null,$is_delete=null)
    {
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $categoryId,
            'status' => $status,
            'description' => $description,
            'image' => $image,
            'is_delete' => $is_delete,
        ];
        return $this->insert($data);
    }
public function updateProduct($id, $name, $price, $categoryId,$status,$description = null,$image = null)

    {
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $categoryId,
            'status' => $status,
            'description' => $description,
            'image' => $image,
           
        ];
        $where = ['id' => $id];
        return $this->update($id, $data);
    }

    public function delete($id)
    {
        $where = ['id' => $id];
        return $this->deleteRow($where);
    }
}
