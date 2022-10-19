<?php

class UserController extends ApiController{

    /**
     * method yang akan di panggil ketika aplikasi dijalankan
     * tolong sesuaikan dengan syntax dibawah
     * public function [Request_method(get,post,put,delete)]Nama(){
     * }
     */

    public function getList()
    {
        // $user = new User();
        // while ($row = mysqli_fetch_assoc($user->get())) {
        //     $count = count($row);
        //     $data[] = $row;
        //     if (count($row) == $count) {
        //         break;
        //     }
        // }
        $data = $this->input()->get('id');
        $this->succesResponse($data);
    }

    public function postInsert()
    {
        $data = array(
            'input1' => $this->post('input1'),
        );
        $this->succesResponse($data);   
    }

}