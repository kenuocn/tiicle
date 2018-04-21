<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/



$api = app('Dingo\Api\Routing\Router');

foreach (glob(app()->basePath('routes/api/*.php')) as $filename) {
    include $filename;
}

foreach (glob(app()->basePath('routes/api/Knowledge/*.php')) as $filename) {
    include $filename;
}
