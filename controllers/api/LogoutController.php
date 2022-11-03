<?php

class LogoutController extends ApiController{

    use Request;
    public function getIndex()
    {
        return $this->succesResponse('Hello World');
    }

}