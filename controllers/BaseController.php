<?php
class BaseController
{

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
