<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('postportal')->group(function() {
    Route::get('/', 'PostController@index');

    Route::get('/posts/index', 'PostsController@index')->name('posts.index');
    Route::get('/posts/show/{id}', 'PostsController@show')->name('posts.show');
    Route::get('/posts/create', 'PostsController@create')->name('posts.create');
    Route::post('/posts/store', 'PostsController@store')->name('posts.store');
    Route::delete('/posts/destroy', 'PostsController@destroy')->name('posts.destroy');
    Route::put('/posts/update/{id}', 'PostsController@update')->name('posts.update');
});
