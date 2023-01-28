<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str; // Str::random()のため。

class HistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 「Laravel6 シーディング」で検索。
        for ($i = 0; $i < 900; $i++) {
            DB::table('histories')->insert([
                'title' => Str::random(20), // 引数で指定した文字分のランダムな文字列を生成。
                'start' => "2022-11-28",
                'end' => "2022-12-31",
                'content' => Str::random(255),
            ]);
        }
    }
}
