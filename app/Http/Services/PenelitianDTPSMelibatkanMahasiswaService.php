<?php

namespace App\Http\Services;

use App\Models\PenelitianDTPSMelibatkanMahasiswa;

class PenelitianDTPSMelibatkanMahasiswaService
{
    public function __construct(
        public PenelitianDTPSMelibatkanMahasiswa $penelitianDTPSMelibatkanMahasiswa,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showPenelitianDTPSMelibatkanMahasiswa()
    {
        $data = $this->penelitianDTPSMelibatkanMahasiswa->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama_dosen,
                $item->tema_penelitian,
                $item->nama_mahasiswa,
                $item->judul_kegiatan,
                $item->tahun,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa.approve', $item->id),
                    "routeReject" => route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama Dosen',
            'Tema Penelitian',
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

        return view('penelitian-dtps-melibatkan-mahasiswa.index', compact('config'));
    }

    public function createPenelitianDTPSMelibatkanMahasiswa()
    {
        return view('penelitian-dtps-melibatkan-mahasiswa.create');
    }

    public function storePenelitianDTPSMelibatkanMahasiswa(\Illuminate\Http\Request $request)
    {
        $all = $request->all();
        $validated = $request->validate([
            'nama_dosen' => 'required',
            'tema_penelitian' => 'required',
            'nama_mahasiswa' => 'required',
            'judul_kegiatan' => 'required',
            'tahun' => 'required',
            'bukti' => 'sometimes'
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'penelitian-dtps-melibatkan-mahasiswa');
        }

        $validated['is_approve'] = STATUS_PENDING;
        $this->penelitianDTPSMelibatkanMahasiswa->create($validated);
        $this->logActivityService->log(["tambah", "Berhasil menambahkan data penelitian DTPS melibatkan mahasiswa $request->nama_dosen"]);
        return redirect()->route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa')->with('success', 'Data penelitian DTPS melibatkan mahasiswa berhasil ditambahkan');
    }

    public function editPenelitianDTPSMelibatkanMahasiswa($id)
    {
        $data = $this->penelitianDTPSMelibatkanMahasiswa->find($id);
        return view('penelitian-dtps-melibatkan-mahasiswa.edit', compact('data'));
    }

    public function updatePenelitianDTPSMelibatkanMahasiswa(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->penelitianDTPSMelibatkanMahasiswa->find($id);
        $validated = $request->validate([
            'nama_dosen' => 'required',
            'tema_penelitian' => 'required',
            'nama_mahasiswa' => 'required',
            'judul_kegiatan' => 'required',
            'tahun' => 'required',
            'bukti' => 'sometimes'
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'penelitian-dtps-melibatkan-mahasiswa');
        }

        $data->update($validated);
        $this->logActivityService->log(["ubah", "Berhasil mengubah data penelitian DTPS melibatkan mahasiswa $data->nama_dosen"]);
        return redirect()->route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa')->with('success', 'Data penelitian DTPS melibatkan mahasiswa berhasil diubah');
    }

    public function deletePenelitianDTPSMelibatkanMahasiswa($id)
    {
        $data = $this->penelitianDTPSMelibatkanMahasiswa->find($id);
        $this->logActivityService->log(["hapus", "Berhasil menghapus data penelitian DTPS melibatkan mahasiswa $data->nama_dosen"]);
        $this->fileUploadService->deleteFile($data->bukti);
        $data->delete();
        return redirect()->route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa')->with('success', 'Data penelitian DTPS melibatkan mahasiswa berhasil dihapus');
    }

    public function approvePenelitianDTPSMelibatkanMahasiswa($id)
    {
        $this->penelitianDTPSMelibatkanMahasiswa->find($id)->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Berhasil menyetujui data penelitian DTPS melibatkan mahasiswa"]);
        return redirect()->route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa')->with('success', 'Data penelitian DTPS melibatkan mahasiswa berhasil disetujui');
    }

    public function rejectPenelitianDTPSMelibatkanMahasiswa($id)
    {
        $this->penelitianDTPSMelibatkanMahasiswa->find($id)->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Berhasil menolak data penelitian DTPS melibatkan mahasiswa"]);
        return redirect()->route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa')->with('success', 'Data penelitian DTPS melibatkan mahasiswa berhasil ditolak');
    }
}
