<?php
require_once(APP_PATH.'traits/Request.php');
class ApiController
{
    use Request;
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
}
