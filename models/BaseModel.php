<?php


class BaseModel
{
    protected $pdo = NULL;
    protected $sql = '';
    protected $sta = NULL;

    // Hàm kết nối với cơ sở dữ liệu
    public function getConnect()
    {
        //set connect
     $this->pdo = new PDO(
            "mysql:host=" . DB_HOST
            . ";dbname=" . DB_NAME,
           
            DB_USERNAME,
            DB_PASSWORD
        );
        return $this->pdo;
    }

    // Hàm set query
    public function setQuery($sql)
    {
        return $this->sql = $sql;
    }

    // Hàm thực thi câu truy vấn SQL
    public function execute($options = array(), $sql = "")
    {
        $this->pdo = $this->getConnect();  // Sử dụng $this để gọi phương thức trong class
        $this->sta = $this->pdo->prepare($this->sql);
        if ($options) {  // Nếu có $options thì truyền tham số vào câu truy vấn
            for ($i = 0; $i < count($options); $i++) {
                $this->sta->bindParam($i + 1, $options[$i]);
            }
        }
        $this->sta->execute();
        return $this->sta;
    }

    // Hàm lấy nhiều dữ liệu từ bảng
    public function loadAllRows($options = array(), $sql = "")
    {
        $result = $this->execute($options, $sql);  // Không cần kiểm tra $options trước
        if (!$result) {
            return false;
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    // Hàm lấy một dòng dữ liệu từ bảng
    public function loadRow($option = array(), $sql = "")
    {
        $result = $this->execute($option, $sql);  // Sửa lỗi cú pháp: thay "y execute" thành "execute"
        if (!$result) {
            return false;
        }
        return $result->fetch(PDO::FETCH_OBJ);
    }
}
