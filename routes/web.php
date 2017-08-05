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

Auth::routes();


Route::group(['prefix' => '/','middleware' => 'auth'], function () {
  
  Route::get('/', 'SlackController@index');
  
  Route::group(['prefix' => 'slack'], function(){
    Route::get('connect', 'SlackAPIController@getConnect');
    Route::get('disconnect/{id}', 'SlackController@disconnect');
  });
  
});

Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
});
