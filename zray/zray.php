<?php

namespace OPcache;


$zre = new \ZRayExtension('opcache');
$zre->setMetadata(array(
    'logo' => __DIR__ . DIRECTORY_SEPARATOR . 'logo.png',
    'actionsBaseUrl' => $_SERVER['REQUEST_URI'] 
));

function shutdown() {}

if (extension_loaded('Zend OPcache')) {
 
    register_shutdown_function('OPcache\shutdown');
    
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'OPcache.php';
    
    $opcache = new OPcache();
    $zre->setEnabledAfter('OPcache\shutdown');
    $zre->traceFunction(
       'OPcache\shutdown', 
        function() {},
        array(
            $opcache,
            'shutdown'
        )
    );

    $zre->attachAction('clearCache', 'OPcache\shutdown', function(){ return opcache_reset(); });
}

