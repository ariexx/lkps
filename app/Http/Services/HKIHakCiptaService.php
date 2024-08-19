<?php

namespace App\Http\Services;

use App\Models\HKIHakCipta;

class HKIHakCiptaService
{
    public function __construct(
        public HKIHakCipta $HKIHakCipta,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showLuaranPenelitianDTPSBagian2()
    {
        $data = $this->HKIHakCipta->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->luaran_dan_pkm,
                $item->tahun,
                $item->keterangan,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta.reject', $item->id),
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

        return view('hki-hak-cipta.index', compact('config'));
    }

    public function createLuaranPenelitianDTPSBagian2()
    {
        return view('hki-hak-cipta.create');
    }

    public function storeLuaranPenelitianDTPSBagian2(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'luaran_dan_pkm' => 'required',
            'tahun' => 'required',
            'keterangan' => 'required',
            'bukti' => 'required',
        ]);

        $file = $this->fileUploadService->uploadFile($request, 'bukti', 'hki-hak-cipta');

        $this->HKIHakCipta->create([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $file,
            'is_approve' => 0,
        ]);

        $this->logActivityService->log(["tambah", "Berhasil menambahkan data luaran penelitian DTPS bagian 2 $request[luaran_dan_pkm]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta')->with('success', 'Berhasil menambahkan data luaran penelitian DTPS bagian 2');
    }

    public function editLuaranPenelitianDTPSBagian2($id)
    {
        $data = $this->HKIHakCipta->find($id);
        return view('hki-hak-cipta.edit', compact('data'));
    }

    public function updateLuaranPenelitianDTPSBagian2(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->HKIHakCipta->find($id);

        $request->validate([
            'luaran_dan_pkm' => 'required',
            'tahun' => 'required',
            'keterangan' => 'required',
            'bukti' => 'sometimes|file|mimes:pdf',
        ]);

        $file = $data->bukti;
        if ($request->hasFile('bukti')) {
            $file = $this->fileUploadService->uploadFile($request, 'bukti', 'hki-hak-cipta');
        }

        $data->update([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $file,
        ]);

        $this->logActivityService->log(["ubah", "Berhasil mengubah data luaran penelitian DTPS bagian 2 $request[luaran_dan_pkm]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta')->with('success', 'Berhasil mengubah data luaran penelitian DTPS bagian 2');
    }

    public function deleteLuaranPenelitianDTPSBagian2($id)
    {
        $data = $this->HKIHakCipta->find($id);
        $this->fileUploadService->deleteFile($data->bukti);
        $data->delete();

        $this->logActivityService->log(["hapus", "Berhasil menghapus data luaran penelitian DTPS bagian 2 $data->luaran_dan_pkm"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta')->with('success', 'Berhasil menghapus data luaran penelitian DTPS bagian 2');
    }

    public function approveLuaranPenelitianDTPSBagian2($id)
    {
        $data = $this->HKIHakCipta->find($id);
        $data->update(['is_approve' => STATUS_APPROVED]);

        $this->logActivityService->log(["setujui", "Berhasil menyetujui data luaran penelitian DTPS bagian 2 $data->luaran_dan_pkm"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta')->with('success', 'Berhasil menyetujui data luaran penelitian DTPS bagian 2');
    }

    public function rejectLuaranPenelitianDTPSBagian2($id)
    {
        $data = $this->HKIHakCipta->find($id);
        $data->update(['is_approve' => STATUS_REJECTED]);

        $this->logActivityService->log(["tolak", "Berhasil menolak data luaran penelitian DTPS bagian 2 $data->luaran_dan_pkm"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta')->with('success', 'Berhasil menolak data luaran penelitian DTPS bagian 2');
    }
}
