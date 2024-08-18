<?php

namespace App\Http\Services;

use App\Models\RekognisiDosen;
use Illuminate\Http\Request;

class RekognisiDosenService
{
    public function __construct
    (
        public RekognisiDosen $rekognisiDosen,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
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
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved_bool($item->wilayah),
                is_approved_bool($item->nasional),
                is_approved_bool($item->internasional),
                $item->tahun,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.reject', $item->id),
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
            'Status',
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

    public function storeRekognisiDosen(Request $request)
    {
        $all = $request->all();
        if ($request->hasFile('bukti')) {
            $all['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'rekognisi-dosen');
        }

        $this->rekognisiDosen->create($all);
        $this->logActivityService->log(["tambah", "Berhasil menambahkan data rekognisi dosen $request[nama]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen')->with('success', 'Berhasil menambahkan data rekognisi dosen');
    }

    public function editRekognisiDosen($id)
    {
        $data = $this->rekognisiDosen->find($id);
        return view('rekognisi-dosen.edit', compact('data'));
    }

    public function updateRekognisiDosen(Request $request, $id)
    {
        $data = $this->rekognisiDosen->find($id);
        $validated = $request->validate([
            'nama' => 'required',
            'bidang' => 'required',
            'rekognisi' => 'required',
            'bukti' => 'sometimes|image',
            'internasional' => 'required',
            'tahun' => 'required'
        ]);

        if ($request->hasFile('bukti')) {
            $this->fileUploadService->deleteFile($data->bukti);
            $validated['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'rekognisi-dosen');
        }

        $data->update($validated);
        $this->logActivityService->log(["ubah", "Berhasil mengubah data rekognisi dosen $data->nama"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen')->with('success', 'Berhasil mengubah data rekognisi dosen');
    }

    public function deleteRekognisiDosen($id)
    {
        try {
            $data = $this->rekognisiDosen->find($id);
            $this->fileUploadService->deleteFile($data->bukti);
            $data->delete();
            $this->logActivityService->log(["hapus", "Berhasil menghapus data rekognisi dosen"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen')->with('success', 'Berhasil menghapus data rekognisi dosen');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data rekognisi dosen');
        }
    }

    public function approveRekognisiDosen($id)
    {
        try {
            $this->rekognisiDosen->find($id)->update(['is_approve' => STATUS_APPROVED]);

            $this->logActivityService->log(["approve", "Berhasil menyetujui data rekognisi dosen"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen')->with('success', 'Berhasil menyetujui data rekognisi dosen');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui data rekognisi dosen');
        }
    }

    public function rejectRekognisiDosen($id)
    {
        try {
            $this->rekognisiDosen->find($id)->update(['is_approve' => STATUS_REJECTED]);

            $this->logActivityService->log(["reject", "Berhasil menolak data rekognisi dosen"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen')->with('success', 'Berhasil menolak data rekognisi dosen');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak data rekognisi dosen');
        }
    }
}
