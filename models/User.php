<?php
include 'BaseModel.php';
class User extends BaseModel{

    protected $table = "diri";
    public function get()
    {
        return $this->getData("diri");
    }
}