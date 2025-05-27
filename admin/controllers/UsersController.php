<?php
class UsersController {
    
    public function index() {
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $users = (new UserModel())->getUsers($keyword);
    require 'views/users/index.php';
}

    public function create() {
        require 'views/users/add.php';
    }

    public function save() {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'role' => $_POST['role'],
            'status' => 1 // Mặc định khi tạo là active
        ];
        User::create($data);
        header("Location: index.php?act=Users");
        exit;
    }

    public function edit($id) {
        $user = User::find($id);
        if (!$user) {
            header("Location: index.php?act=Users");
            exit;
        }
        require 'views/users/edit.php';
    }

    public function update($id) {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'role' => $_POST['role'],
            'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1
        ];
        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }
        User::update($id, $data);
        header("Location: index.php?act=Users");
        exit;
    }

    // Hàm khóa hoặc mở khóa người dùng (toggle status)
    public function toggleStatus($id) {
        $user = User::find($id);
        if ($user) {
            $newStatus = ($user['status'] == 1) ? 0 : 1;
            User::update($id, ['status' => $newStatus]);
        }
        header("Location: index.php?act=Users");
        exit;
    }
    public function detail($id) {
            $user = User::find($id);
            if (!$user) {
                header("Location: index.php?act=Users");
                exit;
            }
            require 'views/users/detail.php';
        }
    public function toggleRole($id) {
    $user = User::find($id);
    if ($user) {
        $newRole = $user['role'] === 'admin' ? 'user' : 'admin';
        User::update($id, ['role' => $newRole]);
    }
    header("Location: index.php?act=Users");
    exit;
}
}
