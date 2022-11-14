<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// 記述が必要な箇所は$signature（このバッチ処理の名前）と$description（その説明），handle()の中身（ここにバッチ処理の具体的な内容を記述）の3つ。
class testCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // バッチ処理の名前。ここで付けた名前を「php artisan」の後ろに付けてターミナルに入力し実行すると，このバッチ処理が実行される。
    // 「php artisan list」を入力・実行して以下が存在していることを確認すること。
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'バッチ処理の練習。「php artisan command:test」をターミナルに入力し実行する。ターミナルにHello world!と表示される。';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // バッチ処理の中身。
        // 「php artisan command:test」をターミナルに入力し実行すると以下が実行される。
        echo 'Hello world!'."\n";
    }
}
