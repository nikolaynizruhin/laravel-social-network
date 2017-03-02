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

Route::get('/{user}/followers', 'FollowController@followers');

Route::get('/{user}/followees', 'FollowController@followees');

Route::get('/posts/{post}/like', 'LikeController@likePost');

Route::get('/tags/{tag}', 'TagController@show');

Route::get('/inbox', 'MessageController@inbox');

Route::get('/outbox', 'MessageController@outbox');

Route::post('/messages', 'MessageController@store');

Route::get('/{user}', 'ProfileController@show');
