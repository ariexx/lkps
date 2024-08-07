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

    public function showKerjasamaPenelitian()
    {
        $data = $this->kerjasamaPenelitian->get();
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
            'Persetujuan',
            'Action'
        ];
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian', compact('data', 'heads'));
    }

    public function createKerjasamaPenelitian()
    {
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.create-kerjasama-penelitian');
    }
}
