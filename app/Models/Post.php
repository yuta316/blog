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
        ];
    
    public function getPaginateLimit(int $limit_clount=10)
    {
        //アップロード順に取得
        //続けてペジネートを行う(get()いらない!)
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_clount);
    }
    
    //commentとのリレーション定義
    public function comments(){
        //コメントに対して多
        return $this->hasMany('App\Models\Comment');
    }
    
    public function deleteWithRelation(){
        try{
            $this->comments()->delete();
            $this->delete();
        } catch(\Exeption $e){
            throw new Exception($e->getMessage());
        }
    }
}
