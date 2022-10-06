<?php
define('APP_PATH', './');
define('API_CONTROLLER_PATH', APP_PATH . 'controllers/api/');

/**
 * Note:
 * URI adalah karakter umum yang mengidentifikasi sebuah resource web menggunakan nama, lokasi, atau nama dan lokasi resource tersebut. 
 *  Baik resource pada internet, maupun tidak.
 *  ex. localhost/test/index.php/
 * 
 * URL merupakan kepanjangan dari Uniform Resource Locator hal ini berkaitan dengan karakter tertentu.
 *  biasanya terdiri dari angka, huruf dan simbol yang menuju ke alamat www (World Wide Web)
 * ex. http://localhost/test/index.php/
 * URL == URI Tapi URI != URL
 *  
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (strtolower($uri[3]) == "api") {
    $class = ucfirst($uri[4]);
    $file = API_CONTROLLER_PATH . $class . "Controller.php";
    require $file;
    $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
    $targetClass = $class . 'Controller';
    $controller = new $targetClass();
    $strMethodName = $requestMethod.ucfirst($uri[5]);
    $controller->$strMethodName();
}
