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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::group(['middleware' => 'auth:api'], function ($router) {
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');
});

Route::namespace("Api")->group(function () {
    Route::get('/test', 'TestController@test');

    // ProductController ten controller, get ten method
    Route::get('/products', 'ProductController@getAll');
    Route::post('/products', 'ProductController@create');
    Route::put('/products/{id}', 'ProductController@update');

    Route::group(['middleware' => 'auth:api'], function ($router) {
        Route::post('/createTest', 'TestController@createTest');
    });
});



