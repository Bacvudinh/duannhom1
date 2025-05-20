<?php
require_once 'BaseModel.php'; // Đảm bảo đường dẫn đến BaseModel là chính xác

class Categories extends BaseModel {
    protected $table = 'categories';

    public function getAllCategories() {
        return $this->getAll();
    }

    public function getCategoryById($id) {
        return $this->find($id);
    }

    public function addCategory($name, $description = null) {
        $data = ['name' => $name, 'description' => $description];
        return $this->insert($data);
    }

    public function updateCategory($id, $name, $description = null) {
        $data = ['name' => $name, 'description' => $description];
        return $this->update($id, $data);
    }

    public function delete($id) { // <--- PHƯƠNG THỨC ĐÃ SỬA
        return parent::delete($id); // Gọi phương thức delete của BaseModel
    }
     public function searchCategories($keyword) {
        $sql = "SELECT * FROM {$this->table} WHERE name LIKE :keyword";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    // Nếu bạn muốn xử lý cả trường 'description' sau này, bạn có thể thêm các phương thức sau:
    // public function addCategoryWithDescription($name, $description = null) {
    //     $data = ['name' => $name, 'description' => $description];
    //     return $this->insert($data);
    // }

    // public function updateCategoryWithDescription($id, $name, $description = null) {
    //     $data = ['name' => $name, 'description' => $description];
    //     return $this->update($id, $data);
    // }
}