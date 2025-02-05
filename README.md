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

## Content Security Policy (CSP)

AdminerNeo requires specific CSP headers to function properly. The package sets these by default, but you may need to adjust them if:

- You have existing CSP middleware
- You see browser console warnings
- You need to customize security policies

Default CSP headers set by AdminerNeoMiddleware:
```php
Content-Security-Policy: 
    default-src 'self';
    script-src 'nonce-{random}' 'strict-dynamic' 'unsafe-eval';
    style-src 'self' 'unsafe-inline';
    img-src 'self' data: blob:;
    connect-src 'self';
```

Note: Browser console may show CSP warnings due to 'strict-dynamic' and nonce usage. These warnings are expected and don't affect functionality.
## Configuration

See `config/adminerneo.php` for all configuration options.
