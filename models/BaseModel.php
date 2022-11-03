<?php
include APP_PATH.'traits/Koneksi.php';
class BaseModel{
    use Koneksi;

    public function getData($table)
    {
        $sql = "select * from $table";
        $result = $this->mysql()->query($sql);
        return $result;
    }

    function mapped_where($glue, $array, $symbol = '=') {
        return implode($glue, array_map(
                function($k, $v) use($symbol) {
                    return "`".$k."`" . $symbol . "'".$v."'";
                },
                array_keys($array),
                array_values($array)
                )
            );
    }
}