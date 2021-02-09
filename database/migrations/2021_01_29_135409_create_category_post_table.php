<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #中間テーブル, 外部キーはindexを付与する
        Schema::create('category_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('post_id')->comment('記事ID');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['category_id']);
            $table->index(['post_id']);
        });
        DB::statement("ALTER TABLE comments COMMENT '記事カテゴリの中間テーブル'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_post');
    }
}
