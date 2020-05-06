<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/posts/data', 'PostController@data')->name('posts.data');
Route::get('/users/data', 'UserController@data')->name('users.data');
Route::get('/category/data', 'CategoryController@data')->name('category.data');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/featured/{post_id}', 'PostController@featured')->name('featured');
Route::get('/unfeatured/{post_id}', 'PostController@unfeatured')->name('unfeatured');

Route::get('/category', 'CategoryController@index')->name('category');
Route::resource('posts', 'PostController');
Route::resource('category', 'CategoryController');
