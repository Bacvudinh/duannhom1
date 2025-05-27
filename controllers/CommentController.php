<?php

require_once 'models/Comment.php'; // Gọi đúng model Comment

class CommentController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment(); // Gán vào biến $this->commentModel
    }

    // Hàm hiển thị danh sách comment của sản phẩm
    public function showComments($productId)
    {
        return $this->commentModel->getCommentsByProductId($productId);
    }

    // Hàm xử lý thêm bình luận mới
    public function handleAddComment($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user']['id'] ?? null,
                'product_id' => $productId,
                'comment' => $_POST['comment'] ?? '',
                'parent_id' => $_POST['parent_id'] ?? null
            ];

            // Kiểm tra nếu người dùng đã đăng nhập và có nội dung comment
            if ($data['user_id'] && !empty($data['comment'])) {
                $this->commentModel->addComment($data);
            }

            // Quay lại trang chi tiết sản phẩm
            header("Location: index.php?act=product_detail&id=" . $productId);
            exit;
        }
    }
    public function deleteComment($commentId, $productId)
    {
        $comment = $this->commentModel->find($commentId);

        if ($comment && $comment->user_id === $_SESSION['user']['id']) {
            $this->commentModel->delete($commentId);
        }

        header("Location: index.php?act=product_detail&id=" . $productId);
        exit;
    }
}
