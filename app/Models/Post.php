<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
