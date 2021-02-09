<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        //postsテーブル
        //コメントはカラムに付属する説明
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('UserID');
            $table->string('title',255)->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['updated_at']);
        });
        DB::statement("ALTER TABLE posts COMMENT '記事'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
