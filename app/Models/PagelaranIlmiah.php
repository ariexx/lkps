<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagelaranIlmiah extends Model
{
    protected $fillable = [
        'jenis_publikasi',
        'ts',
        'ts1',
        'ts2',
        'is_approve',
    ];
}
