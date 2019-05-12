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
    Route::get('register','UsersController@create')->name('users.register');
    //用户相关
    Route::resource('users','UsersController');
    //用户登录界面
    Route::get('login','LoginController@index')->name('login.index');
    //用户登录操作
    Route::post('login','LoginController@login')->name('login.login');

    //用户登出操作
    Route::post('logout','LoginController@logout')->name('login.logout');

    //发送邮件显示
    Route::get('register/confirm/{token}', 'UsersController@confirmEmail')->name('users.confirm_email');

});

