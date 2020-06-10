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

Auth::routes();

// Home and faq
Route::get('/', 'HomeController@index')->name('home');
Route::get('/faq', 'HomeController@faq')->name('faq');
    
// Route::post('/register/check', 'RegisterController@check')->name('check');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/perfil', 'HomeController@perfil')->name('perfil');
    Route::put('/perfil', 'HomeController@store')->name('perfil.store');
    Route::delete('/perfil', 'HomeController@delete')->name('perfil.borrar');
    Route::post('/perfil/addfoto', 'HomeController@foto')->name('perfil.foto');
});


// CRUD admin
Route::middleware('esAdmin')->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/admin/find/{idPartido}', 'AdminController@find')->name('admin.find');
    Route::post('/admin/add', 'AdminController@add')->name('admin.add');
    Route::put('/admin/update/{idPartido}', 'AdminController@update')->name('admin.update');
    Route::delete('/admin/delete/{idPartido}', 'AdminController@delete')->name('admin.delete');
});

// show match
Route::get('/partido/{idPartido}', 'PartidoController@showMatch')->name('partido.mostrar')->middleware('auth');

// sign in and leave match
Route::get('/addJugador', 'PartidoController@signInMatch')->name('partido.add')->middleware('auth');
Route::get('/leave', 'PartidoController@leave')->name('partido.leave')->middleware('auth');

