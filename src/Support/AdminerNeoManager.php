<?php
namespace SabbottLabs\AdminerNeo\Support;
use function resource_path;

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
        return require __DIR__ . '/../../resources/views/adminerneo/index.php';
    }
}