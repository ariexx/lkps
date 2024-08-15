<?php

namespace App\Http\Services;

use App\Models\DosenTidakTetap;

class DosenTidakTetapService
{
    public function __construct
    (
        public DosenTidakTetap $dosenTidakTetap,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showDosenTidakTetap()
    {
        $data = $this->dosenTidakTetap->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama,
                $item->nidn,
                $item->pendidikan_terakhir,
                $item->bidang_keahlian,
                $item->jabatan,
                $item->sertifikat_pendidik,
                $item->sertifikat_kompetensi,
                $item->mata_kuliah,
                is_approved_bool($item->kesesuaian_bidang),
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'NIDN',
            'Pendidikan Terakhir',
            'Bidang Keahlian',
            'Jabatan',
            'Sertifikat Pendidik',
            'Sertifikat Kompetensi',
            'Mata Kuliah',
            'Kesesuaian Bidang',
            'Status',
            'Aksi'
        ];

        $config = [
            'data' => $data,
            'heads' => $heads
        ];

        return view('kepala-prodi.dosen-tidak-tetap.index', compact('config'));
    }

    public function createDosenTidakTetap()
    {
        return view('kepala-prodi.dosen-tidak-tetap.create');
    }

    public function storeDosenTidakTetap(array $all)
    {
        \DB::beginTransaction();
        try {
            $all['user_id'] = user()->id;
            $this->dosenTidakTetap->create($all);
            $this->logActivityService->log(["tambah", "Menambahkan data dosen tidak tetap : $all[nama]"]);
            \DB::commit();
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap')->with('success', 'Data berhasil ditambahkan');
        }catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal ditambahkan : ' . $e->getMessage());
        }
    }

    public function editDosenTidakTetap($id)
    {
        $data = $this->dosenTidakTetap->findOrFail($id);
        return view('kepala-prodi.dosen-tidak-tetap.edit', compact('data'));
    }

    public function updateDosenTidakTetap(array $all, $id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenTidakTetap->findOrFail($id)->update($all);
            $this->logActivityService->log(["edit", "Mengedit data dosen tidak tetap : $all[nama]"]);
            \DB::commit();
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap')->with('success', 'Data berhasil diubah');
        }catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal diubah : ' . $e->getMessage());
        }
    }

    public function deleteDosenTidakTetap($id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenTidakTetap->findOrFail($id)->delete();
            $this->logActivityService->log(["hapus", "Menghapus data dosen tidak tetap"]);
            \DB::commit();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        }catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal dihapus : ' . $e->getMessage());
        }
    }

    public function approveDosenTidakTetap($id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenTidakTetap->findOrFail($id)->update(['is_approve' => STATUS_APPROVED]);
            $this->logActivityService->log(["approve", "Menyetujui data dosen tidak tetap " . $this->dosenTidakTetap->findOrFail($id)->nama]);
            \DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disetujui');
        }catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal disetujui : ' . $e->getMessage());
        }
    }

    public function rejectDosenTidakTetap($id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenTidakTetap->findOrFail($id)->update(['is_approve' => STATUS_REJECTED]);
            $this->logActivityService->log(["reject", "Menolak data dosen tidak tetap " . $this->dosenTidakTetap->findOrFail($id)->nama]);
            \DB::commit();
            return redirect()->back()->with('success', 'Data berhasil ditolak');
        }catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal ditolak : ' . $e->getMessage());
        }
    }
}
