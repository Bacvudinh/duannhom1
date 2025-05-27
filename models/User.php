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

            if ($user && password_verify($password, $user['password'])) {
                return $user; // Đăng nhập thành công
            }else{
                return ['error' => 'Sai email hoặc mật khẩu']; // Sai email hoặc mật khẩu
            }

            ; // Sai email hoặc mật khẩu
        }
        public function register($name, $email, $password) {
        // Kiểm tra email đã tồn tại chưa
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return false; // Email đã tồn tại
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng mới
        $role = 'customer';
        $created_at = date('Y-m-d H:i:s');

       $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone, address, role, created_at) 
                                  VALUES (:name, :email, :password, :phone, :address, :role, :created_at)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'address' => $address,
            'role' => $role,
            'created_at' => $created_at
        ]);
    }

    }
?> 