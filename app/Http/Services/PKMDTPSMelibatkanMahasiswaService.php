<?php

namespace App\Http\Services;

use App\Models\PKMDTPSMelibatkanMahasiswa;

class PKMDTPSMelibatkanMahasiswaService
{
    public function __construct(
        public PKMDTPSMelibatkanMahasiswa $pkmDTPSMelibatkanMahasiswa,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showPKMDTPSYangMelibatkanMahasiswa()
    {
        $data = $this->pkmDTPSMelibatkanMahasiswa->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama_dosen,
                $item->tema_pkm,
                $item->nama_mahasiswa,
                $item->judul_kegiatan,
                $item->tahun,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.approve', $item->id),
                    "routeReject" => route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama Dosen',
            'Tema PKM',
            'Nama Mahasiswa',
            'Judul Kegiatan',
            'Tahun',
            'Bukti',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view('pkm-dtps-melibatkan-mahasiswa.index', compact('config'));
    }

    public function createPKMDTPSYangMelibatkanMahasiswa()
    {
        return view('pkm-dtps-melibatkan-mahasiswa.create');
    }

    public function storePKMDTPSYangMelibatkanMahasiswa(\Illuminate\Http\Request $request)
    {
        try {
            $all = $request->all();
            if ($request->hasFile('bukti')) {
                $all['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'pkm-dtps-melibatkan-mahasiswa');
            }
            $this->pkmDTPSMelibatkanMahasiswa->create($all);
            $this->logActivityService->log(["tambah", "PKM DTPS Melibatkan Mahasiswa $all[nama_dosen]"]);
            return redirect()->route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa')->with('success', 'Berhasil menambahkan data PKM DTPS Melibatkan Mahasiswa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data PKM DTPS Melibatkan Mahasiswa ' . $e->getMessage());
        }
    }

    public function editPKMDTPSYangMelibatkanMahasiswa($id)
    {
        $data = $this->pkmDTPSMelibatkanMahasiswa->find($id);
        return view('pkm-dtps-melibatkan-mahasiswa.edit', compact('data'));
    }

    public function updatePKMDTPSYangMelibatkanMahasiswa(\Illuminate\Http\Request $request, $id)
    {
        try {
            $data = $this->pkmDTPSMelibatkanMahasiswa->find($id);
            $all = $request->all();
            if ($request->hasFile('bukti')) {
                $all['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'pkm-dtps-melibatkan-mahasiswa');
            }
            $data->update($all);
            $this->logActivityService->log(["ubah", "PKM DTPS Melibatkan Mahasiswa $all[nama_dosen]"]);
            return redirect()->route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa')->with('success', 'Berhasil mengubah data PKM DTPS Melibatkan Mahasiswa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data PKM DTPS Melibatkan Mahasiswa ' . $e->getMessage());
        }
    }

    public function deletePKMDTPSYangMelibatkanMahasiswa($id)
    {
        try {
            $data = $this->pkmDTPSMelibatkanMahasiswa->find($id);
            $this->fileUploadService->deleteFile($data->bukti);
            $data->delete();
            $this->logActivityService->log(["hapus", "PKM DTPS Melibatkan Mahasiswa $data[nama_dosen]"]);
            return redirect()->route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa')->with('success', 'Berhasil menghapus data PKM DTPS Melibatkan Mahasiswa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data PKM DTPS Melibatkan Mahasiswa ' . $e->getMessage());
        }
    }

    public function approvePKMDTPSYangMelibatkanMahasiswa($id)
    {
        try {
            $data = $this->pkmDTPSMelibatkanMahasiswa->find($id);
            $data->update(['is_approve' => 1]);
            $this->logActivityService->log(["setujui", "PKM DTPS Melibatkan Mahasiswa $data[nama_dosen]"]);
            return redirect()->route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa')->with('success', 'Berhasil menyetujui PKM DTPS Melibatkan Mahasiswa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui PKM DTPS Melibatkan Mahasiswa ' . $e->getMessage());
        }
    }

    public function rejectPKMDTPSYangMelibatkanMahasiswa($id)
    {
        try {
            $data = $this->pkmDTPSMelibatkanMahasiswa->find($id);
            $data->update(['is_approve' => STATUS_REJECTED]);
            $this->logActivityService->log(["tolak", "PKM DTPS Melibatkan Mahasiswa $data[nama_dosen]"]);
            return redirect()->route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa')->with('success', 'Berhasil menolak PKM DTPS Melibatkan Mahasiswa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak PKM DTPS Melibatkan Mahasiswa ' . $e->getMessage());
        }
    }
}
