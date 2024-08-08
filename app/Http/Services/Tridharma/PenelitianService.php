<?php

namespace App\Http\Services\Tridharma;

use App\Http\Services\FileUploadService;
use App\Models\KerjasamaPenelitian;
use Illuminate\Http\Request;

class PenelitianService
{
    public function __construct(
        public FileUploadService $fileUploadService,
        public KerjasamaPenelitian $kerjasamaPenelitian
    )
    {
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('bukti')) {
            $data['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'kerjasama_penelitian');
        }

        $data['is_approved'] = false;
        $saved = $this->kerjasamaPenelitian->create($data);
        if(!$saved) {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }

        return redirect()->route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian')->with('success', 'Data berhasil disimpan');
    }

    // app/Http/Services/Tridharma/PenelitianService.php
    public function showKerjasamaPenelitian()
    {
        $data = $this->kerjasamaPenelitian->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->lembaga,
                is_approved($item->internasional),
                is_approved($item->nasional),
                is_approved($item->lokal),
                $item->judul,
                $item->manfaat,
                $item->durasi,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                $item->tahun_kerjasama,
                is_approved($item->is_approved),
                view('components.buttons', [
                    'routeEdit' => route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.edit', $item->id),
                    'routeDelete' => route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.delete', $item->id)
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Lembaga',
            'Internasional',
            'Nasional',
            'Lokal',
            'Judul',
            'Manfaat',
            'Durasi',
            'Bukti',
            'Tahun Kerjasama',
            'Disetujui',
            'Action'
        ];

        $config = [
            'data' => $data,
            'title' => 'Kerjasama Penelitian',
            'route' => 'superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian',
            'routeCreate' => 'superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.create'
        ];

        return view('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian', compact('config', 'heads'));
    }

    public function createKerjasamaPenelitian()
    {
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.create-kerjasama-penelitian');
    }
}
