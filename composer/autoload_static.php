<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit75cae706a6c338d4ae11382d9d65fa9d
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim',
            ),
        ),
    );

    public static $classMap = array (
        'Firebase\\Error' => __DIR__ . '/..' . '/slim/firebase-php/src/firebaseStub.php',
        'Firebase\\FirebaseInterface' => __DIR__ . '/..' . '/slim/firebase-php/src/firebaseInterface.php',
        'Firebase\\FirebaseLib' => __DIR__ . '/..' . '/slim/firebase-php/src/firebaseLib.php',
        'Firebase\\FirebaseStub' => __DIR__ . '/..' . '/slim/firebase-php/src/firebaseStub.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit75cae706a6c338d4ae11382d9d65fa9d::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit75cae706a6c338d4ae11382d9d65fa9d::$classMap;

        }, null, ClassLoader::class);
    }
}
