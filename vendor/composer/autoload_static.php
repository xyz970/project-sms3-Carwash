<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdbfe0a12bb8667e4cf1b36c34a2f133f
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'P' => 
        array (
            'PhpOption\\' => 10,
        ),
        'G' => 
        array (
            'GrahamCampbell\\ResultType\\' => 26,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
        'GrahamCampbell\\ResultType\\' => 
        array (
            0 => __DIR__ . '/..' . '/graham-campbell/result-type/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static $classMap = array (
        'AdminController' => __DIR__ . '/../..' . '/controllers/AdminController.php',
        'ApiController' => __DIR__ . '/../..' . '/controllers/ApiController.php',
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Auth' => __DIR__ . '/../..' . '/traits/Auth.php',
        'AuthController' => __DIR__ . '/../..' . '/controllers/AuthController.php',
        'BaseController' => __DIR__ . '/../..' . '/controllers/BaseController.php',
        'BaseModel' => __DIR__ . '/../..' . '/models/BaseModel.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'IndexController' => __DIR__ . '/../..' . '/controllers/IndexController.php',
        'Koneksi' => __DIR__ . '/../..' . '/traits/Koneksi.php',
        'LoginController' => __DIR__ . '/../..' . '/controllers/api/LoginController.php',
        'LogoutController' => __DIR__ . '/../..' . '/controllers/api/LogoutController.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Request' => __DIR__ . '/../..' . '/traits/Request.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'User' => __DIR__ . '/../..' . '/models/User.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/api/UserController.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdbfe0a12bb8667e4cf1b36c34a2f133f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdbfe0a12bb8667e4cf1b36c34a2f133f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdbfe0a12bb8667e4cf1b36c34a2f133f::$classMap;

        }, null, ClassLoader::class);
    }
}
