<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use App\Models\Post;
 
 class PostController extends Controller
 {
     /**
      * post一覧を表示する
      * 
      * @param Object Post
      * @return array posts
      */
     public function index(Post $post)
     {
         return $post->get();
     }
 }