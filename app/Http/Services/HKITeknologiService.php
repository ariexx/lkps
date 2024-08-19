<?php

namespace App\Http\Services;

use App\Models\HKITeknologi;

class HKITeknologiService
{
    public function __construct(
        public HKITeknologi $hkiTeknologi,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showLuaranPenelitianDTPSBagian3()
    {
        $data = $this->hkiTeknologi->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->luaran_dan_pkm,
                $item->tahun,
                $item->keterangan,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi.reject', $item->id),
                ])->render()
            ];
        })->toArray();

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
            "heads" => $heads,
            "data" => $data
        ];

        return view('hki-teknologi.index', compact('config'));
    }

    public function createLuaranPenelitianDTPSBagian3()
    {
        return view('hki-teknologi.create');
    }

    public function storeLuaranPenelitianDTPSBagian3(\Illuminate\Http\Request $request)
    {
        $bukti = $this->fileUploadService->uploadFile($request, 'bukti', 'luaran-penelitian-pkm-teknologi');
        $this->hkiTeknologi->create([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
        ]);

        $this->logActivityService->log(["tambah", "Luaran Penelitian dan PKM Teknologi"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi')->with('success', 'Berhasil menambahkan data luaran penelitian dan PKM teknologi');
    }

    public function editLuaranPenelitianDTPSBagian3($id)
    {
        $data = $this->hkiTeknologi->find($id);
        return view('hki-teknologi.edit', compact('data'));
    }

    public function updateLuaranPenelitianDTPSBagian3(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->hkiTeknologi->find($id);
        $bukti = $data->bukti;
        if ($request->hasFile('bukti')) {
            $bukti = $this->fileUploadService->uploadFile($request, 'bukti', 'luaran-penelitian-pkm-teknologi');
        }

        $data->update([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
        ]);

        $this->logActivityService->log(["ubah", "Luaran Penelitian dan PKM Teknologi"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi')->with('success', 'Berhasil mengubah data luaran penelitian dan PKM teknologi');
    }

    public function deleteLuaranPenelitianDTPSBagian3($id)
    {
        $data = $this->hkiTeknologi->find($id);
        $this->fileUploadService->deleteFile($data->bukti);
        $data->delete();

        $this->logActivityService->log(["hapus", "Luaran Penelitian dan PKM Teknologi"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi')->with('success', 'Berhasil menghapus data luaran penelitian dan PKM teknologi');
    }

    public function approveLuaranPenelitianDTPSBagian3($id)
    {
        $data = $this->hkiTeknologi->find($id);
        $data->update([
            'is_approve' => STATUS_APPROVED
        ]);

        $this->logActivityService->log(["setujui", "Luaran Penelitian dan PKM Teknologi"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi')->with('success', 'Berhasil menyetujui data luaran penelitian dan PKM teknologi');
    }

    public function rejectLuaranPenelitianDTPSBagian3($id)
    {
        $data = $this->hkiTeknologi->find($id);
        $data->update([
            'is_approve' => STATUS_REJECTED
        ]);

        $this->logActivityService->log(["tolak", "Luaran Penelitian dan PKM Teknologi"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi')->with('success', 'Berhasil menolak data luaran penelitian dan PKM teknologi');
    }

}
