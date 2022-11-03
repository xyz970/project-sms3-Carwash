<?php

class LoginController extends ApiController{

    use Request;
    public function getIndex()
    {
        return $this->succesResponse('Hello World');
    }

}