<?php
namespace OPcache;

class OPcache
{

    private $shutdownCalled = false;

    public function shutdown($context, &$storage)
    {
        if ($this->shutdownCalled)
            return;
        
        $this->shutdownCalled = true;
        
        $status = opcache_get_status();
        $config = opcache_get_configuration();
        
        error_log(var_export($status, true), 3, '/tmp/oc.log');
        
        $storage['opMemoryUsage'][] = $status['memory_usage'];
        $storage['opInternedStringsUsage'][] = $status['interned_strings_usage'];
        $storage['opStatistics'][] = $status['opcache_statistics'];
        $storage['opDirectives'][] = $config['directives'];
        $storage['opVersion'][] = $config['version'];
        $storage['opBlacklist'][] = $config['blacklist'];
        
        if ($scripts = $status['scripts']) {
        
            array_walk($scripts, function (&$item, $key)
            {
                $item = array_merge(array(
                    'name' => basename($item['full_path'])
                ), array(
                    'Full Path' => $item['full_path']
                ), $item);
                $item['memory Consumption'] = round($item['memory_consumption'] / 1024) . " KB ({$item['memory_consumption']} B)";
                $item['Last Used'] = $item['last_used'];
                $item['Last Used Timestamp'] = $item['last_used_timestamp'];
                $item['created'] = date("D M j G:i:s Y", $item['timestamp']);
                $item['created Timestamp'] = $item['timestamp'];
                unset($item['full_path']);
                unset($item['memory_consumption']);
                unset($item['last_used']);
                unset($item['last_used_timestamp']);
                unset($item['timestamp']);
            });
            
            $storage['opcacheScripts'] = $scripts;
        }
    }
}
