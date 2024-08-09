<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeleksiMahasiswa extends Model
{
    protected $fillable = [
        'tahun_akademik',
        'daya_tampung',
        'pendaftar',
        'lulus_seleksi',
        'reguler_baru',
        'transfer_baru',
        'reguler_aktif',
        'transfer_aktif',
    ];

    public function getTotalPendaftarAttribute()
    {
        //sum all of the pendaftar
        return $this->sum('pendaftar');
    }

    public function getTotalLulusSeleksiAttribute()
    {
        //sum all of the lulus seleksi
        return $this->sum('lulus_seleksi');
    }

    public function getTotalRegulerBaruAttribute()
    {
        //sum all of the reguler baru
        return $this->sum('reguler_baru');
    }

    public function getTotalTransferBaruAttribute()
    {
        //sum all of the transfer baru
        return $this->sum('transfer_baru');
    }

    public function getTotalRegulerAktifAttribute()
    {
        //sum all of the reguler aktif
        return $this->sum('reguler_aktif');
    }

    public function getTotalTransferAktifAttribute()
    {
        //sum all of the transfer aktif
        return $this->sum('transfer_aktif');
    }
}
