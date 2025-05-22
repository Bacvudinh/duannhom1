<?php
// models/Products.php

// Đảm bảo rằng BaseModel được include ở đây hoặc đã được autoload
// require_once 'BaseModel.php'; 

class Products extends BaseModel
{
    protected $table = 'products'; 

    public function getProducts($keyword = null)
    {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM `{$this->table}` AS p 
                JOIN `categories` AS c ON p.category_id = c.id";
        $params = [];

        if ($keyword) {
            $sql .= " WHERE p.name LIKE ? OR p.description LIKE ?";
            $params = ['%' . $keyword . '%', '%' . $keyword . '%'];
        }

        $this->setQuery($sql);
        return $this->loadAllRows($params);
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

    public function deleteProductsByCategoryId($categoryId) {
        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0"); 

        $sql = "DELETE FROM `{$this->table}` WHERE category_id = ?";
        $this->setQuery($sql);
        $result = $this->execute([$categoryId]);

        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1"); 

        return $result;
    }

    public function addProduct($name, $price, $categoryId, $description = null, $image = null)
    {
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $categoryId,
            'description' => $description,
            'image' => $image,
        ];
        return $this->insert($data);
    }

    public function updateProduct($id, $name, $price, $categoryId, $description = null, $image = null)
    {
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $categoryId,
            'description' => $description,
            'image' => $image,
        ];
        $where = ['id' => $id];
        return $this->update($data, $where);
    }

    public function delete($id)
    {
        $where = ['id' => $id];
        return $this->deleteRow($where);
    }
}