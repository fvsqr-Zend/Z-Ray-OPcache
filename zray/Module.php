<?php
namespace OPcache;

class Module extends \ZRay\ZRayModule
{

    public function config()
    {
        return array(
            'extension' => array(
                'name' => 'opcache'
            ),
            'defaultPanels' => array(
                'opBlacklist' => false,
                'opDirectives' => false,
                'opVersion' => false,
                'opInternedStringsUsage' => false,
                'opMemoryUsage' => false,
                'opStatistics' => false
            ),
            'panels' => array(
                'opcacheStatus' => array(
                    'display' => true,
                    'logo' => 'logo.png',
                    'menuTitle' => 'OPcache Status',
                    'panelTitle' => 'OPcache Status',
                    'resources' => array(
                        'chart' => 'chart.js'
                    )
                )
            )
        );
    }
}
