<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaAsing extends Model
{
    protected $fillable = [
        'program_studi',
        'mahasiswa_aktif_ts2',
        'mahasiswa_aktif_ts1',
        'mahasiswa_aktif_ts',
        'mahasiswa_asing_full_time_ts2',
        'mahasiswa_asing_full_time_ts1',
        'mahasiswa_asing_full_time_ts',
        'mahasiswa_asing_part_time_ts2',
        'mahasiswa_asing_part_time_ts1',
        'mahasiswa_asing_part_time_ts',
        'is_approve',
    ];
}
