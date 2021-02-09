<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //trait
    use SoftDeletes;
    
    //ここで指定したカラムのみcreate()やupdate() 、fill()が可能
    //逆に不可能カラムを指定するのは$guarded
    protected $fillable = [
        'title',
        'body',
        'user_id',
        ];
    
    public function getPaginate(int $limit_clount=10)
    {
        //アップロード順に取得
        //続けてペジネートを行う(get()いらない!)
        return $this->paginate($limit_clount);
    }
    
    public function sort($sort){
        if ($sort == 'asc'){
            return $this->orderBy('id', 'asc');
        }else{
            return $this->orderBy('id', 'desc');
        }
    }

    //userとのリレーション定義
    public function user(){
        //userに対して一対多
        return $this->belongsTo('App\Models\User');
    }
    //commentとのリレーション定義
    public function comments(){
        //コメントに対して多
        return $this->hasMany('App\Models\Comment');
    }

    //categoryとのリレーション定義
    public function categories(){
        //カテゴリに対して多対多
        return $this->belongsToMany('App\Models\Category');
    }
    
    //commentとのリレーション定義
    public function images(){
        //コメントに対して多
        return $this->hasMany('App\Models\Image');
    }
    public function deleteWithRelation(){
        try{
            $post = $this->findOrFail($id);
            $post->comments()->delete();
            $post->categories()->detach();
            $post->delete();
        } catch(\Exeption $e){
            throw new Exception($e->getMessage());
        }
    }

    public function createWithRelation($input){
        try {
            $post = $this->create($input);
            //多多の時に中間テーブルを利用するためにattachを用いる
            $post->categories()->attach($input['categories']);
            
            return $post;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function updateWithRelation(int $id, $input){
        try {
            $post = $this->findOrFail($id);
            $post->fill($input)->save();
            $post->categories()->sync($input['categories']);
            return $post;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}
