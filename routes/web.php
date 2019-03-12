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
    return view('auth.newlogin');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::post('/industry','AjaxController@index')->middleware('auth');

Route::post('/{id}/updateuser','UserDetailController@update')->middleware('auth');


// POST
Route::post('/post','PostController@store')->middleware('auth');

Route::post('/{id}/updatepost','PostController@update')->middleware('auth');

Route::post('/{id}/deletepost','PostController@destroy')->middleware('auth');

// COMMENT
Route::post('/{id}/comment','CommentController@create')->middleware('auth');

Route::post('/{id}/updatecomment','CommentController@update')->middleware('auth');

Route::post('/{id}/deletecomment','CommentController@destroy')->middleware('auth');

Route::post('/updaterecent','CommentController@updaterecent')->middleware('auth');

// LIKE
Route::post('/liked','LikeController@store')->middleware('auth');

Route::post('/unliked','LikeController@destroy')->middleware('auth');

//NOTIFY
Route::post('/notified','HomeController@update')->middleware('auth');

//MESSAGE
Route::post('/message','MessageController@store')->middleware('auth');


//refresh posts
Route::get('/posts','HomeController@refresh')->middleware('auth');

//refresh messages
Route::get('/{id}/messaging','MessageController@refresh')->middleware('auth');

//refresh activities
Route::get('/recently','CommentController@updaterecent')->middleware('auth');

//job posting
Route::get('/jobpost', 'JobpostController@index')->middleware('auth');

//job post
Route::post('/postjob','JobpostController@store')->middleware('auth');

Route::post('/{id}/deletejob','JobpostController@destroy')->middleware('auth');


