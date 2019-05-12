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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::prefix('/')->namespace('Home') ->group(function(){
    //首页
    Route::get('','StaticPagesController@home')->name('static.home');
//帮助页
    Route::get('help','StaticPagesController@help')->name('static.help');
//关于页
    Route::get('about','StaticPagesController@about')->name('static.about');

    //注册页面
    Route::get('register','UsersController@index')->name('users.register');
});

