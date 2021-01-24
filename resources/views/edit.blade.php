<!--記事編集-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Edit Aritcle :|</h1>
        <!--以下フォーム-->
        <form action="/posts/{{$post->id}}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
            
            <!--Title-->
            <div class="title">
                <h2>Title?</h2>
                <!--基本はCreateと同じ-->
                <input type='text' name="post[title]" placeholder="Title" value={{$post->title}} />
                <p class='title_error' style="color:red">{{ $errors->first('post.title')}}</p>
            </div>
            
            <!--Body-->            
            <div class="body">
                <h2>Body?</h2>
                <textarea name="post[body]" placeholder="Have a good day!">{{$post->body}}</textarea>
                <p class='body_error' style="color:red">{{ $errors->first('post.body')}}</p>
            </div>
            
            <input type="submit" value="Update!!">
        </form>
        <!--以上フォーム-->
        <!--back-->
        <div class='back'>Back Home >> [<a href='/posts/{{$post->id}}'>back</a>]</div>
    </body>
</html>