<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// ソフトデリートを使用する際に必要。
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    // ソフトデリートのため。
    use SoftDeletes;
    // 以下の記述の必要性が分からない…。公式には無かった。
    protected $dates = ['deleted_at'];

    // createメソッドのため。
    protected $fillable = [
        'title', 'start', 'end', 'content',
    ];
}
