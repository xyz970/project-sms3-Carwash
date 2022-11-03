<?php

trait Koneksi
{
    public function mysql()
    {
        /**
         * Buat koneksi
         * $server = "localhost"
         * $username = "root";
         * $password = "";
         * $db = "native";
         */
        $server = "localhost";
        $username = "adi_sptro";
        $password = "12345678";
        $db = "nb-carwash";
        $koneksi = mysqli_connect($server, $username, $password, $db);

        if (mysqli_connect_error()) {
            echo "Koneksi gagal " . mysqli_connect_error();
        }
        return $koneksi;
    }
}
