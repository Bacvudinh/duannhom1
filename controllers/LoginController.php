<?php
    require_once 'models/User.php';

    class LoginController{
        public $product;
        public function __construct(Type $var = null) {
    $this->product= new Products();
}
        public function showLogin(){
            require_once 'views/login.php';
            $error = '';
            
        }
        public function  login(){
            if($_SERVER['REQUEST_METHOD']== 'POST'){
                $email = $_POST['email'];
                $password = $_POST['password'];

                $userModel = new UserModel();
                $user = $userModel->login($email,$password);

                if ($user) {
                    $_SESSION['user']= $user;
                    // Phân quyền
                        if ($user['role'] == 'admin') {
                             require_once 'admin/index.php'; // Gọi router admin
                            return;
                        } else {
                            $products = $this->product->getProducts();
                            require_once 'views/home.php';
                        }
                    
                }else{
                    $error = "Sai email hoặc mật khẩu";
                    require_once 'views/login.php';
                }
            }
        }
    }
?> 