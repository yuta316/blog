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
    </head>
    <body>
        <!--記事表示-->
        <div class="post">
              <h1 class="title">{{ $post->title }}</h1>
              <h2 class='body'>{{ $post->body }}</h2>
              <p class='updated_at'>Uploadet at ({{ $post->updated_at }})</p>
            </div>
            
        <!--編集-->
        <p class='edit'>Edit Article >> [<a href='/posts/{{$post->id}}/edit'>edit</a>]</p>
        
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
        
        <script>
            function deletePost(e){
                'use strict';
                if (confirm("削除すると復元できません.\n本当に削除しますか")){
                    document.getElementById('form_delete').submit();
                }
            }
        </script>
    </body>

</html>