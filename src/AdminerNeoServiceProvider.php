<?php
namespace SabbottLabs\AdminerNeo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use SabbottLabs\AdminerNeo\Http\Middleware\AdminerNeoMiddleware;

use function resource_path;
use function base_path;
use function config_path;
use function config;

class AdminerNeoServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        if (!config('adminerneo.enabled', true)) {
            return;
        }
    
        if ($this->app->runningInConsole()) {
            // Create directories before publishing
            $resourcePath = resource_path('adminerneo');
            $pluginsPath = $resourcePath . '/plugins';
    
            if (!is_dir($resourcePath)) {
                mkdir($resourcePath, 0755, true);
            }
    
            if (!is_dir($pluginsPath)) {
                mkdir($pluginsPath, 0755, true);
            }
    
            // Get builder package path
            $builderPath = base_path('vendor/sabbottlabs/laravel-adminerneo-builder');

            // Publish all files
            $this->publishes([
                __DIR__.'/../config/adminerneo.php' => config_path('adminerneo.php'),
                $builderPath . '/output' => resource_path('adminerneo'),
            ], 'adminerneo');
        }
    
        if (!$this->app->routesAreCached()) {
            $this->registerRoutes($router);
        }
    
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