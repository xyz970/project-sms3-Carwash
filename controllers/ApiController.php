<?php
require_once(APP_PATH.'traits/Request.php');
class ApiController
{
    use Request;
    public function getAccessToken()
    {
        return 'X6rOEb8l6g7IK26yPGXGcDGbjMrTx3yPPBYHxuKh';
    }
    public function getRefreshToken()
    {
        return 'eGSRR6CN4IXy2U5415MwSH5Prw0gGu3V1AtocQOs';
    }
    public function succesResponse($data = '', $message = "Success")
    {
        header('Content-Type: application/json');
        $response = array(
            'status' => 'true',
            'message' => $message,
            'data' => $data,
        );
        if (empty($data)) {
            $response = array(
                'status' => 'true',
                'message' => $message,
            );
        }
        echo json_encode($response);
    }

    public function errorResponse($message = 'Not Found',$code = 404)
    {
        http_response_code($code);
        $data = array(
            'message'=>$message,
            'status' => $code,
        );
        echo json_encode($data);
    }
}
