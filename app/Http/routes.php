<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/{id}.json', 'HomeController@getJson');
Route::get('{id}.rss', 'HomeController@getRss');
Route::get('/{version}/', 'HomeController@show');
Route::get('/', 'HomeController@index');


