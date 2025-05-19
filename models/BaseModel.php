<?php

class BaseModel
{
        
    protected $pdo = NULL;
    protected $sql = '';
    protected $sta = NULL;
    protected $table = 'products'; // Tên bảng trong cơ sở dữ liệu

    public function __construct() {
        $this->pdo = $this->getConnect();
    }

    // Hàm kết nối với cơ sở dữ liệu
    public function getConnect()
    {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST
                . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USERNAME,
                DB_PASSWORD
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    // Hàm set query
    public function setQuery($sql)
    {
        return $this->sql = $sql;
    }

    // Hàm thực thi câu truy vấn SQL
    public function execute($options = array())
    {
        try {
            $this->sta = $this->pdo->prepare($this->sql);
            if ($options) {
                for ($i = 0; $i < count($options); $i++) {
                    $this->sta->bindValue($i + 1, $options[$i]);
                }
            }
            $this->sta->execute();
            return $this->sta;
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage() . " - Câu truy vấn: " . $this->sql);
        }
    }

    // Hàm lấy nhiều dữ liệu từ bảng (trả về object)
    public function loadAllRows($options = array())
    {
        $result = $this->execute($options);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    // Hàm lấy một dòng dữ liệu từ bảng (trả về object)
    public function loadRow($option = array())
    {
        $result = $this->execute($option);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    // Hàm lấy một dòng dữ liệu từ bảng (trả về mảng kết hợp)
    public function loadRowArray($option = array())
    {
        $result = $this->execute($option);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Hàm lấy nhiều dữ liệu từ bảng (trả về mảng kết hợp)
    public function loadAllRowsArray($options = array())
    {
        $result = $this->execute($options);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm lấy số lượng bản ghi
    public function rowCount()
    {
        return $this->sta->rowCount();
    }

    // Hàm lấy ID vừa được insert
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    // Các hàm CRUD chung (dựa trên thuộc tính $table)
    public function getAll()
    {
        $this->sql = "SELECT * FROM {$this->table}";
        return $this->loadAllRows();
    }

    public function find($id)
    {
        $this->sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->loadRow([$id]);
    }

    public function insert($data)
    {
        $keys = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $this->sql = "INSERT INTO {$this->table} ($keys) VALUES ($values)";
        $this->sta = $this->pdo->prepare($this->sql);
        return $this->sta->execute($data);
    }

    public function update($id, $data)
    {
        $setClauses = '';
        foreach ($data as $key => $value) {
            $setClauses .= "$key = :$key, ";
        }
        $setClauses = rtrim($setClauses, ', ');
        $this->sql = "UPDATE {$this->table} SET $setClauses WHERE id = :id";
        $data['id'] = $id;
        $this->sta = $this->pdo->prepare($this->sql);
        return $this->sta->execute($data);
    }

    public function delete($id)
    {
        $this->sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->execute([$id]);
    }
     public function deleteProductsByCategoryId($categoryId) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}