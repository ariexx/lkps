<?php

namespace App\Http\Services;

use App\Models\DosenTetapPerguruanTinggi;

class DosenTetapPerguruanTinggiService
{
    public function __construct(
        public DosenTetapPerguruanTinggi $model,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showDosenTetapPerguruanTinggi()
    {
        $data = $this->model->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama,
                $item->nidn,
                $item->pendidikan_magister,
                $item->pendidikan_doktor,
                $item->bidang_keahlian,
                is_approved_bool($item->kesesuaian),
                $item->jabatan_akademik,
                $item->sertifikat_pendidik,
                $item->sertifikat_kompetensi,
                $item->mata_kuliah_ps_diakreditasi,
                is_approved_bool($item->kesesuaian_bidang_keahlian),
                $item->mata_kuliah_ps_lain,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'NIDN',
            'Pendidikan Magister',
            'Pendidikan Doktor',
            'Bidang Keahlian',
            'Kesesuaian',
            'Jabatan Akademik',
            'Sertifikat Pendidik',
            'Sertifikat Kompetensi',
            'Mata Kuliah PS Diakreditasi',
            'Kesesuaian Bidang Keahlian',
            'Mata Kuliah PS Lain',
            'Status',
            'Aksi'
        ];

        $config = [
            'data' => $data,
            'heads' => $heads,
        ];

        return view('kepala-prodi.dosen-tetap-perguruan-tinggi.index', compact('config'));
    }

    public function storeDosenTetapPerguruanTinggi(array $all)
    {
        try {
            $all['user_id'] = auth()->id();
            $this->model->create($all);
            $this->logActivityService->log(["tambah", "Menambahkan data dosen tetap perguruan tinggi"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi')->with('success', 'Dosen Tetap Perguruan Tinggi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Dosen Tetap Perguruan Tinggi gagal ditambahkan');
        }
    }

    public function createDosenTetapPerguruanTinggi()
    {
        return view('kepala-prodi.dosen-tetap-perguruan-tinggi.create');
    }

    public function editDosenTetapPerguruanTinggi($id)
    {
        try {
            $dosenTetapPerguruanTinggi = $this->model->find($id);
            return view('kepala-prodi.dosen-tetap-perguruan-tinggi.edit', compact('dosenTetapPerguruanTinggi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Dosen Tetap Perguruan Tinggi tidak ditemukan');
        }
    }

    public function updateDosenTetapPerguruanTinggi($all, $id)
    {
        \DB::beginTransaction();
        try {
            $dosenTetapPerguruanTinggi = $this->model->find($id);
            $dosenTetapPerguruanTinggi->update($all);
            $this->logActivityService->log(["ubah", "Mengedit data dosen tetap perguruan tinggi"]);
            \DB::commit();
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi')->with('success', 'Dosen Tetap Perguruan Tinggi berhasil diubah');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Dosen Tetap Perguruan Tinggi gagal diubah');
        }
    }

    public function deleteDosenTetapPerguruanTinggi($id)
    {
        \DB::beginTransaction();
        try {
            $dosenTetapPerguruanTinggi = $this->model->find($id);
            $dosenTetapPerguruanTinggi->delete();
            $this->logActivityService->log(["hapus", "Menghapus data dosen tetap perguruan tinggi"]);
            \DB::commit();
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi')->with('success', 'Dosen Tetap Perguruan Tinggi berhasil dihapus');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Dosen Tetap Perguruan Tinggi gagal dihapus');
        }
    }

    public function approveDosenTetapPerguruanTinggi($id)
    {
        \DB::beginTransaction();
        try {
            $dosenTetapPerguruanTinggi = $this->model->find($id);
            $dosenTetapPerguruanTinggi->update(['is_approve' => STATUS_APPROVED]);
            $this->logActivityService->log(["approve", "Menyetujui data dosen tetap perguruan tinggi " . $dosenTetapPerguruanTinggi->nama]);
            \DB::commit();
            return redirect()->back()->with('success', 'Dosen Tetap Perguruan Tinggi berhasil disetujui');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Dosen Tetap Perguruan Tinggi gagal disetujui');
        }
    }

    public function rejectDosenTetapPerguruanTinggi($id)
    {
        \DB::beginTransaction();
        try {
            $dosenTetapPerguruanTinggi = $this->model->find($id);
            $dosenTetapPerguruanTinggi->update(['is_approve' => STATUS_REJECTED]);
            $this->logActivityService->log(["reject", "Menolak data dosen tetap perguruan tinggi " . $dosenTetapPerguruanTinggi->nama]);
            \DB::commit();
            return redirect()->back()->with('success', 'Dosen Tetap Perguruan Tinggi berhasil ditolak');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Dosen Tetap Perguruan Tinggi gagal ditolak');
        }
    }
}
