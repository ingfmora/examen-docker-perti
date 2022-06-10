<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\AuthController@login');

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::get('logout', 'Api\AuthController@logout');
    Route::get('refresh', 'Api\AuthController@refresh');
    Route::get('me', 'Api\AuthController@me');

    Route::get('get/{user?}', 'Api\ApiController@get');
    Route::put('register', 'Api\ApiController@store');
    Route::post('update/{user}', 'Api\ApiController@update');
});
