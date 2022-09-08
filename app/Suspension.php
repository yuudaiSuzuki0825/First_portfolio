<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    protected $table = 'suspensions';
    protected $fillable = [
        'title', 'start', 'end', 'content',
    ];
}
