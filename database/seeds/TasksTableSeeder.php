<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str; // Str::random()のため。

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 「Laravel6 シーディング」で検索。run()内にinsertを使ってデータベースにレコードを挿入する処理を書く。
        for ($i = 0; $i < 500; $i++) {
            DB::table('tasks')->insert([
                'title' => Str::random(10),  // 引数で指定した文字分のランダムな文字列を生成。
                'start' => "2022-11-28",
                'end' => "2022-12-31",
                'content' => Str::random(100),
            ]);
        }
    }
}
