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
    $size = trim($_POST['size'] ?? '');
    $status = $_POST['status'] ?? 1;

    $error = [];

    // Kiểm tra rỗng
    if (empty($size)) {
        $error['size'] = 'Tên size không được để trống.';
    }

    // Kiểm tra trùng tên trong DB
    if (empty($error)) {
        $existingSize = $this->Size->getByName($size);
        if ($existingSize) {
            $error['size'] = 'Tên size đã tồn tại.';
        }
    }

    if (empty($error)) {
        $this->Size->createSize($size, $status);
        $_SESSION['success'] = 'Thêm size thành công!';
        header('Location: index.php?act=admin_sizes');
        exit;
    } else {
        // Gửi lại dữ liệu đã nhập để hiển thị lại form
        $comment = (object)[
            'name' => $size,
            'status' => $status
        ];
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
    $name = trim($_POST['name']);
    $status = $_POST['status'];
    $error = [];

    // Validate
    if ($name === '') {
        $error['name'] = "Tên size không được để trống.";
    }

    if (!empty($error)) {
        // Tạo lại object như từ DB
        $comment = (object)[
            'id' => $id,
            'name' => $name,
            'status' => $status
        ];

        // Truyền dữ liệu và lỗi về lại view edit
        require './views/Size/edit.php';
        return;
    }

    // Nếu không có lỗi thì cập nhật và chuyển trang
    $this->Size->updateSize($id, $name, $status);
    $_SESSION['success'] = "Cập nhật size thành công!";
header("Location: index.php?act=admin_sizes");
exit;
   
}


 public function delete()
{
    $id = $_GET['id'] ?? null;
    if ($id) {
        $this->Size->delete($id); // Gọi model để xóa
        $_SESSION['success'] = "Xóa size thành công!";
    }
    header('Location: index.php?act=admin_sizes');
    exit;
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
