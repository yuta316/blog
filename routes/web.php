<?php

use Illuminate\Support\Facades\Route;

//初めは記事一覧
Route::get('/', 'App\Http\Controllers\PostController@index');
//記事作成
Route::get('/posts/create', 'App\Http\Controllers\PostController@create');
// 詳細記事
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show');

//Post reauestを受け取った時
Route::post('/posts', 'App\Http\Controllers\PostController@store');