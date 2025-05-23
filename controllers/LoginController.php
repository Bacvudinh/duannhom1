<?php
require_once 'models/User.php';

    class LoginController{
        public $product;
        public function __construct(Type $var = null) {
    $this->product= new Products();
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
                    header('Location: index.php?act=loginForm');
                    exit();
                }

    }
