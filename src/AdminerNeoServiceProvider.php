<?php
namespace SabbottLabs\AdminerNeo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class AdminerNeoServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        if (!config('adminerneo.enabled', true)) {
            return;
        }
    
        if (!$this->app->routesAreCached()) {
            $this->registerRoutes($router);
        }
    
        // Single publish group for all files
        $this->publishes([
            __DIR__.'/../config/adminerneo.php' => config_path('adminerneo.php'),
            __DIR__.'/../resources/adminerneo' => resource_path('adminerneo'),
        ], 'adminerneo');

        $router->aliasMiddleware('adminerneo', AdminerNeoMiddleware::class);
    }

    protected function registerRoutes(Router $router)
    {
        $router->group([
            'prefix' => config('adminerneo.route_prefix', 'adminerneo'),
            'middleware' => config('adminerneo.middleware', ['web', 'auth']),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/adminerneo.php', 'adminerneo');
    }
}