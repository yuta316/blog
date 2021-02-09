<!--記事作成-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>

        <!-- Fonts -->
        <link href="{{ asset('/sass/create.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Red+Rose&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        
    </head>
    <body id="photograph2">
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
            <!--記事作成画面-->
            <h1>TECH BLOG</h1>

            <div id="create_form_id">
                <!--以下入力フォーム-->
                <section class='create_form'>
                <!--submit->"/posts/"にアクセスするためContorollerに渡す.-->
                <form action="/posts" method="POST" enctype="multipart/form-data">
                    <!--laravelのフォームはcsrfが必須-->
                    {{ csrf_field() }}
                    <div class="create_article">Create Article : )</div>
                    <div class="title">
                        <p>Title</p>
                        <!--nameは$requestにデータを入れるときの引数-->
                        <input type='text' name="post[title]" placeholder="Title"/>
                        <p class='title_error' style="color:red">{{ $errors->first('post.title')}}</p>
                    </div>

                    <div class="body">
                        <p>Body</p>
                        <textarea name="post[body]" placeholder="Have a good day!"></textarea>
                        <p class='body_error' style="color:red">{{ $errors->first('post.body')}}</p>
                    </div>

                    <!--画像フォーム-->
                    <div class='image'>
                        <p>Image Photo</p>
                        <input type="file" name="image[image]" class='img_form'
                            placeholder="Choose Photo" accept="post[image]/png,post[image]/jpeg">
                    </div>
                    
                    <!--カテゴリフォーム-->
                    <div class='category'>
                        <p>Category</p>
                        <!--mulipul で複数選択可能にする-->
                        <select name="post[categories][]" multiple class='category_select'>
                        <option value="">select</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option> 
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="store" class='submit'/>
                </section>
                </form>
            </div>
            <!--戻るボタン-->
            <div class='back'>Back Home >>> [<a href='/'>back</a>]</div>
            <!--以上入力フォーム-->
            <footer>
                <p>© 2021 Yuta Ishikawa.</p>
            </footer>

            <script>
                var container = document.querySelector('#posts');
                new Masonry(container, {
                    itemSelector: '.post',
                    isFitWidth: true,
                    gutter: 4
                })
            </script> 
    </body>
</html>