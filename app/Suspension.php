<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// ソフトデリートを使用する際に必要。
use Illuminate\Database\Eloquent\SoftDeletes;

class Suspension extends Model
{
    // ソフトデリート。
    use SoftDeletes;

    protected $table = 'suspensions';
    protected $fillable = [
        'title', 'start', 'end', 'content',
    ];
}
