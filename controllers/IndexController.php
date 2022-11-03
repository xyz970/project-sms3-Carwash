<?php

class IndexController extends BaseController
{
    public function getIndex()
    {
        return $this->view('login');
    }
    
}