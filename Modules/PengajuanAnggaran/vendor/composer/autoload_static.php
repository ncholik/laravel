<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2882b0381e6e4a7136e9da282b8f42e
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\PengajuanAnggaran\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\PengajuanAnggaran\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2882b0381e6e4a7136e9da282b8f42e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2882b0381e6e4a7136e9da282b8f42e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2882b0381e6e4a7136e9da282b8f42e::$classMap;

        }, null, ClassLoader::class);
    }
}
