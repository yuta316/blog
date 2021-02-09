<?php
 
 namespace App\Http\Controllers;
use Auth;

 //userからの入力を受け取る場合は必ずリクエストを使う
 use Illuminate\Http\Request;
 
 //各tableの値を受け取れるようにする
 use App\Models\Post; 
 use App\Models\Comment;
 use App\Models\Category;
 use App\Models\Image;
 //PostRequest
 use App\Http\Requests\PostRequest;
 use App\Http\Requests\SearchRequest;
 class PostController extends Controller
 {
     //Post Table の中身にアクセスできるようになる($postで受け取る)
     public function index(Post $post, Category $category, Request $request)
     {
        $auths = Auth::user();
        //昇順か降順か取得
        $sort = $request->input('sort');
        if (empty($sort)){
            //していなければ昇順で設定
            $sort = 'asc';
        }
    
        //検索ワードがあれば変数$searchに格納
        $search = $request->input('search');
        $query = Post::query();
     
        //検索あれば絞って表示
        if(!empty($search)) {
            //クエリを立てる
            //$post -> sort($sort)-> where('title', 'LIKE', "%{$search}%")->get();
            //$article = $query->get();
            return view('index')->with([
                'posts'=> $post -> sort($sort)-> where('title', 'LIKE', "%{$search}%") -> paginate(20),
                'request'=>$request,
                'auth'=>$auths
                ]);
        }else{ 
        //なければそのまま表示      
        //index(.blade.php)のviewを返したい
        return view('index')->with([
            //postsという変数名で $postで受け取ったPostTableの中身の値を渡す.
            'posts' => $post -> sort($sort) -> paginate(20),
            'request'=>$request,
            'auth'=>$auths
            ]);
         
        }
     }
     //記事の表示
     //Posts/{post}で指定すれば、postに記事全体でなく{post}指定したidのpostがかえる
     public function show(Post $post)
     {
         $auths=Auth::user();
         return view('show')->with([
          'post' => $post, 
          'comments' => $post,
          'categories'=>$post,
          'images'=>$post,
          'auth'=>$auths
          ]);
     }
     //記事の作成
     public function create(Category $category)
     {
        $auths = Auth::user();
        //categorise　キーで取得してきたデータを渡す 
        return view('create')->with([
            'categories'=>$category->all(),
            'auth'=>$auths
        ] );
     }
     
     //userからのリクエストに含まれるデータを扱うときはRequestインスタンスを使う
     //$requestのキーはHTMLのnameと一致
     public function store(PostRequest $request, Post $post, Image $image)
     {
         //入力を全て変数に
         $input = $request['post'];

         //user_idの追加
         $input['user_id'] = Auth::id();
          //insert　PostModelでfillabeになっていることを注意
         //$post->fill($input)->save();  //create($input)でも可能.
         $post = $post->createWithRelation($input);
         $image_name = $request['image']['image'];

         //$image->images()->create($file_name);
         $file_name = $image_name->store("uploads","public");
         
         if($file_name){
            Image::create([
                "post_id" => $post->id,
                "image_name" => $image_name->getClientOriginalName(),
                "file_name" => $file_name,
                
            ]);
            } 
         
         return redirect('/posts/'.$post->id);
     }
     
     public function edit(Post $post, Category $category)
     {
         return view('edit')->with(['post'=>$post, 'categories'=>$category->all()]);
     }
     public function update(PostRequest $request, Post $post,  Image $image)
     {
         $input_n = $request['post'];
         //insert
         $post->fill($input_n)->save();
         $new_image_name = $request['image']['image'];
         //$image->images()->create($file_name);
         $new_file_name = $new_image_name->store("uploads","public");
         
         $item = Image::where('post_id', $post->id)->first();
         if ($item){
            $item->file_name = $new_file_name;
            $item->save();
         }else{
            Image::create([
                "post_id" => $post->id,
                "image_name" => $new_image_name->getClientOriginalName(),
                "file_name" => $new_file_name,
            ]);
         }
         return redirect('/posts/'.$post->id);
     }
     
     //削除メソッド
     public function destroy(Post $post)
     {
         //論理削除
         $post->deleteWithRelation();
         return redirect('/');
     }
     //認証によるアクセス制限
     public function __construct(){
        $this->middleware('auth');
      }
 }
