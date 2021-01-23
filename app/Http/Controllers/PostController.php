<?php
 
 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 
 //table Postの値を受け取れるようにする
 use App\Models\Post;
 //PostRequest
 use App\Http\Requests\PostRequest;
 
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
     public function show(Post $post)
     {
         return view('show')->with(['post' => $post]);
     }
     //記事の作成
     public function create()
     {
         return view('create');
     }
     
     //userからのリクエストに含まれるデータを扱うときはRequestインスタンスを使う
     //$requestのキーはHTMLのnameと一致
     public function store(PostRequest $request, Post $post)
     {
         //入力を全て変数に
         $input = $request['post'];
         //insert　PostModelでfillabeになっていることを注意
         $post->fill($input)->save();  //create($input)でも可能.
         return redirect('/posts/'.$post->id);
     }
     
     public function edit(Post $post)
     {
         return view('edit')->with(['post'=>$post]);
     }
     public function update(PostRequest $request, Post $post)
     {
         $input_n = $request['post'];
         //insert
         $post->fill($input_n)->save();
         return redirect('/posts/'.$post->id);
     }
     
     //削除メソッド
     public function destroy(Post $post)
     {
         //論理削除
         $post->delete();
         return redirect('/');
     }
 }
