<?php
require_once __DIR__ . '/../models/Size.php';

class SizeController
{
    protected $Size;

    public function __construct()
    {
        $this->Size = new Size();
    }

    public function index()
    {
        $search = $_GET['search'] ?? '';
        $comments = $this->Size->getAllSize($_GET['search'] ?? '');
        require_once './views/Size/index.php';
    }
    public function add()
    {
  

        require_once './views/Size/add.php';
    }
    public function save()
    {
        $size = $_POST['size'] ?? '';
        $status = $_POST['status'] ?? 1; // Mặc định là 1 (hoạt động)

        // Kiểm tra dữ liệu
        $error = [];
        if (empty($size)) {
            $error[] = 'Tên size không được để trống.';
        }
        if (empty($error)) {
            $this->Size->createSize($size, $status);
            header('Location: index.php?act=admin_sizes');
        } else {
            require_once './views/Size/add.php';
        }
    }


    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) header('Location: index.php?act=admin_sizes');

        $comment = $this->Size->getSizeId($id);
        require_once './views/Size/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = $_POST['status'];

        $this->Size->updateSize($id, $name, $status);
        header('Location: index.php?act=admin_sizes');
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->Size->deleteSize($id);
        }
        header('Location: index.php?act=admin_sizes');
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        if ($id) {
            $this->Size->toggleSize($id, $status);
        }
        header('Location: index.php?act=admin_sizes');
     }
    // public function toggle()
    // {
    //     $id = $_GET['id'] ?? null;
    //     $newStatus = $_GET['new_status'] ?? null; // Lấy trạng thái mới từ URL

    //     if ($id && !is_null($newStatus)) {
    //         $this->Size->toggleStatus($id, $newStatus);
    //     }

    //     header('Location: index.php?act=admin_comments');
    //     exit();
    // }
}
