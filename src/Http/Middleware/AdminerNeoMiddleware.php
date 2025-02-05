<?php
namespace SabbottLabs\AdminerNeo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminerNeoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('adminerneo.enabled')) {
            abort(403, 'AdminerNeo is disabled');
        }

        $response = $next($request);

        // Add CSP headers for AdminerNeo
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " .
            "style-src 'self' 'unsafe-inline'; " .
            "img-src 'self' data: blob:; " .
            "connect-src 'self'"
        );

        return $response;
    }
}