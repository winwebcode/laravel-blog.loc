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



Route::get('/', 'HomeController@index')->name('blog'); //имя контроллера@имя метода
Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::post('/subscribe', 'AdmSubscribeController@subscribe')->name('subscribe.form');
Route::get('/verify/{token}', 'AdmSubscribeController@verify')->name('subscribe.verify');

/*для авторизованных*/
Route::group(['middleware' => 'auth'], function (){
    Route::get('/logout', 'MyAuthController@logout');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/comment', 'CommentsController@store');
});

/*для гостей*/
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'MyAuthController@registerForm'); //форма регистрации
    Route::post('/register', 'MyAuthController@register'); //сюда прилетают данные формы регистрации
    Route::get('/login', 'MyAuthController@loginForm')->name('login');
    Route::post('/login', 'MyAuthController@login');
});


/* для админов*/
Route::group(['prefix' => 'admin', 'namespace'=> 'Admin', 'middleware' => 'admin'], function (){
    Route::get('/', 'DashboardController@index')->name('admin');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::get('/users/ban/{id}', 'UsersController@ban')->name('users.ban');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index')->name('comment.show');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle')->name('comment.status');
    Route::get('/comments/destroy/{id}', 'CommentsController@destroy')->name('comment.destroy');
    Route::get('/comments/edit/{id}', 'CommentsController@edit')->name('comment.edit');
    Route::post('/comments', 'CommentsController@update')->name('comment.update');
    Route::resource('/subscribers', 'AdmSubscribeController');
    Route::get('/subscribers-clear', 'AdmSubscribeController@clear')->name('subscribers.clear');
});

//разные варианты записи роутов
/*Route::get('/admin', 'Admin\DashboardController@index'); //имя контроллера@имя метода
Route::resource('/admin/categories', 'Admin\CategoriesController'); // для CRUD*/
