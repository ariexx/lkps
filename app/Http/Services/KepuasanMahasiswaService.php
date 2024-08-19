<?php

namespace App\Http\Services;

use App\Models\KepuasanMahasiswa;

class KepuasanMahasiswaService
{
    public function __construct(
        public KepuasanMahasiswa $kepuasanMahasiswa,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showKepuasanMahasiswa()
    {
        $data = $this->kepuasanMahasiswa->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->aspek,
                $item->sangat_baik . "%",
                $item->baik . "%",
                $item->cukup . "%",
                $item->kurang . "%",
                $item->rencana_tindak_lanjut,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.kepuasan-mahasiswa.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.kepuasan-mahasiswa.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.kepuasan-mahasiswa.approve', $item->id),
                    "routeReject" => route('kepala-prodi.kepuasan-mahasiswa.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $averageSangatBaik = number_format($this->kepuasanMahasiswa->avg('sangat_baik'), 2);
        $averageBaik = number_format($this->kepuasanMahasiswa->avg('baik'), 2);
        $averageCukup = number_format($this->kepuasanMahasiswa->avg('cukup'), 2);
        $averageKurang = number_format($this->kepuasanMahasiswa->avg('kurang'), 2);

        $heads = [
            'No',
            'Aspek',
            'Sangat Baik',
            'Baik',
            'Cukup',
            'Kurang',
            'Rencana Tindak Lanjut',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view('kepuasan-mahasiswa.index', compact('config', 'averageSangatBaik', 'averageBaik', 'averageCukup', 'averageKurang'));
    }

    public function createKepuasanMahasiswa()
    {
        return view('kepuasan-mahasiswa.create');
    }

    public function storeKepuasanMahasiswa(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $data['is_approve'] = 0;

        $this->kepuasanMahasiswa->create($data);

        $this->logActivityService->log(["tambah", "Berhasil menambahkan data kepuasan mahasiswa $request[aspek]"]);

        return redirect()->route('kepala-prodi.kepuasan-mahasiswa')->with('success', 'Berhasil menambahkan data kepuasan mahasiswa');
    }

    public function editKepuasanMahasiswa($id)
    {
        $data = $this->kepuasanMahasiswa->find($id);
        return view('kepuasan-mahasiswa.edit', compact('data'));
    }

    public function updateKepuasanMahasiswa(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->kepuasanMahasiswa->find($id);
        $all = $request->all();
        $all['is_approve'] = 0;

        $data->update($all);

        $this->logActivityService->log(["ubah", "Berhasil mengubah data kepuasan mahasiswa $request[aspek]"]);

        return redirect()->route('kepala-prodi.kepuasan-mahasiswa')->with('success', 'Berhasil mengubah data kepuasan mahasiswa');
    }

    public function deleteKepuasanMahasiswa($id)
    {
        $this->kepuasanMahasiswa->find($id)->delete();

        $this->logActivityService->log(["hapus", "Berhasil menghapus data kepuasan mahasiswa"]);

        return redirect()->route('kepala-prodi.kepuasan-mahasiswa')->with('success', 'Berhasil menghapus data kepuasan mahasiswa');
    }

    public function approveKepuasanMahasiswa($id)
    {
        $this->kepuasanMahasiswa->find($id)->update(['is_approve' => STATUS_APPROVED]);

        $this->logActivityService->log(["setujui", "Berhasil menyetujui data kepuasan mahasiswa"]);

        return redirect()->route('kepala-prodi.kepuasan-mahasiswa')->with('success', 'Berhasil menyetujui data kepuasan mahasiswa');
    }

    public function rejectKepuasanMahasiswa($id)
    {
        $this->kepuasanMahasiswa->find($id)->update(['is_approve' => STATUS_REJECTED]);

        $this->logActivityService->log(["tolak", "Berhasil menolak data kepuasan mahasiswa"]);

        return redirect()->route('kepala-prodi.kepuasan-mahasiswa')->with('success', 'Berhasil menolak data kepuasan mahasiswa');
    }


}
