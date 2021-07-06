<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5e32fc25b72c9b332ad7caf799c631e4
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpGPX\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpGPX\\' => 
        array (
            0 => __DIR__ . '/..' . '/sibyx/phpgpx/src/phpGPX',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5e32fc25b72c9b332ad7caf799c631e4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5e32fc25b72c9b332ad7caf799c631e4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5e32fc25b72c9b332ad7caf799c631e4::$classMap;

        }, null, ClassLoader::class);
    }
}