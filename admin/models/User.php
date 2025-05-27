<?php
class UserModel {
    // Lấy danh sách user với keyword tìm kiếm (tìm theo username hoặc email)
    public function getUsers($keyword = '') {
        $sql = "SELECT * FROM users WHERE username LIKE :keyword OR email LIKE :keyword ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':keyword' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateRole($id, $role) {
        $stmt = $this->db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $id]);
    }

    public function toggleLockUser($id) {
        // Lấy trạng thái hiện tại
        $user = $this->getUserById($id);
        $newStatus = $user->is_locked ? 0 : 1;
        $stmt = $this->db->prepare("UPDATE users SET is_locked = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);
    }
}