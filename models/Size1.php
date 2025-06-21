<?php
class Size1 extends BaseModel
{
    protected $table = 'sizes'; // hoặc comments nếu bạn đặt tên vậy

   public function getAllSize()
{
    $sql = "SELECT *
            FROM $this->table 
            WHERE status = 1"; // Chỉ lấy các kích thước đang hoạt động
    
    $this->setQuery($sql);
    return $this->loadAllRows(); // Không truyền tham số
}
    
}
