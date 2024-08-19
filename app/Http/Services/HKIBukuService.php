<?php

namespace App\Http\Services;

use App\Models\HKIBuku;

class HKIBukuService
{
    public function __construct(
        public HKIBuku $hkiBuku,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showLuaranPenelitianDTPSBagian4()
    {
        $data = $this->hkiBuku->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->luaran_dan_pkm,
                $item->tahun,
                $item->keterangan,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku.reject', $item->id),
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

        return view('hki-buku.index', compact('config'));
    }

    public function createLuaranPenelitianDTPSBagian4()
    {
        return view('hki-buku.create');
    }

    public function storeLuaranPenelitianDTPSBagian4(\Illuminate\Http\Request $request)
    {
        $bukti = $this->fileUploadService->uploadFile($request, 'bukti', 'hki-buku');

        $this->hkiBuku->create([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
        ]);

        $this->logActivityService->log(["tambah", "Luaran Penelitian dan PKM Buku $request[luaran_dan_pkm]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku')->with('success', 'Berhasil menambahkan data luaran penelitian dan PKM buku');
    }

    public function editLuaranPenelitianDTPSBagian4($id)
    {
        $data = $this->hkiBuku->find($id);

        return view('hki-buku.edit', compact('data'));
    }

    public function updateLuaranPenelitianDTPSBagian4(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->hkiBuku->find($id);
        $bukti = $data->bukti;

        if ($request->hasFile('bukti')) {
            $bukti = $this->fileUploadService->uploadFile($request, 'bukti', 'hki-buku');
        }

        $data->update([
            'luaran_dan_pkm' => $request->luaran_dan_pkm,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
        ]);

        $this->logActivityService->log(["ubah", "Luaran Penelitian dan PKM Buku $request[luaran_dan_pkm]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku')->with('success', 'Berhasil mengubah data luaran penelitian dan PKM buku');
    }

    public function deleteLuaranPenelitianDTPSBagian4($id)
    {
        $data = $this->hkiBuku->find($id);
        $this->fileUploadService->deleteFile($data->bukti);
        $data->delete();

        $this->logActivityService->log(["hapus", "Luaran Penelitian dan PKM Buku $data->luaran_dan_pkm"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku')->with('success', 'Berhasil menghapus data luaran penelitian dan PKM buku');
    }

    public function approveLuaranPenelitianDTPSBagian4($id)
    {
        $data = $this->hkiBuku->find($id);
        $data->update([
            'is_approve' => STATUS_APPROVED
        ]);

        $this->logActivityService->log(["setujui", "Luaran Penelitian dan PKM Buku $data->luaran_dan_pkm"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku')->with('success', 'Berhasil menyetujui data luaran penelitian dan PKM buku');
    }

    public function rejectLuaranPenelitianDTPSBagian4($id)
    {
        $data = $this->hkiBuku->find($id);
        $data->update([
            'is_approve' => STATUS_REJECTED
        ]);

        $this->logActivityService->log(["tolak", "Luaran Penelitian dan PKM Buku $data->luaran_dan_pkm"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku')->with('success', 'Berhasil menolak data luaran penelitian dan PKM buku');
    }
}
