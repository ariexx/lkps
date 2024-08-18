<?php

namespace App\Http\Services;

use App\Models\RekognisiDosen;

class RekognisiDosenService
{
    public function __construct
    (
        public RekognisiDosen $rekognisiDosen,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showRekognisiDosen()
    {
        $data = $this->rekognisiDosen->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama,
                $item->bidang,
                $item->rekognisi,
                $item->bukti,
                $item->wilayah,
                $item->nasional,
                $item->internasional,
                $item->tahun,
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.delete', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'Bidang',
            'Rekognisi',
            'Bukti',
            'Wilayah',
            'Nasional',
            'Internasional',
            'Tahun',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view("rekognisi-dosen.index", compact('config'));
    }

    public function createRekognisiDosen()
    {
        return view("rekognisi-dosen.create");
    }
}
