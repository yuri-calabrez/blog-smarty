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
    return view('layouts.blog');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function(){
       Route::get('', 'DashboardController@index');
       Route::resource('categories', 'CategoriesController');
       Route::resource('posts', 'PostsController');
       Route::resource('tags', 'TagsController', ['except' => 'show']);
       Route::resource('users', 'UsersController', ['except' => 'show']);
       Route::resource('roles', 'RolesController', ['except' => 'show']);
});
