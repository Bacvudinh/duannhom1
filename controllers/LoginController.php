<?php
require_once 'models/User.php';

class LoginController
{
    public $product;
    public function __construct(Type $var = null)
    {
        $this->product = new Products();
    }
    public function showLogin()
    {
        require_once 'views/login.php';
        $error = '';
    }
    public function login()
    {
        // session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $result = $userModel->login($email, $password);

            if (isset($result['error'])) {
                $error = $result['error'];
                // Nếu có lỗi, hiển thị lại form đăng nhập với thông báo lỗi
                
                require_once 'views/login.php';
                return;
            }

            $_SESSION['user'] = $result;

            // Chuyển hướng theo vai trò
            if ($result['role'] === 'admin') {
                header('Location: ./admin/index.php');
            } else {
                $products = $this->product->getProducts();
                header('Location: ./?act=/');
            }
            exit();
        }

        require_once 'views/login.php';
    }
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        // ✅ Xóa cookie chứa session ID (PHPSESSID)
        setcookie(session_name(), '', time() - 3600, '/');
        header("Location: index.php?act=loginForm");
        die();
    }


    public function showRegisterForm()
    {
        require_once 'views/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Kiểm tra mật khẩu nhập lại
            if ($password !== $confirmPassword) {
                $error = "Mật khẩu không khớp.";
                require_once 'views/register.php';
                return;
            }

            $userModel = new UserModel();
            $result = $userModel->register($name, $email, $password);

            if ($result) {
                header('Location: index.php?act=loginForm');
                exit();
            } else {
                $error = "Email đã tồn tại.";
                require_once 'views/register.php';
            }
        } else {
            require_once 'views/register.php';
        }
    }
}
