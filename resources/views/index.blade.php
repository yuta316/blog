<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        
    </head>
    <body>
        <h1>List Of Articles</h1>
        <!--記事作成画面へ飛ばすようコントローラへ依頼-->
        <p class='create'>Create New Aritcle >>> [<a href='/posts/create'>create</a>]</p>
        <div class="posts">
            <!--table postsの値を受け取り表示-->
            @foreach ($posts as $post)
                <div class="post">
                  <h2 class="title">Title : 
                  <a href='posts/{{$post->id}}' >{{ $post->title }}</a></h2>
                  <p class='body'>[   {{ $post->body }}....... at {{$post->updated_at}} ]</p>
                </div>
            @endforeach
        </div>
        <!--paginate-->
        <div class="paginate">
            {{ $posts->links() }}
        </div>
    </body>

</html>
