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
        'is_approve'
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
        }

        return $this->extractedRataRata($rataRataTS, $rataRataTS1, $rataRataTS2, $totalData);
    }

    public function rataRataTSLain(): array
    {
        $data = $this->where('user_id', user()->id)->get();

        $rataRataTS = 0;
        $rataRataTS1 = 0;
        $rataRataTS2 = 0;

        $totalData = count($data);

        foreach ($data as $d) {
            $rataRataTS += $d->jumlah_mahasiswa_dibimbing_ts_lain;
            $rataRataTS1 += $d->jumlah_mahasiswa_dibimbing_ts1_lain;
            $rataRataTS2 += $d->jumlah_mahasiswa_dibimbing_ts2_lain;
        }

        return $this->extractedRataRata($rataRataTS, $rataRataTS1, $rataRataTS2, $totalData);
    }

    public function rataRataSemua(): array
    {
        $data = $this->where('user_id', user()->id)->get();

        $rata = 0;
        $totalData = count($data);
        $sum = 0;
        $data->each(function ($dosen) use (&$sum, &$rata) {
            $rata += $this->rataRataPS($dosen->id);
            $sum += $this->rataRataPS($dosen->id);
        });

        return [
            'rata_rata' => $totalData == 0 ? 0 : number_format($rata / $totalData, 2),
            'total_sum' => $sum,
        ];
    }

    public function rataRataPS($id): float
    {
        $data = $this->where('user_id', user()->id)->whereId($id)->first();
        $jumlahTS = (float) $data->jumlah_mahasiswa_dibimbing_ts;
        $jumlahTS1 = (float) $data->jumlah_mahasiswa_dibimbing_ts1;
        $jumlahTS2 = (float) $data->jumlah_mahasiswa_dibimbing_ts2;
        $jumlahTSLain = (float) $data->jumlah_mahasiswa_dibimbing_ts_lain;
        $jumlahTS1Lain = (float) $data->jumlah_mahasiswa_dibimbing_ts1_lain;
        $jumlahTS2Lain = (float) $data->jumlah_mahasiswa_dibimbing_ts2_lain;

        $totalPS = (float) number_format(($jumlahTS2 + $jumlahTS1 + $jumlahTS) / 3, 2);
        $totalPSLain = (float) number_format(($jumlahTS2Lain + $jumlahTS1Lain + $jumlahTSLain) / 3, 2);

        $total = ($totalPS + $totalPSLain) / 2;

        return number_format($total, 2);
    }

    /**
     * @param mixed $rataRataTS
     * @param mixed $rataRataTS1
     * @param mixed $rataRataTS2
     * @param int $totalData
     * @return array
     */
    public function extractedRataRata(mixed $rataRataTS, mixed $rataRataTS1, mixed $rataRataTS2, int $totalData): array
    {
        $rataRataTS = (float) $rataRataTS;
        $rataRataTS1 = (float) $rataRataTS1;
        $rataRataTS2 = (float) $rataRataTS2;

        if ($totalData == 0) {
            return [
                'rata_rata_ts' => 0,
                'rata_rata_ts1' => 0,
                'rata_rata_ts2' => 0,
                'rata_rata' => 0,
                'total_ts2' => $rataRataTS2,
                'total_ts1' => $rataRataTS1,
                'total_ts' => $rataRataTS,
                'total_rata_rata' => 0,
            ];
        }

        $rataRata = number_format(($rataRataTS + $rataRataTS1 + $rataRataTS2) / 3, 2);

        return [
            'rata_rata_ts' => number_format($rataRataTS / $totalData, 2),
            'rata_rata_ts1' => number_format($rataRataTS1 / $totalData, 2),
            'rata_rata_ts2' => number_format($rataRataTS2 / $totalData, 2),
            'rata_rata' => number_format(($rataRata / $totalData), 2),
            'total_ts2' => $rataRataTS2,
            'total_ts1' => $rataRataTS1,
            'total_ts' => $rataRataTS,
            'total_rata_rata' => $rataRata,
        ];
    }

}
