<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //trait
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        ];
    
    public function getPaginateLimit(int $limit_clount=10){
        //アップロード順に取得
        //続けてペジネートを行う(get()いらない!)
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_clount);
    }
}
