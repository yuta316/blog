<!--記事作成-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
            {{ csrf_field() }}
            <div class="title">
                <h2>Title</h2>
                <input type='text' name="post[title]" placeholder="TITlE"/>
                <p class='title_error' style="color:red">{{ $errors->first('post.title')}}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="Have a good day!"></textarea>
                <p class='body_error' style="color:red">{{ $errors->first('post.body')}}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class='back'>[<a href='/'>back</a>]</div>
    </body>
</html>