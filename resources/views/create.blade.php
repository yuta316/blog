<!--記事作成-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <!--記事作成画面-->
        <h1>Blog Name</h1>
        <h2>Create Article :)</h2>
        <!--以下入力フォーム-->
        <!--submit->"/posts/"にアクセスするためContorollerに渡す.-->
        <form action="/posts" method="POST">
            <!--laravelのフォームはcsrfが必須-->
            {{ csrf_field() }}
            <div class="title">
                <h2>Title</h2>
                <!--nameは$requestにデータを入れるときの引数-->
                <input type='text' name="post[title]" placeholder="Title"/>
                <p class='title_error' style="color:red">{{ $errors->first('post.title')}}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="Have a good day!"></textarea>
                <p class='body_error' style="color:red">{{ $errors->first('post.body')}}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <!--以上入力フォーム-->
        <!--戻るボタン-->
        <div class='back'>[<a href='/'>back</a>]</div>
    </body>
</html>