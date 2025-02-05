<?php
namespace SabbottLabs\AdminerNeo\Http\Controllers;

use Illuminate\Routing\Controller;
use SabbottLabs\AdminerNeo\Support\AdminerNeoManager;

class AdminerNeoController extends Controller
{
    public function __construct(protected AdminerNeoManager $manager)
    {
        // Auto-login handling
        if (config('adminerneo.autologin')) {
            $connection = config('database.default');
            $_POST['auth'] = [
                'server' => config("database.connections.{$connection}.host") . ':' . config("database.connections.{$connection}.port"),
                'db' => config("database.connections.{$connection}.database"),
                'username' => config("database.connections.{$connection}.username"),
                'password' => config("database.connections.{$connection}.password")
            ];
        }
    }

    public function index()
    {
        if (!config('adminerneo.enabled')) {
            abort(404);
        }

        return $this->manager->handle();
    }
}