<?php
// include 'BaseModel.php';
class User extends BaseModel
{
    protected $table = "users";
    protected $result;
    public function all()
    {
        $sql = "select * from $this->table";
        $result = $this->mysql()->query($sql);
        return $result;
    }

    public function rawQuery($str)
    {
        $result = $this->mysql()->query($str);
        $this->result = $result;
        return $this;
    }
    
    public function where($condition)
    {
        $where = $this->mapped_where(' ,',$condition);
        $sql = "select * from $this->table where $where";
        // echo $sql;
        $result = $this->mysql()->query($sql);
        $this->result = $result;
        return $this;
    }

    public function get()
    {
        return $this->result;
    }
    // public function a()
    // {
    //     return $this;
    // }
    // public function b()
    // {
    //     return $this;
    // }
}
