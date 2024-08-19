<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaran extends Model
{
    protected $fillable = [
        'semester',
        'kode',
        'mata_kuliah',
        'is_kompetensi',
        'kuliah_responsi',
        'seminar',
        'praktikum',
        'sikap',
        'pengetahuan',
        'keterampilan_umum',
        'keterampilan_khusus',
        'dokumen_rencana',
        'unit_penyelenggara',
        'is_approve',
    ];
}
