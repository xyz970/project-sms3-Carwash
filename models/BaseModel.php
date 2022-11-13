<?php
include APP_PATH . 'traits/Koneksi.php';
class BaseModel
{
    use Koneksi;

    public function all()
    {
        $sql = "select * from $this->table";
        $result = $this->mysql()->query($sql);
        return $result;
    }

    // public function getData($table)
    // {
    //     $sql = "select * from $table";
    //     $result = $this->mysql()->query($sql);
    //     return $result;
    // }

    function mapped_where($glue, $array, $symbol = '=')
    {
        return implode(
            $glue,
            array_map(
                function ($k, $v) use ($symbol) {
                    return $k . $symbol . "'" . $v . "'";
                },
                array_keys($array),
                array_values($array)
            )
        );
    }
    public function rawQuery($str)
    {
        $result = $this->mysql()->query($str);
        $this->result = $result;
        return $this;
    }



    public function where($condition)
    {
        $where = $this->mapped_where(' ,', $condition);
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
}
