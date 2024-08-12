<?php

namespace App\Http\Services\Mahasiswa;

use App\Http\Services\LogActivityService;
use App\Models\MahasiswaAsing;

class MahasiswaAsingService
{
    public function __construct(
        public MahasiswaAsing $mahasiswaAsing,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showMahasiswaAsing()
    {
        $data = $this->mahasiswaAsing->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->program_studi,
                $item->mahasiswa_aktif_ts2,
                $item->mahasiswa_aktif_ts1,
                $item->mahasiswa_aktif_ts,
                $item->mahasiswa_asing_full_time_ts2,
                $item->mahasiswa_asing_full_time_ts1,
                $item->mahasiswa_asing_full_time_ts,
                $item->mahasiswa_asing_part_time_ts2,
                $item->mahasiswa_asing_part_time_ts1,
                $item->mahasiswa_asing_part_time_ts,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.mahasiswa.mahasiswa-asing.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.mahasiswa.mahasiswa-asing.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.mahasiswa.mahasiswa-asing.approve', $item->id),
                    "routeReject" => route('kepala-prodi.mahasiswa.mahasiswa-asing.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Program Studi',
            'Mahasiswa Aktif TS2',
            'Mahasiswa Aktif TS1',
            'Mahasiswa Aktif TS',
            'Mahasiswa Asing Full Time TS2',
            'Mahasiswa Asing Full Time TS1',
            'Mahasiswa Asing Full Time TS',
            'Mahasiswa Asing Part Time TS2',
            'Mahasiswa Asing Part Time TS1',
            'Mahasiswa Asing Part Time TS',
            'Status',
            'Aksi'
        ];

        $config = [
            'data' => $data,
            'heads' => $heads
        ];

        return view('kepala-prodi.mahasiswa.mahasiswa-asing.index', compact('config'));
    }

    public function storeMahasiswaAsing(array $all)
    {
        try {
            $this->mahasiswaAsing->create($all);
            $this->logActivityService->log(["tambah", "Menambahkan data mahasiswa asing"]);
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('success', 'Data mahasiswa asing berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('error', 'Data mahasiswa asing gagal ditambahkan');
        }
    }

    public function editMahasiswaAsing($id)
    {
        try {
            $mahasiswaAsing = $this->mahasiswaAsing->find($id);
            return view('kepala-prodi.mahasiswa.mahasiswa-asing.edit', compact('mahasiswaAsing'));
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('error', 'Data mahasiswa asing tidak ditemukan');
        }
    }

    public function updateMahasiswaAsing(array $all, $id)
    {
        try {
            $this->mahasiswaAsing->find($id)->update($all);
            $this->logActivityService->log(["ubah", "Mengubah data mahasiswa asing dengan id $id - $all[program_studi]"]);
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('success', 'Data mahasiswa asing berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('error', 'Data mahasiswa asing gagal diupdate');
        }
    }

    public function deleteMahasiswaAsing($id)
    {
        try {
            $this->mahasiswaAsing->find($id)->delete();
            $this->logActivityService->log(["hapus", "Menghapus data mahasiswa asing dengan id $id"]);
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('success', 'Data mahasiswa asing berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('error', 'Data mahasiswa asing gagal dihapus');
        }
    }

    public function createMahasiswaAsing()
    {
        return view('kepala-prodi.mahasiswa.mahasiswa-asing.create');
    }

    public function approveMahasiswaAsing($id)
    {
        try {
            $this->mahasiswaAsing->find($id)->update(['is_approve' => STATUS_APPROVED]);
            $this->logActivityService->log(["approve", "Menyetujui data mahasiswa asing dengan id $id"]);
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('success', 'Data mahasiswa asing berhasil disetujui');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('error', 'Data mahasiswa asing gagal disetujui');
        }
    }

    public function rejectMahasiswaAsing($id)
    {
        try {
            $this->mahasiswaAsing->find($id)->update(['is_approve' => STATUS_REJECTED]);
            $this->logActivityService->log(["reject", "Menolak data mahasiswa asing dengan id $id"]);
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('success', 'Data mahasiswa asing berhasil ditolak');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.mahasiswa.mahasiswa-asing')->with('error', 'Data mahasiswa asing gagal ditolak');
        }
    }

}
