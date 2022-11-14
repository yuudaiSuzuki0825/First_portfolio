<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToSuspensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suspensions', function (Blueprint $table) {
            // ソフトデリート。deleted_atカラムをこれで追加できる。
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suspensions', function (Blueprint $table) {
            // softDeletes()の逆バージョン。公式のマイグレーションの下部にこのコマンドが紹介されている。
            $table->dropSoftDeletes();
        });
    }
}
