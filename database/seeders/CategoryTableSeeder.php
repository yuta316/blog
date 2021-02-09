<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoryTableSeeder extends Seeder
{
    
    #初期に共通データを挿入するため便利
    public function run()
    {
        DB::table('categories')->insert([
        [
            'name'=>'hobby',
            'updated_at' => now(),
            'created_at' => now(),
        ],
        [
            'name'=>'study',
            'updated_at' => now(),
            'created_at' => now(),
        ],
        [
            'name'=>'work',
            'updated_at' => now(),
            'created_at' => now(),
        ],
        [
            'name'=>'news',
            'updated_at' => now(),
            'created_at' => now(),
        ],] 
    );
    }
}
