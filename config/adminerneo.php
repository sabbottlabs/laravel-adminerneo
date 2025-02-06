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
     * Plugin Configuration
     * 
     * Plugins avaliable are at resources/adminerneo/plugins
     * Note: Do not include .php extension in plugin names
     * 
     * Example:
     *  'plugins' => [
     *      'enum-option => true',
     *      'dump-zip => true',
     *      'dump-json => true',
     *      'file-upload' => [
     *          'upload_path' => storage_path('adminerneo/uploads/'),
     *          'display_path' => '/storage/adminerneo/uploads/',
     *          'extensions' => 'jpg|png|pdf|doc|docx'
     *  ],
     * 
     */
    'plugins' => [],

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