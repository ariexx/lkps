<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenelitianDtps extends Model
{
    protected $fillable = [
        'sumber_pembiayaan',
        'ts',
        'ts1',
        'ts2',
        'is_approve'
    ];

    //sum data ts, ts1, ts2
    public static function sumTS()
    {
        return PenelitianDtps::sum('ts');
    }

    public static function sumTS1()
    {
        return PenelitianDtps::sum('ts1');
    }

    public static function sumTS2()
    {
        return PenelitianDtps::sum('ts2');
    }

}
