<?php

declare(strict_types=1);

/*
 * This file is part of Laravel E-Mail Authentication.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get(config('laravel-email-authenticate.route.uri'), [
    'as'   => config('laravel-email-authenticate.route.as'),
    'uses' => config('laravel-email-authenticate.route.uses'),
]);
