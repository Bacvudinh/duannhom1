<?php

require_once 'BaseModel.php';



class Comment extends BaseModel
{
    protected $table = 'comments';

    public function getCommentsByProductId($productId)
    {
        $sql = "SELECT c.*, u.name as user_name 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.product_id = :product_id
            ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addComment($data)
    {
        return $this->insert($data); // chèn ['user_id', 'product_id', 'comment']
    }
    
}
