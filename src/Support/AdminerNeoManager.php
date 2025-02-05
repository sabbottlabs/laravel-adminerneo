<?php
namespace SabbottLabs\AdminerNeo\Support;

class AdminerNeoManager
{
    public function handle()
    {
        $adminerPath = resource_path('adminerneo');
        $adminerFile = $adminerPath . '/adminer.php';
        
        if (!file_exists($adminerFile)) {
            throw new \RuntimeException('AdminerNeo not found. Run: php artisan vendor:publish --tag=adminerneo');
        }
        
        chdir($adminerPath); // Change directory to allow plugin includes
        return require $adminerFile;
    }
}