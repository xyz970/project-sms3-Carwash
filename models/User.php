<?php
// include 'BaseModel.php';
class User extends BaseModel{

    protected $table = "diri";
    public function get()
    {
        $sql = "select * from $this->table";
        $result = $this->mysql()->query($sql);
        return $result;
    }
}