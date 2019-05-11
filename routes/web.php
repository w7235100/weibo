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

Route::get('/','StaticPagesController@home')->name('static.pages.home');
Route::get('/help','StaticPagesController@help')->name('static.help.home');
Route::get('/about','StaticPagesController@about')->name('static.about.home');