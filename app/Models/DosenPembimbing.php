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

    public function rataRataTS(): array
    {
        $data = $this->where('user_id', user()->id)->get();

        $rataRataTS = 0;
        $rataRataTS1 = 0;
        $rataRataTS2 = 0;
        $rataRata = 0;

        $totalData = count($data);

        foreach ($data as $d) {
            $rataRataTS += $d->jumlah_mahasiswa_dibimbing_ts;
            $rataRataTS1 += $d->jumlah_mahasiswa_dibimbing_ts1;
            $rataRataTS2 += $d->jumlah_mahasiswa_dibimbing_ts2;
            $rataRata += $d->rata_rata_mahasiswa;
        }

        return [
            'rata_rata_ts' => number_format($rataRataTS / $totalData, 2),
            'rata_rata_ts1' => number_format($rataRataTS1 / $totalData, 2),
            'rata_rata_ts2' => number_format($rataRataTS2 / $totalData, 2),
            'rata_rata' => number_format($rataRata / $totalData, 2),
            'total_ts2' => $rataRataTS2,
            'total_ts1' => $rataRataTS1,
            'total_ts' => $rataRataTS,
            'total_rata_rata' => $rataRata,
        ];
    }

    public function rataRataTSLain(): array
    {
        $data = $this->where('user_id', user()->id)->get();

        $rataRataTS = 0;
        $rataRataTS1 = 0;
        $rataRataTS2 = 0;
        $rataRata = 0;

        $totalData = count($data);

        foreach ($data as $d) {
            $rataRataTS += $d->jumlah_mahasiswa_dibimbing_ts_lain;
            $rataRataTS1 += $d->jumlah_mahasiswa_dibimbing_ts1_lain;
            $rataRataTS2 += $d->jumlah_mahasiswa_dibimbing_ts2_lain;
            $rataRata += $d->rata_rata_mahasiswa_lain;
        }

        return [
            'rata_rata_ts' => number_format($rataRataTS / $totalData, 2),
            'rata_rata_ts1' => number_format($rataRataTS1 / $totalData, 2),
            'rata_rata_ts2' => number_format($rataRataTS2 / $totalData, 2),
            'rata_rata' => number_format($rataRata / $totalData, 2),
            'total_ts2' => $rataRataTS2,
            'total_ts1' => $rataRataTS1,
            'total_ts' => $rataRataTS,
            'total_rata_rata' => $rataRata,
        ];
    }

    public function rataRataSemua(): array
    {
        $data = $this->where('user_id', user()->id)->get();

        $rata = 0;
        $totalData = count($data);
        $sum = 0;
        $data->each(function ($dosen) use (&$sum, &$rata) {
            $rata += ($dosen->rata_rata_mahasiswa + $dosen->rata_rata_mahasiswa_lain) / 2;
            $sum += $dosen->rata_rata_mahasiswa + $dosen->rata_rata_mahasiswa_lain;
        });

        return [
            'rata_rata' => number_format($rata / $totalData, 2),
            'total_sum' => $sum,
        ];
    }
}
