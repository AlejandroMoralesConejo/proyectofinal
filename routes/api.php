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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\UserController@login');


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/userDetails', 'Api\UserController@userDetails');
    Route::post('/logout', 'Api\UserController@logout');
    Route::get('/partidos', 'Api\UserController@partidos');
    Route::get('/findPartido', 'Api\UserController@findPartido');
    Route::get('/pistas', 'Api\UserController@pistas');
    Route::get('/findPista', 'Api\UserController@findPista');

});


