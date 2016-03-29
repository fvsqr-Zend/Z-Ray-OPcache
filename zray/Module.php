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
                'opStatistics' => false,
                'opcacheScripts' => false
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
                ),
                'opcacheScriptList' => array(
                    'display' => true,
                    'logo' => 'logo.png',
                    'menuTitle' => 'OPcache Script List',
                    'panelTitle' => 'OPcache Script List',
                    'resources' => array(
                    ),
                    'searchId'  => 'script-list-pager-id', 
                    'pagerId'     => 'script-list-search-id', 
                )
            )
        );
    }
}
