<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 
 //table Postの値を受け取れるようにする
 use App\Models\Post;
 
 class PostController extends Controller
 {
     //Post table の値を変数$postで受け取る
     public function index(Post $post)
     {
         //index(,blade.php)のviewを返したい
         //変数postsでviewに全てのデータを渡す
         return view("index")->with(['posts' => $post->getPaginateLimit(1)]);
     }
 }