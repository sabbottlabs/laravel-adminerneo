<?php
use Adminer\Pluginer;
use function resource_path;

function create_adminer(): Pluginer
{
    $resourcePath = resource_path('adminerneo');
    
    // Required to run any plugin.
    include "{$resourcePath}/plugins/Pluginer.php";
    
    $plugins = [];
    
    foreach (config('adminerneo.plugins') as $plugin => $settings) {
        $pluginFile = "{$resourcePath}/plugins/{$plugin}.php";
        
        if (file_exists($pluginFile)) {
            include $pluginFile;
            $className = '\Adminer\Adminer' . str_replace(' ', '', ucwords(str_replace('-', ' ', $plugin)));
            
            // Pass settings if they exist
            if (is_array($settings)) {
                $plugins[] = new $className($settings);
            } else {
                $plugins[] = new $className();
            }
        }
    }
    
    $config = config('adminerneo.interface', []);
    
    return new Pluginer($plugins, $config);
}

include resource_path('adminerneo/adminer.php');