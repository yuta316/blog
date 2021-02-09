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
        <form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
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

            <!--img-->
            <div class='image'>
                <h2>Image Photo</h2>
                <input type="file" name="image[image]" accept="post[image]/png,post[image]/jpeg">
            </div>

             <!--Category-->
             <div class='category'>
                <h2>Category</h2>
                <!--mulipul で複数選択可能にする-->
                <select name="post[categories][]" multiple>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            <!--紐づいているものはSelectedに変更-->
                            @if (in_array($category->id, $post->categories->pluck('id')->all()))
                                (selected)
                            @endif
                            {{$category->name}}</option> 
                    @endforeach
                </select>
            </div>
            
            <input type="submit" value="Update!!">
        </form>
        <!--以上フォーム-->
        <!--back-->
        <div class='back'>Back Home >> [<a href='/posts/{{$post->id}}'>back</a>]</div>
    </body>
</html>