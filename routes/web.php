<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/',function(){
    return view("index");
});
*/

//初めは記事一覧
Route::get('/', 'App\Http\Controllers\PostController@index');
