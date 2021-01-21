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
         return view("index")->with(['posts' => $post->getPaginateLimit()]);
     }
     //記事の表示
     public function show(Post $post){
      return view('show')->with(['post' => $post]);
     }
     //記事の作成
     public function create(){
     return view('create');
     }
     //userからのリクエストをPostに
     public function store(Request $request, Post $post){
      //入力を変数に
      $input = $request['post'];
      //insert
      $post->fill($input)->save();;
      return redirect('/posts/'.$post->id);
     }
 }