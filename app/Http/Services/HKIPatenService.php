<?php

namespace App\Http\Services;

use App\Models\HKIPaten;

class HKIPatenService
{
    public function __construct(
        public HKIPaten $HKIPaten,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showLuaranPenelitianDTPSBagian1()
    {
        $data = $this->HKIPaten->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->luaran_dan_pkm,
                $item->tahun,
                $item->keterangan,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten.reject', $item->id),
                ])->render()
            ];
        });

        $heads = [
            'No',
            'Luaran dan PKM',
            'Tahun',
            'Keterangan',
            'Bukti',
            'Status',
            'Aksi'
        ];

        $config = [
            "data" => $data,
            "heads" => $heads,
        ];

        return view('hki-paten.index', compact('config'));
    }

    public function createLuaranPenelitianDTPSBagian1()
    {
        return view('hki-paten.create');
    }

    public function storeLuaranPenelitianDTPSBagian1(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'luaran_dan_pkm' => 'required',
            'tahun' => 'required',
            'keterangan' => 'required',
            'bukti' => 'required',
        ]);

        $bukti = $this->fileUploadService->uploadFile($request, 'bukti', 'hki-paten');

        $this->HKIPaten->create([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
            'is_approve' => 0,
        ]);

        $this->logActivityService->log(["tambah", "Berhasil menambahkan data luaran penelitian PKM HKI Paten $request[luaran_dan_pkm]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten');
    }

    public function editLuaranPenelitianDTPSBagian1($id)
    {
        $data = $this->HKIPaten->find($id);
        return view('hki-paten.edit', compact('data'));
    }

    public function updateLuaranPenelitianDTPSBagian1(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'luaran_dan_pkm' => 'required',
            'tahun' => 'required',
            'keterangan' => 'required',
        ]);

        $data = $this->HKIPaten->find($id);

        $bukti = $data->bukti;
        if ($request->hasFile('bukti')) {
            $bukti = $this->fileUploadService->uploadFile($request, 'bukti', 'hki-paten');
        }

        $data->update([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
        ]);

        $this->logActivityService->log(["ubah", "Berhasil mengubah data luaran penelitian PKM HKI Paten $request[luaran_dan_pkm]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten');
    }

    public function deleteLuaranPenelitianDTPSBagian1($id)
    {
        $data = $this->HKIPaten->find($id);
        $this->fileUploadService->deleteFile($data->bukti);
        $data->delete();

        $this->logActivityService->log(["hapus", "Berhasil menghapus data luaran penelitian PKM HKI Paten"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten');
    }

    public function approveLuaranPenelitianDTPSBagian1($id)
    {
        $this->HKIPaten->find($id)->update(['is_approve' => STATUS_APPROVED]);

        $this->logActivityService->log(["setujui", "Berhasil menyetujui data luaran penelitian PKM HKI Paten"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten');
    }

    public function rejectLuaranPenelitianDTPSBagian1($id)
    {
        $this->HKIPaten->find($id)->update(['is_approve' => STATUS_REJECTED]);

        $this->logActivityService->log(["tolak", "Berhasil menolak data luaran penelitian PKM HKI Paten"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten');
    }

}
