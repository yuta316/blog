<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    //ここで指定したカラムのみcreate()やupdate() 、fill()が可能
    //逆に不可能カラムを指定するのは$guarded
    protected $fillable = [
        'post_id',
        'name',
        'body',
        ];
        
    //Relation 定義
    public function post()
    {
        //コメントは一つのインスタンスに依存
        return $this->belongsTo('App\Models\Post');
    }
}
