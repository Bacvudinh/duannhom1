<?php

require_once 'BaseModel.php';



class Comment extends BaseModel
{
    // Bảng comments bình luận của người dùngdùng
    protected $table = 'comments';

    public function getCommentsByProductId($productId)
    {
       


          $sql = "SELECT c.*, u.name as user_name 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.product_id = :product_id and c.status = 1
            ORDER BY c.created_at DESC";
             // $stmt->execute(['product_id' => $productId]);
       // $this->setQuery($sql);
       // $this->loadAllRows([$productId]); // vì ở bên view mình đang viết trả về đối tượng nên phải ẩn dòng này , vì basemodel trả về mảngmảng
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function addComment($data)
    {
        return $this->insert($data); // chèn ['user_id', 'product_id', 'comment']
    }

    // public function deleteComment($id)
    // {
    //     $sql = "DELETE FROM comments WHERE id = :id";
    //     $stmt = $this->pdo->prepare($sql);
    //     return $stmt->execute(['id' => $id]);
    // }
    
}
