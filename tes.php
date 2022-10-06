<?php

function arrayPost($array)
{
    $count = count($array);
    for ($i=0; $i < $count; $i++) { 
        $data[] = $array[$i];
    }
    return $data;
}
$array = ['input1', 'input2', 'input3'];
print_r(arrayPost($array));
// echo string
// echo $array[1];
