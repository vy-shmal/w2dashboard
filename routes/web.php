<?php

//use Analytics;
//use Spatie\Analytics\Period;

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



Route::get('/', 'HomeController@index');

Route::get('/data', 'SyncController@index');


//Route::group(['middleware' => ['web','auth']], function(){
    //Route::get('/home', 'HomeController@index')->name('home');
//});
