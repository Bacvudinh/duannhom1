<?php
require_once 'models/User.php';

class UsersController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function index() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $users = $this->model->getUsers($keyword);
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
            'status' => 1
        ];
        $this->model->createUser($data);
        header("Location: index.php?act=Users");
        exit;
    }

    public function edit($id) {
        $user = $this->model->getUserById($id);
        if (!$user) {
            header("Location: index.php?act=Users");
            exit;
        }
        require 'views/users/edit.php';
    }

   public function update($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [];

        $fields = ['name', 'email', 'phone', 'address', 'role'];
        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                die("Thiếu dữ liệu $field");
            }
            $data[$field] = trim($_POST[$field]);
        }

        $data['status'] = isset($_POST['status']) ? (int)$_POST['status'] : 1;

        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        $this->model->updateUser($id, $data);
    }

    header("Location: index.php?act=Users");
    exit;
}

    public function toggleStatus($id) {
        $user = $this->model->getUserById($id);
        if ($user) {
            $newStatus = ($user->status == 1) ? 0 : 1;
            $this->model->updateUser($id, ['status' => $newStatus]);
        }
        header("Location: index.php?act=Users");
        exit;
    }

    public function detail($id) {
        $user = $this->model->getUserById($id);
        if (!$user) {
            header("Location: index.php?act=Users");
            exit;
        }
        require 'views/users/detail.php';
    }

    public function toggleRole($id) {
        $user = $this->model->getUserById($id);
        if ($user) {
            $newRole = ($user->role === 'admin') ? 'customer' : 'admin';
            $this->model->updateUser($id, ['role' => $newRole]);
        }
        header("Location: index.php?act=Users");
        exit;
    }
}
