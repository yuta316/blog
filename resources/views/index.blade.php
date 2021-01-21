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
        <h1>Blog Name</h1>
        <p class='create'>[<a href='/posts/create'>create</a>]</p>
        <div class="posts">
            <!--table postsの値を受け取る-->
            @foreach ($posts as $post)
                <div class="post">
                  <a href='posts/{{$post->id}}' ><h2 class="title">{{ $post->title }}</h2></a>
                  <p class='body'>{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
        <!--paginate-->
        <div class="paginate">
            {{ $posts->links() }}
        </div>
    </body>

</html>
