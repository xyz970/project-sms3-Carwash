<?php

class FileNotFound extends Exception
{
    public function errorMessage()
    {
        $error = "Opps File tidak ditemukan \n $this->getMessage()";
        return $error;
    }
}
