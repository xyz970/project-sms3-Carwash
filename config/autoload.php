<?php

// spl_autoload_register(function($class){
//     require CONTROLLER_PATH . "$class.php";
// });

// spl_autoload_register(function($class){
//     require API_CONTROLLER_PATH . "$class.php";
// });

// spl_autoload_register(function($class){
//     require MODELS_PATH . "$class.php";
// });

// spl_autoload_register(function($class){
//     require TRAIT_PATH . "$class.php";
// });
spl_autoload_register(function($className) {
	$file = __DIR__ . '\\' . $className . '.php';
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
	if (file_exists($file)) {
		include $file;
	}
});
// class MyAutoLoader
// {

//     public function __construct()
//     {
//         spl_autoload_register(array($this, 'load'));
//     }

//     function load($class)
//     {
//         // $filepath = $class . '.php';
//         // if (is_file($filepath)) {
//         //     require $filepath;
//         // }
//         $path = APP_PATH .
//             str_replace("_", DIRECTORY_SEPARATOR, strtolower($class)) .
//             ".php";

//         if (is_file($path)) {
//             require $path;
//         }
//     }
// }
