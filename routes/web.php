<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
//初めは記事一覧
Route::get('/', 'App\Http\Controllers\PostController@index');
//記事作成
Route::get('/posts/create', 'App\Http\Controllers\PostController@create');
//記事編集
Route::get('/posts/{post}/edit','App\Http\Controllers\PostController@edit');
//update
Route::put('/posts/{post}', 'App\Http\Controllers\PostController@update');
//記事削除
Route::delete('/posts/{post}','App\Http\Controllers\PostController@destroy');
//詳細記事
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show');

//Post reauestを受け取った時
Route::post('/posts', 'App\Http\Controllers\PostController@store');