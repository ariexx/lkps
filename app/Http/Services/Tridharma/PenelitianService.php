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

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian')->with('success', 'Data berhasil disimpan');
    }

    // app/Http/Services/Tridharma/PenelitianService.php
    public function showKerjasamaPenelitian()
    {
        $data = $this->kerjasamaPenelitian->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->lembaga,
                is_approved_bool($item->internasional),
                is_approved_bool($item->nasional),
                is_approved_bool($item->lokal),
                $item->judul,
                $item->manfaat,
                $item->durasi,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                $item->tahun_kerjasama,
                is_approved($item->is_approved),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.delete', $item->id),
                    'routeApprove' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.approve', $item->id),
                    'routeReject' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.reject', $item->id),
                    'isApproved' => $item->is_approved
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
            'Status',
            'Action'
        ];

        $config = [
            'data' => $data,
            'title' => 'Kerjasama Penelitian',
            'route' => 'kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian',
            'routeCreate' => 'kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.create'
        ];

        return view('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian', compact('config', 'heads'));
    }

    public function createKerjasamaPenelitian()
    {
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.create-kerjasama-penelitian');
    }

    public function editKerjasamaPenelitian($id)
    {
        $data = $this->kerjasamaPenelitian->find($id);
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.edit-kerjasama-penelitian', compact('data'));
    }

    public function updateKerjasamaPenelitian(Request $request, $id)
    {
        $data = $request->all();
        if($request->hasFile('bukti')) {
            //delete old file
            $oldFile = $this->kerjasamaPenelitian->find($id)->bukti;
            if($oldFile) {
                $this->fileUploadService->deleteFile($oldFile);
            }
            $data['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'kerjasama_penelitian');
        }

        $updated = $this->kerjasamaPenelitian->find($id)->update($data);
        if(!$updated) {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian')->with('success', 'Data berhasil diupdate');
    }

    public function deleteKerjasamaPenelitian($id)
    {
        //delete file
        $file = $this->kerjasamaPenelitian->find($id)->bukti;
        if($file) {
            $this->fileUploadService->deleteFile($file);
        }
        $deleted = $this->kerjasamaPenelitian->find($id)->delete();
        if(!$deleted) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian')->with('success', 'Data berhasil dihapus');
    }

    public function approveFileKerjasamaPenelitian($id)
    {
        $approved = $this->kerjasamaPenelitian->find($id)->update(['is_approved' => STATUS_APPROVED]);
        if(!$approved) {
            return redirect()->back()->with('error', 'Data gagal disetujui');
        }

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian')->with('success', 'Data berhasil disetujui');
    }

    public function rejectFileKerjasamaPenelitian($id)
    {
        $rejected = $this->kerjasamaPenelitian->find($id)->update(['is_approved' => STATUS_REJECTED]);
        if(!$rejected) {
            return redirect()->back()->with('error', 'Data gagal ditolak');
        }

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian')->with('success', 'Data berhasil ditolak');
    }
}
