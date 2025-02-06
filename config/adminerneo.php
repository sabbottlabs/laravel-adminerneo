<?php

return [

    /**
     * AdminerNeo Configuration
     */

    'enabled' => env('ADMINERNEO_ENABLED', true),

    /**
     * Route Configuration
     * 
     * You may customize route prefix. (default: 'adminerneo')
     */
    'route_prefix' => env('ADMINERNEO_ROUTE_PREFIX', 'adminerneo'),

    /**
     * Middleware Configuration
     * 
     * Default middleware stack for AdminerNeo routes as a starter
     */
    'middleware' => ['web', 'auth','adminerneo'],

    /**
     * Interface Configuration
     * 
     * Interface options avaliable at resources/adminerneo/README.md
     * 
     * Example:
     *  'interface' => [
     *     'colorVariant' => 'green',
     *    ],
     */
    'interface' => [],

];