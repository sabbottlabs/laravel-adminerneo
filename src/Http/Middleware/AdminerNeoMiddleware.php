<?php
namespace SabbottLabs\AdminerNeo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function config;

class AdminerNeoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('adminerneo.enabled')) {
            abort(403, 'AdminerNeo is disabled');
        }

        return $next($request);
    }
}