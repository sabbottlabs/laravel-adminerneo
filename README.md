# Laravel AdminerNeo

Laravel integration for AdminerNeo database management.

## Installation

1. Install via Composer:
```bash
composer require sabbottlabs/laravel-adminerneo
```

2. Publish assets:
```bash
php artisan vendor:publish --tag=adminerneo
```

3. Register Middleware in `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'adminerneo' => \SabbottLabs\AdminerNeo\Http\Middleware\AdminerNeoMiddleware::class,
    ]);
})
```

4. Add environment variables (optional):
```env
ADMINERNEO_ENABLED=true
ADMINERNEO_ROUTE_PREFIX=adminerneo
ADMINERNEO_AUTO_LOGIN=false
```

## Configuration

See `config/adminerneo.php` for all configuration options.
