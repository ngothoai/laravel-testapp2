<?php

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

Route::get('/', function () {
    return view('master');
});
// Route::get('/users/{id?}','IndexController@index');
// Route::post('/users','IndexController@store');
// Route::delete('/users/{$id}','IndexController@destroy');
// Route::resource('users','ControllerUser' ,['except' => ['create', 'store', 'update', 'destroy']]);
Route::resource('/users', 'IndexController',['except' => [ 'update']]);
