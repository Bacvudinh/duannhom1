<?php
require_once 'models/User.php';

class LoginController {
    public $product;

    public function __construct() {
        $this->product = new Products();
    }

    public function showLogin() {
        $error = '';
        require_once 'views/login.php';
    }

    public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $result = $userModel->login($email, $password); // đây là login từ model

        if (isset($result['error'])) {
            $error = $result['error'];
            require_once 'views/login.php';
            return;
        }
        $_SESSION['user'] = $result;
        if ($result['role'] === 'admin') {
            header('Location: ./admin/index.php');

        } else {
            header('Location: ./?act=/');
        }
        exit;
    }

    require_once 'views/login.php';
    }
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: index.php?act=loginForm');
        
        exit();
    }

    public function showRegisterForm() {
        require_once 'views/register.php';
    }

   public function register()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if ($password !== $confirm_password) {
            $error = "Mật khẩu không khớp!";
        } else {
            $userModel = new UserModel();
            $success = $userModel->register($name, $email, $password, $phone, $address);

            if (!$success) {
                $error = "Email đã tồn tại!";
            } else {
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: index.php?act=login");
                exit;
            }
        }
    }

    // Load lại view và truyền biến lỗi nếu có
    require 'views/register.php'; // hoặc đúng path view của bạn
}
}
