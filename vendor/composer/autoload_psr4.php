<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'WpStarterPlugin\\' => array($baseDir . '/src/classes', $baseDir . '/src/classes/PostTypes', $baseDir . '/src/classes/Settings'),
    'VariableAnalysis\\' => array($vendorDir . '/sirbrillig/phpcs-variable-analysis/VariableAnalysis'),
    'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => array($vendorDir . '/dealerdirect/phpcodesniffer-composer-installer/src'),
);
