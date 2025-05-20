<?php
    require_once 'models/User.php';

    class LoginController{
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
                    echo("Đăng Nhập Thành Công");
                    header("Location: views/home.php");
                    
                }else{
                    $error = "Sai email hoặc mật khẩu";
                    require_once 'views/login.php';
                }
            }
        }
    }
?> 