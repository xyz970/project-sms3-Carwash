<?php

class AuthController extends BaseController
{
    // use Auth;
    private $user;
    public function __construct() {
        session_start();
        $this->user = new User();
    }
    public function postLogin()
    {
        $email = $this->post('email');
        $password = $this->post('password');
        $user = $this->user->where(['email'=>$email])->get();
        echo $password;
        if ($user) {
            $user = mysqli_fetch_assoc($user);
            if (password_verify($password,$user['password'])) {
                $_SESSION["user"] = $user;
                header("Location: ".BASE_URL."admin");
            }   
        }
        // $data['hello'] = "Hello World";
        // $template = 'subfolder.tes12';
        // return $this->view($template,$data);
    }

}
