<?php
class UserModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Hàm connectDB() cần tồn tại và trả về PDO
    }

    public function getUsers($keyword = '')
    {
        $sql = "SELECT * FROM users WHERE name LIKE :keyword OR email LIKE :keyword ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':keyword' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateRole($id, $role)
    {
        $stmt = $this->conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $id]);
    }

    public function createUser($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone, address, role, status, created_at)
                                      VALUES (:name, :email, :password, :phone, :address, :role, :status, :created_at)");
        $data['created_at'] = date('Y-m-d H:i:s');
        return $stmt->execute($data);
    }

    public function updateUser($id, $data)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $sql = "UPDATE users SET " . implode(', ', $set) . " WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function toggleLockUser($id)
    {
        $user = $this->getUserById($id);
        $newStatus = ($user->status == 1) ? 0 : 1;
        $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);
    }
}
