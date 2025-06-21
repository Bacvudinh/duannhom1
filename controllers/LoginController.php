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

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);


            if ($password !== $confirmPassword) {
                $error = "Mật khẩu không khớp.";
                require_once 'views/register.php';
                return;
            }

            $userModel = new UserModel();
            $result = $userModel->register($name, $email, $password, $phone, $address);

            if ($result) {
                header('Location: index.php?act=loginForm');
                exit;
            } else {
                $error = "Email đã tồn tại.";
                require_once 'views/register.php';
            }
        } else {
            require_once 'views/register.php';
        }
    }
}
