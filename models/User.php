<?php
    class UserModel{
        private $conn;

        public function __construct(){
            $this->conn = connectDB();
        }

        public function login($email , $password){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user){
                if($password === $user['password']){
                return $user;
            }
             
            }

        return false;
        }


    }
?> 