<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('home.about');
});

Route::get('/contact', function () {
    return view('home.contact');
});

Route::get('/user/profile', function () {
    return view('users.profile');
})->name('user.profile');



Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Categories Routes 
    Route::resource('categories', 'CategoryController');
    Route::get('/categories/getData/{id}', 'CategoryController@getData')->name('categories.getData');

    // Posts Routes 
    Route::get('/posts/index', 'PostController@index')->name('posts.index');
    Route::get('/posts/show/{id}', 'PostController@show')->name('posts.show');
    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::post('/posts/store', 'PostController@store')->name('posts.store');
    Route::delete('/posts/destroy', 'PostController@destroy')->name('posts.destroy');
    Route::put('/posts/update/{id}', 'PostController@update')->name('posts.update');

    // Users Route
    Route::post('/users/{id}/impersonate', 'UsersController@impersonate')->name('users.impersonate');
    Route::post('/users/leaveimpersonate', 'UsersController@leaveimpersonate')->name('users.leaveimpersonate');
    Route::resource('users', 'UsersController');

});

