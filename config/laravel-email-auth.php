<?php

/*
 * This file is part of Laravel E-Mail Authentication.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Route
    |--------------------------------------------------------------------------
    */

    'route' => [
        'uri'  => 'auth/email-authenticate/{token}',
        'as'   => 'auth.email-authenticate',
        'uses' => 'BrianFaust\EmailAuth\Http\Controllers@authenticateEmail',
    ],

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    */

    'database' => [
        'tables' => [
            'user' => 'users',
        ],

        'models' => [
            'user'        => \App\User::class,
            'email-login' => \BrianFaust\EmailAuth\EmailLogin::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    'views' => [
        'login' => 'auth.emails.email-login',
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail
    |--------------------------------------------------------------------------
    */

    'mail' => [
        'address' => null,
        'name'    => null,
        'subject' => 'Mail Authentication',
    ],

    /*
    |--------------------------------------------------------------------------
    | Lifetime
    |--------------------------------------------------------------------------
    */

    'lifetime' => '-15 minutes',

];
