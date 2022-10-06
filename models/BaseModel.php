<?php
include APP_PATH.'traits/koneksi.php';
class BaseModel{
    use Koneksi;

    public function getData($table)
    {
        $sql = "select * from $table";
        $result = $this->mysql()->query($sql);
        return $result;
    }
}