<?php
namespace SabbottLabs\AdminerNeo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function config;

class AdminerNeoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('adminerneo.enabled')) {
            abort(403, 'AdminerNeo is disabled');
        }

        $nonce = Str::random(32);
        $request->attributes->set('csp-nonce', $nonce);

        $response = $next($request);

        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'nonce-{$nonce}' 'strict-dynamic' 'unsafe-eval'; " .
            "style-src 'self' 'unsafe-inline'; " .
            "img-src 'self' data: blob:; " .
            "connect-src 'self'"
        );

        return $response;
    }
}