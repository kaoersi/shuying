<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf605b65a55a4572a6f390f676eee2a15
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf605b65a55a4572a6f390f676eee2a15::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf605b65a55a4572a6f390f676eee2a15::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf605b65a55a4572a6f390f676eee2a15::$classMap;

        }, null, ClassLoader::class);
    }
}
