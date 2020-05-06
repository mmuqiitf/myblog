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


Auth::routes(['verify' => true]);
Route::get('/', 'Frontend\PostController@index');
Route::get('/post/{post:slug}', 'Frontend\PostController@show')->name('post.slug');
Route::get('/like/{type}/{model_id}', 'Frontend\PostController@like');
Route::get('/unlike/{type}/{model_id}', 'Frontend\PostController@unlike');
Route::get('/category/{category:slug}', 'Frontend\CategoryController@show')->name('category');
Route::get('/profile/{user}', 'Frontend\UserController@index')->name('profile.user');
Route::put('/profile/{user}', 'Frontend\UserController@update')->name('profile.update');


Route::get('/about', function () {
    $categories = App\Category::orderBy('title', 'ASC')->get();
    return view('frontend.about', compact('categories'));
});

Route::post('/comments/{post}', 'Frontend\PostController@addComment');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
