<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //image upload　テーブル
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_id')->comment('記事ID');
            $table->string('image_name')->comment('画像名');
            $table->string('file_name')->comment('保存先');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['post_id']);
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
