<?php
require_once 'models/User.php';

class LoginController
{
    public $product;
    public function __construct()
    { {
            $this->product = new Products();
        }
    }

    public function showLogin()
    {
        require_once 'views/login.php';
        $error = '';
    }
    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // session_start(); // QUAN TRỌNG: phải có dòng này

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $user = $userModel->login($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            // var_dump($_SESSION['user']);

            if ($user['role'] === 'admin') {
                header('Location: ./admin/index.php');
                exit();
            } else {
                $products = $this->product->getProducts();
                require_once 'views/home.php';
                exit();
            }
        } else {
            $error = "Sai email hoặc mật khẩu";
            require_once 'views/login.php';
        }
    } else {
        require_once 'views/login.php';
    }
}
}
