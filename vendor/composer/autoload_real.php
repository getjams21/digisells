<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit86067c74cfa24d45ca38929d0a7757af
=======
class ComposerAutoloaderInit99e27cbca5b7e014ae864c9da30417c7
>>>>>>> 289a5c114f25207af027666f6b49511d25356280
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit86067c74cfa24d45ca38929d0a7757af', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit86067c74cfa24d45ca38929d0a7757af', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInit99e27cbca5b7e014ae864c9da30417c7', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit99e27cbca5b7e014ae864c9da30417c7', 'loadClassLoader'));

        $vendorDir = dirname(__DIR__);
        $baseDir = dirname($vendorDir);
>>>>>>> 289a5c114f25207af027666f6b49511d25356280

        $includePaths = require __DIR__ . '/include_paths.php';
        array_push($includePaths, get_include_path());
        set_include_path(join(PATH_SEPARATOR, $includePaths));

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
            composerRequire86067c74cfa24d45ca38929d0a7757af($file);
=======
            composerRequire99e27cbca5b7e014ae864c9da30417c7($file);
>>>>>>> 289a5c114f25207af027666f6b49511d25356280
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequire86067c74cfa24d45ca38929d0a7757af($file)
=======
function composerRequire99e27cbca5b7e014ae864c9da30417c7($file)
>>>>>>> 289a5c114f25207af027666f6b49511d25356280
{
    require $file;
}
