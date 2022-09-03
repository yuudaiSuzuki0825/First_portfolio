<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuspensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); // title（テーマ）を追加。
            $table->string('start'); // start（開始日）を追加。
            $table->string('end'); // end（完了日）を追加。
            $table->text('content'); // content（概要）を追加。
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suspensions');
    }
}
