<?php

namespace App\Console\Commands;

// Suspensionモデルと紐づけ。
use App\Suspension;

use Illuminate\Console\Command;

// トランザクションを使用するため。
use Illuminate\Support\Facades\DB;

class forceDeleteSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // バッチ処理の名前。
    protected $signature = 'command:forceDelete';

    /**
     * The console command description.
     *
     * @var string
     */
    // バッチ処理の説明。
    protected $description = 'ソフトデリートされたレコードのうちソフトデリートから7日経過したものを完全に削除する。';

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
    // バッチ処理の内容。
    public function handle()
    {
        // 今回は練習として，ソフトデリート済みのレコード全てを取得できるようにした。本番ではソフトデリートしてから7日経過しているものを取得する予定。
        $suspensions = Suspension::onlyTrashed()->whereDate('deleted_at', '>', now()->subDay(7))->get();
        // 手動トランザクション。開始点。
        DB::beginTransaction();
        try {
            // $suspensionsから各要素（各レコード）を1つずつ取得。
            foreach($suspensions as $suspension) {
                // ソフトデリートの解除。これでdeleted_atの値がnullになる。
                $suspension->restore();
            }
            // 手動トランザクション。終了点。
            DB::commit();
        } catch(Exception $e) {
            // try{}が途中で止まってしまった際に実行される処理は以下に。rollback()で処理する前に戻す。
            DB::rollback();
        }
    }
}
