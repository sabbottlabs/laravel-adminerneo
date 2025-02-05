<?php
use SabbottLabs\AdminerNeo\Http\Controllers\AdminerNeoController;

Route::get(config('adminerneo.route_prefix'), [AdminerNeoController::class, 'index'])
    ->middleware(config('adminerneo.middleware'));

    