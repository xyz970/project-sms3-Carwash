<?php
include './../models/User.php';
include './../controllers/BaseController.php';
$user = new User();
$baseC = new BaseController();
header('Content-Type: application/json');

while ($row = mysqli_fetch_assoc($user->get())) {
    $count = count($row);
    $data[] = $row;
    if (count($row) == $count) {
        break;
    }
}
$baseC->succesResponse($data);