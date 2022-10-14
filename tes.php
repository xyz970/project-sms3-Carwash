<?php

// function arrayPost($array)
// {
//     $count = count($array);
//     for ($i=0; $i < $count; $i++) { 
//         $data[] = $array[$i];
//     }
//     return $data;
// }
// $array = ['input1', 'input2', 'input3'];
// print_r(arrayPost($array));
// echo string
// echo $array[1];
$folder = 'folder1.folder2.folder3.file';
// $path =
$path = str_replace(['.'],['/'],$folder);
print_r(VIEW_PATH."$path.php");