<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInited17425b92b1ee4fc6954c1ff20fcdbd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInited17425b92b1ee4fc6954c1ff20fcdbd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInited17425b92b1ee4fc6954c1ff20fcdbd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInited17425b92b1ee4fc6954c1ff20fcdbd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}