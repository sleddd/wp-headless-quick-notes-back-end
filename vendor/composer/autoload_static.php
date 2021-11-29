<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3831819c8c8a3f9d6f84c9c1fd85192a
{
    public static $files = array (
        'adaedfb8214b270ce0289a48a0ad2997' => __DIR__ . '/../..' . '/src/lib/cpts.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WpStarterPlugin\\' => 16,
        ),
        'V' => 
        array (
            'VariableAnalysis\\' => 17,
        ),
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WpStarterPlugin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes',
        ),
        'VariableAnalysis\\' => 
        array (
            0 => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis',
        ),
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\Plugin' => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src/Plugin.php',
        'VariableAnalysis\\Lib\\Constants' => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis/Lib/Constants.php',
        'VariableAnalysis\\Lib\\Helpers' => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis/Lib/Helpers.php',
        'VariableAnalysis\\Lib\\ScopeInfo' => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis/Lib/ScopeInfo.php',
        'VariableAnalysis\\Lib\\ScopeType' => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis/Lib/ScopeType.php',
        'VariableAnalysis\\Lib\\VariableInfo' => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis/Lib/VariableInfo.php',
        'VariableAnalysis\\Sniffs\\CodeAnalysis\\VariableAnalysisSniff' => __DIR__ . '/..' . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis/Sniffs/CodeAnalysis/VariableAnalysisSniff.php',
        'WpStarterPlugin\\WpStarterPlugin' => __DIR__ . '/../..' . '/src/classes/WpStarterPlugin.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3831819c8c8a3f9d6f84c9c1fd85192a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3831819c8c8a3f9d6f84c9c1fd85192a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3831819c8c8a3f9d6f84c9c1fd85192a::$classMap;

        }, null, ClassLoader::class);
    }
}
