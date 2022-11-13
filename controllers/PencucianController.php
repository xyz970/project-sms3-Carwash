<?php

class PencucianController extends BaseController
{

    private $tipecuci;
    public function __construct()
    {
        $this->tipecuci = new DetailPencucian();
    }

    public function getDetail_pencucian()
    {
        header('Content-Type: application/json');
        $type = $this->get('type');
        $cuci = $this->tipecuci->where(array("type" => $type))->get();
        // $tipecuci = $this->tipecuci->rawQuery("select * from wash_types where type = '$type'")->get();
        $data = [];
        if ($cuci->num_rows > 0) {
            while ($row = $cuci->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            echo "0 results";
        }
        // print_r($data);
        echo json_encode($data);
    }
    public function getDetail_harga()
    {
        header('Content-Type: application/json');
        $id = $this->get('id');
        $cuci = $this->tipecuci->where(array("id" => $id))->get();
        $data = [];
        if ($cuci->num_rows > 0) {
            while ($row = $cuci->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            echo "0 results";
        }
        // print_r($data);
        echo json_encode($data);
    }
}
