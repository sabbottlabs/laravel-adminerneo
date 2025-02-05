<?php
use SabbottLabs\AdminerNeo\Http\Controllers\AdminerNeoController;

Route::match(['get', 'post'], '/', [AdminerNeoController::class, 'index'])
    ->middleware(config('adminerneo.middleware'))->withoutMiddleware([
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ]);
