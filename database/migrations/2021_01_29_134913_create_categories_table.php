<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #Categoryテーブルの作成
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255)->comment('名前');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE comments COMMENT 'カテゴリー'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
