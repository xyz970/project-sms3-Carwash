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
// $folder = 'folder1.folder2.folder3.file';
// // $path =
// $path = str_replace(['.'],['/'],$folder);
// print_r(VIEW_PATH."$path.php");

$array = array(
    'email' => "sdjakals",
    'password' => "slkahdkhasd",
);
// // print_r(http_build_query($array, '', ','));
// // echo $array['email'];

// $field = '`' . implode('`, `', array_keys($array)) . '`';
// $input   = "'" . implode("', '", array_values($array)) . "'";
// echo $input;

function mapped_implode($glue, $array, $symbol = '=') {
    return implode($glue, array_map(
            function($k, $v) use($symbol) {
                return "`".$k."`" . $symbol . $v."";
            },
            array_keys($array),
            array_values($array)
            )
        );
}

// $arr = [
//     'x'=> 5,
//     'y'=> 7,
//     'z'=> 99,
//     'hello' => 'World',
//     7 => 'Foo',
// ];

// echo mapped_implode(', ', $array, );

$str = "Saya ingin belajar auto perf";
$array = explode(' ',$str);

for ($i=0; $i < count($array); $i++) { 
    if (strlen($array[$i]) == 4) {
        echo ' '.$array[$i].' ';
    }
}