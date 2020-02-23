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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('order/{order}', 'ArticleesController@order')->name('order');

Route::resource('articlees','ArticleesController');
Route::get('articlees/{article}/sorted/{order}', 'ArticleesController@sorted')->name('articlees-sorted');
