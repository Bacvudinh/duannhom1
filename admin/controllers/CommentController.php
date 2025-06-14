<?php


class CommentController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $search = $_GET['search'] ?? '';
        $comments = $this->commentModel->getAllComments($_GET['search'] ?? '');
        require_once './views/Comments/index.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) header('Location: index.php?act=admin_comments');

        $comment = $this->commentModel->getCommentById($id);
        
        require_once './views/Comments//edit.php';
    }

public function update()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $content = trim($_POST['content'] ?? '');
        $status = $_POST['status'] ?? 0;

        $error = [];

        if (empty($content)) {
            $error['content'] = 'Vui lòng nhập nội dung bình luận.';

            // Lấy lại comment từ DB hoặc tái tạo để hiển thị form lại
            $comment = $this->commentModel->getCommentById($id);
            $comment->comment = $content;
            $comment->status = $status;

            require_once './views/Comments/edit.php';
            return;
        }

        // Nếu hợp lệ thì cập nhật
        $this->commentModel->updateComment($id, $content, $status);
        header('Location: index.php?act=admin_comments');
        exit;
    }
}



    
    

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->commentModel->deleteComment($id);
        }
        header('Location: index.php?act=admin_comments');
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        if ($id) {
            $this->commentModel->toggleStatus($id, $status);
        }
        header('Location: index.php?act=admin_comments');
     }
    // public function toggle()
    // {
    //     $id = $_GET['id'] ?? null;
    //     $newStatus = $_GET['new_status'] ?? null; // Lấy trạng thái mới từ URL

    //     if ($id && !is_null($newStatus)) {
    //         $this->commentModel->toggleStatus($id, $newStatus);
    //     }

    //     header('Location: index.php?act=admin_comments');
    //     exit();
    // }
}
