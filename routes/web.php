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


Route::get('/testpage', 'TestController@testfunc'); //имя контроллера@имя метода

Route::get('/admin', 'Admin\DashboardController@index'); //имя контроллера@имя метода
Route::resource('/admin/categories', 'Admin\CategoriesController');
