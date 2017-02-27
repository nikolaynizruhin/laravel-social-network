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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::post('/profile', 'ProfileController@updateAvatar');

Route::post('/posts', 'PostController@store');

Route::delete('/posts/{post}', 'PostController@destroy');

Route::post('/follows/{user}', 'FollowController@follow');

Route::delete('/follows/{user}', 'FollowController@unfollow');

Route::get('/followers', 'FollowController@followers');

Route::get('/followees', 'FollowController@followees');

Route::get('/{user}', 'ProfileController@show');
