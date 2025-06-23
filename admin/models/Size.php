<?php
class Size extends BaseModel
{
    protected $table = 'sizes'; // hoặc comments nếu bạn đặt tên vậy

   public function getAllSize()
{
    $sql = "SELECT *
            FROM $this->table";
    
    $this->setQuery($sql);
    return $this->loadAllRows(); // Không truyền tham số
}
    public function getSizeId($id)
    {

        $sql = "SELECT *
                FROM $this->table 
                where id = ?";

        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
public function getByName($name)
{
    $sql = "SELECT * FROM $this->table WHERE name = ?";
    $this->setQuery($sql);
    return $this->loadRow([$name]);
}
    public function deleteSize($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function updateSize($id, $name, $status)
    {
        $sql = "UPDATE $this->table SET name = ?, status = ? WHERE id = ?";

        $this->setQuery($sql);
        return $this->execute([$name, $status, $id]);
    }
    public function createSize($name, $status)
    {
        $sql = "INSERT INTO $this->table (name, status) VALUES (?, ?)";
        $this->setQuery($sql);
        return $this->execute([$name, $status]);
    }
    public function toggleSize($id, $status)
    {
        $sql = "UPDATE $this->table SET status = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$status, $id]);
    }
    //     public function toggleStatus($id, $newStatus)
    // {
    //     $sql = "UPDATE $this->table SET status = ? WHERE id = ?";
    //     $this->setQuery($sql);
    //     return $this->execute([$newStatus, $id]);
    // }
}
