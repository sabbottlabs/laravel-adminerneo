<?php
namespace SabbottLabs\AdminerNeo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use SabbottLabs\AdminerNeo\Http\Middleware\AdminerNeoMiddleware;
use FilesystemIterator;

use function resource_path;
use function base_path;
use function config_path;
use function config;

class AdminerNeoServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        // Skip if AdminerNeo is disabled in config
        if (!config('adminerneo.enabled', true)) {
            return;
        }
    
        if ($this->app->runningInConsole()) {
            // Define paths used throughout the publishing process
            $resourcePath = resource_path('adminerneo');
            $pluginsPath = $resourcePath . '/plugins';
            $builderPath = base_path('vendor/sabbottlabs/laravel-adminerneo-builder');
    
            // Register publishable resources for the package
            // This includes config file and all assets
            $this->publishes([
                __DIR__.'/../config/adminerneo.php' => config_path('adminerneo.php'),
                $builderPath . '/output' => resource_path('adminerneo'),
            ], 'adminerneo');
    
            // Register assets-only publishable resources
            // Useful when only needing to refresh frontend assets
            $this->publishes([
                $builderPath . '/output' => resource_path('adminerneo'),
            ], 'adminerneo-assets');
    
            // Only perform directory operations during explicit publish commands
            // This prevents accidental plugin removal during composer operations
            $isPublishCommand = isset($_SERVER['argv'][1]) && (
                str_contains($_SERVER['argv'][1], 'vendor:publish') ||
                str_contains($_SERVER['argv'][1], 'package:discover')
            );
    
            // Check if we're explicitly publishing our package assets
            $isPublishingAssets = isset($_SERVER['argv']) && (
                in_array('--tag=adminerneo-assets', $_SERVER['argv']) ||
                in_array('--tag=adminerneo', $_SERVER['argv'])
            );
    
            // Handle plugin directory cleanup only during asset publishing
            if ($isPublishCommand && $isPublishingAssets) {
                // Remove existing plugins to ensure clean state
                if (is_dir($pluginsPath)) {
                    $this->removeDirectory($pluginsPath);
                }
            }
    
            // Ensure required directories exist
            // This maintains consistent structure regardless of operation
            if (!is_dir($resourcePath)) {
                mkdir($resourcePath, 0755, true);
            }
            if (!is_dir($pluginsPath)) {
                mkdir($pluginsPath, 0755, true);
            }
        }
    
        // Register routes if they aren't cached
        if (!$this->app->routesAreCached()) {
            $this->registerRoutes($router);
        }
    
        // Register middleware alias for route protection
        $router->aliasMiddleware('adminerneo', AdminerNeoMiddleware::class);
    }

    protected function removeDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }
        
        $items = new FilesystemIterator($dir);
        foreach ($items as $item) {
            if ($item->isDir()) {
                $this->removeDirectory($item->getPathname());
            } else {
                unlink($item->getPathname());
            }
        }
        rmdir($dir);
    }

    protected function registerRoutes(Router $router)
    {
        $router->group([
            'prefix' => config('adminerneo.route_prefix', 'adminerneo'),
            'middleware' => config('adminerneo.middleware', ['web', 'auth', 'adminerneo']),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/adminerneo.php', 'adminerneo');
    }
}