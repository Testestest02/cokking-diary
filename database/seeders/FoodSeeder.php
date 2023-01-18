<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;
use Illuminate\Support\Facades\Hash;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food::create([
            'name' => '鳥モモ肉',
        ]);
        Food::create([
            'name' => '鳥ムネ肉',
        ]);
        Food::create([
            'name' => '豚肉',
        ]);
        Food::create([
            'name' => '牛肉',
        ]);
        Food::create([
            'name' => 'ミンチ',
        ]);
        Food::create([
            'name' => 'レバー',
        ]);
        Food::create([
            'name' => '魚介類',
        ]);
        Food::create([
            'name' => 'ブロッコリー',
        ]);
        Food::create([
            'name' => 'ピーマン',
        ]);
        Food::create([
            'name' => '小松菜',
        ]);
        Food::create([
            'name' => 'レタス',
        ]);
        Food::create([
            'name' => 'キャベツ',
        ]);
        Food::create([
            'name' => '白菜',
        ]);
        Food::create([
            'name' => 'ほうれん草',
        ]);
        Food::create([
            'name' => 'ニラ',
        ]);
        Food::create([
            'name' => '大根',
        ]);
        Food::create([
            'name' => 'かぼちゃ',
        ]);
        Food::create([
            'name' => 'きのこ類',
        ]);
        Food::create([
            'name' => 'じゃがいも',
        ]);
        Food::create([
            'name' => '人参',
        ]);
        Food::create([
            'name' => 'ナス',
        ]);
        Food::create([
            'name' => 'レンコン',
        ]);
        Food::create([
            'name' => 'ゴボウ',
        ]);
        Food::create([
            'name' => 'チーズ',
        ]);
    }
}
