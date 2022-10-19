<?php

use Firebase\JWT\JWT;

class AuthController extends ApiController
{

    public function postLogin()
    {
        // Ambil JSON yang dikirim oleh user
        $json = file_get_contents('php://input');
        // Decode json tersebut agar mudah mengambil nilainya
        $input = json_decode($json);
        $user = [
            'email' => 'johndoe@example.com',
            'password' => 'qwerty123'
        ];
        $expired_time = time() + (15 * 60);
        $payload = [
            'email' => $input->email,
            'exp' => $expired_time
        ];
        $access_token = JWT::encode($payload,$this->getAccessToken(),'HS256');
        echo json_encode([
            'accessToken' => $access_token,
            'expiry' => date(DATE_ISO8601, $expired_time)
        ]);
    }
}
