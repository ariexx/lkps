<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenPembimbing extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'jumlah_mahasiswa_dibimbing_ts',
        'jumlah_mahasiswa_dibimbing_ts1',
        'jumlah_mahasiswa_dibimbing_ts2',
        'rata_rata_mahasiswa',
        'jumlah_mahasiswa_dibimbing_ts_lain',
        'jumlah_mahasiswa_dibimbing_ts1_lain',
        'jumlah_mahasiswa_dibimbing_ts2_lain',
        'rata_rata_mahasiswa_lain',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAll(): object
    {
        return $this->get();
    }

    public function getRataRataAttribute(): float
    {
        return ($this->jumlah_mahasiswa_dibimbing_ts + $this->jumlah_mahasiswa_dibimbing_ts1 + $this->jumlah_mahasiswa_dibimbing_ts2) / 3;
    }

    public function getRataRataLainAttribute(): float
    {
        return ($this->jumlah_mahasiswa_dibimbing_ts_lain + $this->jumlah_mahasiswa_dibimbing_ts1_lain + $this->jumlah_mahasiswa_dibimbing_ts2_lain) / 3;
    }

    public function getSumRataRataAttribute(): float
    {
        return ($this->rata_rata + $this->rata_rata_lain) / 2;
    }

    public function getTSRataRataAkreditasiAttribute(): array
    {
        return [
            'jumlah_mahasiswa_dibimbing_ts' => $this->jumlah_mahasiswa_dibimbing_ts,
            'jumlah_mahasiswa_dibimbing_ts1' => $this->jumlah_mahasiswa_dibimbing_ts1,
            'jumlah_mahasiswa_dibimbing_ts2' => $this->jumlah_mahasiswa_dibimbing_ts2,
            'rata_rata_mahasiswa' => $this->rata_rata_mahasiswa,
        ];
    }
}
