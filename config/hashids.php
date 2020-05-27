<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ],

        'alternative' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ],

        \App\User::class => [
            'salt' => \App\User::class.'7623e9b0009feff8e024a689d6ef59ce',
            'length' => 9,
        ],

        \App\Product::class => [
            'salt' => \App\Product::class.'7623e9b0009feff8e024a689d6ef59ce',
            'length' => 9,
        ],
        \App\Store::class => [
            'salt' => \App\Store::class.'7623e9b0009feff8e024a689d6ef59ce',
            'length' => 9,
        ],

    ],

];
