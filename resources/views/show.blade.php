<!--記事詳細表示-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" 
          rel="stylesheet">
        <!-- Fonts -->
        <link href="{{ asset('/sass/show.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Red+Rose&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        
    </head>
    <body id="photograph">
    <div class="wrapper">
            <!--ヘッダーー-->
            <header>
                <div class='logo'>
                    <a href='/'>
                        <img src="../images/logo2.png">
                    </a>
                </div>
                <nav>
                    <ul id='navigation'>
                        <li><p class=a>Hello {{$auth->name}}</li>
                        <li> <p class='home'><a href='/'>Home</a></p></li>
                        <li> 
                            <!--記事作成画面へのリンク -->
                            <p class='create'><a href='/posts/create'>Create</a></p></li>
                        <li> 
                            <!--ログアウト -->
                            <p class='create'><a href='/login'>Logout</a></p></li>
                    </ul>

                </nav>      
            </header>
        <!--記事表示-->
        <div class="post">
                <!--$postsは記事全体なので$postで受け取る-->
                
                <p class="title">{{ $post->title }}
                    <!--カテゴリ-->
                    @foreach ($post->categories as $category)
                          #{{$category->name}}
                    @endforeach
                </p>

                <div class='article_img'>
                    <!--画像表示-->
                    @foreach ($post->images as $image)
                    <img src="{{ Storage::url($image->file_name) }}"　/>
                    @endforeach
                </div>
                <p class='body'>{{ $post->body }}</p>
                <p class="auther"> by : {{ $post->user->name }} [ Uploadet at ({{ $post->updated_at }}) ]</p>
        
        
        </div>
        
        <!--コメント表示-->
        <div class="comment">
            <p>Comment</p>
            @if (!$post->comments->isEmpty())
              <!--table postsの値を受け取り表示-->
              @foreach ($post->comments as $comment)
                <h2 class="comment_name">{{ $comment->name }} : </h2>
                <h1 class='comment_body '>{{ $comment->body }}</h1>
                <p class='updated_at'>Commented at ({{ $comments->updated_at }})</p>
              @endforeach
            @endif
        </div>
        <div class="Comment_form">
            <!--コメント入力-->
            <p>Comment To Article :)</p>

            <!--以下入力フォーム-->
            <!--submit->"/comment"にアクセスするためContorollerに渡す.-->
            <form action="/posts/{{ $post->id }}/comment" method="POST">
                <!--laravelのフォームはcsrfが必須-->
                {{ csrf_field() }}
                <div class="comment_name">
                    <h5>Name</h5>
                    <!--nameは$requestにデータを入れるときの引数-->
                    <input type='text' name="comment[name]" placeholder="name" >
                    <p class='name_error' style="color:red">{{ $errors->first('comment.name')}}</p>
                    </div>
                <div class="comment_comment">
                    <h5>comment</h5>
                    <textarea name="comment[body]" placeholder="Have a good day!"></textarea>
                    <p class='body_error' style="color:red">{{ $errors->first('comment.body')}}</p>
                </div>
            
                <input type="submit" value="Comment">
            </form>
                <!--以上入力フォーム-->
        </div>

        <!--編集-->
        <p class='edit'>
            Edit Article >> 
            [<a href='/posts/{{$post->id}}/edit'>edit</a>]
        </p>
        
        <!--削除-->
        <form action="/posts/{{$post->id}}" id="form_delete" method="post">
            <!--larabelのフォームはcsrf必須-->
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type="submit" style="display:none">
            <p class='delete'>Delete Aritcle >> [<span onclick="return deletePost(this);">delete</span>]</p>
        </form>
        
        <!--戻る-->
        <div class='back'>Back Home >> [<a href='/'>back</a>]</div>
        <footer>
                <p>© 2021 Yuta Ishikawa.</p>
        </footer>
        <script>
            function deletePost(e){
                'use strict';
                if (confirm("削除すると復元できません.\n本当に削除しますか")){
                    document.getElementById('form_delete').submit();
                }
            }

            var container = document.querySelector('#posts');
                new Masonry(container, {
                    itemSelector: '.post',
                    isFitWidth: true,
                    gutter: 4
                })
        </script>
        </div>
    </body>

</html>