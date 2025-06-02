<?php
class CommentModel extends BaseModel
{
    protected $table = 'comments'; // hoặc comments nếu bạn đặt tên vậy

    public function getAllComments($search = '')
    {
        $sql = "SELECT r.*, r.comment AS content, u.name AS user_name, p.name AS product_name
                FROM comments r
                    LEFT JOIN users u ON r.user_id = u.id
                    LEFT JOIN products p ON r.product_id = p.id
                    WHERE r.comment LIKE ?";

        $this->setQuery($sql);
        return $this->loadAllRows(["%$search%"]);
    }

    public function getCommentById($id)
    {


        $sql = "SELECT c.*, u.name as user_name 
        FROM $this->table c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function deleteComment($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function updateComment($id, $content, $status)
    {
        $sql = "UPDATE $this->table SET comment = ?, status = ? WHERE id = ?";

        $this->setQuery($sql);
        return $this->execute([$content, $status, $id]);
    }

    public function toggleStatus($id, $status)
    {
        $sql = "UPDATE $this->table SET status = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$status, $id]);
    }
//     public function toggleStatus($id, $newStatus)
// {
//     $sql = "UPDATE $this->table SET status = ? WHERE id = ?";
//     $this->setQuery($sql);
//     return $this->execute([$newStatus, $id]);
// }
}
