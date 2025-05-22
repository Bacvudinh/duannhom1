<?php
require_once 'models/User.php';

class LoginController
{
        public $product;
    public function __construct() {
            {
        $this->product = new Products();
    }
    }

    public function showLogin()
    {
        require_once 'views/login.php';
        $error = '';
    }
    public function  login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->login($email, $password);

            if ($user) {

                $_SESSION['user'] = $user;
  $products = $this->product->getProducts();
                require_once 'views/home.php';
                exit();
            } else {
                $error = "Sai email hoặc mật khẩu";
                require_once 'views/login.php';
            }
        }
    }
}
