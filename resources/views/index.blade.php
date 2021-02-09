<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Blog一覧|MyTechBlog</title>

        <!-- Fonts -->
        <link href="{{ asset('/sass/front.css') }}" rel="stylesheet" type="text/css">
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

            <div class="blog-sass"></div>
        
            <h1>TECH BLOG</h1>
            <!--検索画面の実装-->
            <div id="search_classes">
                <form method="GET" action="{{url('/')}}">
                    {{csrf_field()}}
                    <input type='search' name="search" class="search" placeholder="What's Title?">
                    <!--昇順か降順か-->
                    <select name="sort" class='sort'>
                        <option value=asc>ASC</option>
                        <option value=desc>DESC</option>
                    </select>
                    <input type='submit' value='Search' class='submit'>
                </form> 
            </div>

            <div id="posts">
                <!--変数$postsで受け取ったPostTableの値を 変数$postでforを回し取得-->
                @foreach ($posts as $post)
                    <section class='post'>
                        <!--p class="id">id : {{$post->id}} </p>-->
                        <div class="title">Title : 
                        <a href='posts/{{$post->id}}' >{{ $post->title }}</a></div>
                        <div class="auther" text-muted> {{ $post->user->name }}</div>
                        <p class='body'>[   {{ $post->body }}....... at {{$post->updated_at}} ]</p> 
                    </section>   
                @endforeach
            </div>
            
            <!--paginate-->
            <div class='paginate'>
                {{$posts->links('vendor.pagination.default')}}
            </div>

            <script>
                var container = document.querySelector('#posts');
                new Masonry(container, {
                    itemSelector: '.post',
                    isFitWidth: true,
                    gutter: 4
                })
            </script> 
            <footer>
                <p>© 2021 Yuta Ishikawa.</p>
            <footer>
        </div>
    </body>

</html>
