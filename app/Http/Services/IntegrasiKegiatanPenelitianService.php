<?php

namespace App\Http\Services;

use App\Models\IntegrasiKegiatanPenelitian;

class IntegrasiKegiatanPenelitianService
{
    public function __construct(
        public IntegrasiKegiatanPenelitian $integrasiKegiatanPenelitian,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showIntegrasiKegiatanPenelitianPKMDalamPembelajaran()
    {
        $data = $this->integrasiKegiatanPenelitian->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->judul,
                $item->nama_dosen,
                $item->mata_kuliah,
                $item->bentuk_integrasi,
                $item->tahun,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.approve', $item->id),
                    "routeReject" => route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Judul',
            'Nama Dosen',
            'Mata Kuliah',
            'Bentuk Integrasi',
            'Tahun',
            'Bukti',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view('integrasi-kegiatan-penelitian.index', compact('config'));
    }

    public function createIntegrasiKegiatanPenelitianPKMDalamPembelajaran()
    {
        return view('integrasi-kegiatan-penelitian.create');
    }

    public function storeIntegrasiKegiatanPenelitianPKMDalamPembelajaran(\Illuminate\Http\Request $request)
    {
        $all = $request->all();
        if ($request->hasFile('bukti')) {
            $all['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'integrasi-kegiatan-penelitian');
        }

        $this->integrasiKegiatanPenelitian->create($all);
        $this->logActivityService->log(["tambah", "Berhasil menambahkan data integrasi kegiatan penelitian $request[judul]"]);
        return redirect()->route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran')->with('success', 'Berhasil menambahkan data integrasi kegiatan penelitian');
    }

    public function editIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        $data = $this->integrasiKegiatanPenelitian->find($id);
        return view('integrasi-kegiatan-penelitian.edit', compact('data'));
    }

    public function updateIntegrasiKegiatanPenelitianPKMDalamPembelajaran(\Illuminate\Http\Request $request, $id)
    {
        $all = $request->all();
        if ($request->hasFile('bukti')) {
            $all['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'integrasi-kegiatan-penelitian');
        }

        $this->integrasiKegiatanPenelitian->find($id)->update($all);
        $this->logActivityService->log(["edit", "Berhasil mengubah data integrasi kegiatan penelitian $request[judul]"]);
        return redirect()->route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran')->with('success', 'Berhasil mengubah data integrasi kegiatan penelitian');
    }

    public function deleteIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        $this->integrasiKegiatanPenelitian->find($id)->delete();
        $this->logActivityService->log(["hapus", "Berhasil menghapus data integrasi kegiatan penelitian"]);
        return redirect()->route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran')->with('success', 'Berhasil menghapus data integrasi kegiatan penelitian');
    }

    public function approveIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        $this->integrasiKegiatanPenelitian->find($id)->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setuji", "Berhasil menyetujui data integrasi kegiatan penelitian"]);
        return redirect()->route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran')->with('success', 'Berhasil menyetujui data integrasi kegiatan penelitian');
    }

    public function rejectIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        $this->integrasiKegiatanPenelitian->find($id)->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Berhasil menolak data integrasi kegiatan penelitian"]);
        return redirect()->route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran')->with('success', 'Berhasil menolak data integrasi kegiatan penelitian');
    }
}
