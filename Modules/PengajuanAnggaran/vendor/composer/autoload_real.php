<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc2882b0381e6e4a7136e9da282b8f42e
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

        spl_autoload_register(array('ComposerAutoloaderInitc2882b0381e6e4a7136e9da282b8f42e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc2882b0381e6e4a7136e9da282b8f42e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc2882b0381e6e4a7136e9da282b8f42e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
