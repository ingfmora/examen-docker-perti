<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('auth.register'); });
Route::post('/store', 'UserController@store');

Auth::routes();

Route::group([
   'middleware' => 'auth',
], function () {

    Route::get('/home', 'HomeController@index');
    Route::post('/update/{user}', 'HomeController@store');
    Route::get('/logout', 'Auth\LoginController@logout');
});
