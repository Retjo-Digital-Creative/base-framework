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

Route::get('/', function () {
    return \App\Helpers\Helpers::response([
        'code' => 200,
        'success' => true,
        'message' => 'Hello World'
    ], 200);
});

Route::name('api.auth.')
    ->prefix('auth')
    ->group(function () {
        Route::post('/login', 'Api\Auth\AuthController@login')->name('login');
        Route::post('/register', 'Api\Auth\AuthController@register')->name('register');
    });

Route::name('api.backend.')
    ->prefix('backend')
    ->middleware('api-auth')
    ->group(function () {
        Route::get('/user', 'Api\MainController@user')->name('user');
        Route::post('/logout', 'Api\Auth\AuthController@logout')->name('logout');
    });
