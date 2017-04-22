<?php



Route::get(config('email-authenticate.route.uri'), [
    'as'   => config('email-authenticate.route.as'),
    'uses' => config('email-authenticate.route.uses'),
]);
