<?php
namespace SabbottLabs\AdminerNeo\Http\Controllers;

use Illuminate\Routing\Controller;

use function resource_path;

class AdminerNeoController extends Controller
{
    public function index()
    {
        $adminerFile = resource_path('adminerneo/adminer.php');
        
        if (!file_exists($adminerFile)) {
            throw new \RuntimeException('AdminerNeo not found. Run: php artisan vendor:publish --tag=adminerneo');
        }
        
        return require __DIR__ . '/../../../resources/views/adminerneo/index.php';
    }
}