<?php

spl_autoload_register(function($class){
    require_once CONTROLLER_PATH . "$class.php";
});

spl_autoload_register(function($class){
    require_once MODELS_PATH . "$class.php";
});

spl_autoload_register(function($class){
    require_once TRAIT_PATH . "$class.php";
});