<?php

namespace App\Http\Services;

use App\Models\DosenPembimbing;

class DosenPembimbingUtamaTugasAkhirService
{
    public function __construct(public DosenPembimbing $dosenPembimbing, public LogActivityService $logActivityService)
    {
    }

    public function showDosenPembimbingUtamaTugasAkhir()
    {
        $data = $this->dosenPembimbing->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->name,
                $item->jumlah_mahasiswa_dibimbing_ts,
                $item->jumlah_mahasiswa_dibimbing_ts1,
                $item->jumlah_mahasiswa_dibimbing_ts2,
                $item->rata_rata_mahasiswa,
                $item->jumlah_mahasiswa_dibimbing_ts_lain,
                $item->jumlah_mahasiswa_dibimbing_ts1_lain,
                $item->jumlah_mahasiswa_dibimbing_ts2_lain,
                $item->rata_rata_mahasiswa_lain,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'Jumlah Mahasiswa Dibimbing TS',
            'Jumlah Mahasiswa Dibimbing TS1',
            'Jumlah Mahasiswa Dibimbing TS2',
            'Rata-Rata Mahasiswa',
            'Jumlah Mahasiswa Dibimbing TS Lain',
            'Jumlah Mahasiswa Dibimbing TS1 Lain',
            'Jumlah Mahasiswa Dibimbing TS2 Lain',
            'Rata-Rata Mahasiswa Lain',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data,
        ];

        return view("kepala-prodi.dosen-pembimbing-utama.index", compact("config"));
    }

    public function createDosenPembimbingUtamaTugasAkhir()
    {
        return view("kepala-prodi.dosen-pembimbing-utama.create");
    }

    public function storeDosenPembimbingUtamaTugasAkhir(array $all)
    {
        \DB::beginTransaction();
        try {
            $all['user_id'] = auth()->id();
            $this->dosenPembimbing->create($all);
            $this->logActivityService->log(["tambah", "Menambahkan data dosen pembimbing utama tugas akhir"]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir")->with("success", "Data berhasil ditambahkan");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Data gagal ditambahkan");
        }
    }

    public function updateDosenPembimbingUtamaTugasAkhir(array $all, $id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenPembimbing->find($id)->update($all);
            $this->logActivityService->log(["edit", "Mengedit data dosen pembimbing utama tugas akhir"]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir")->with("success", "Data berhasil diubah");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Data gagal diubah");
        }
    }

    public function deleteDosenPembimbingUtamaTugasAkhir($id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenPembimbing->find($id)->delete();
            $this->logActivityService->log(["hapus", "Menghapus data dosen pembimbing utama tugas akhir"]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir")->with("success", "Data berhasil dihapus");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Data gagal dihapus");
        }
    }

    public function approveDosenPembimbingUtamaTugasAkhir($id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenPembimbing->find($id)->update(["is_approve" => STATUS_APPROVED]);
            $this->logActivityService->log(["approve", "Menyetujui data dosen pembimbing utama tugas akhir"]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir")->with("success", "Data berhasil disetujui");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Data gagal disetujui");
        }
    }

    public function rejectDosenPembimbingUtamaTugasAkhir($id)
    {
        \DB::beginTransaction();
        try {
            $this->dosenPembimbing->find($id)->update(["is_approve" => STATUS_REJECTED]);
            $this->logActivityService->log(["reject", "Menolak data dosen pembimbing utama tugas akhir"]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir")->with("success", "Data berhasil ditolak");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Data gagal ditolak");
        }
    }

    public function editDosenPembimbingUtamaTugasAkhir($id)
    {
        try {
            $data = $this->dosenPembimbing->find($id);
            return view("kepala-prodi.dosen-pembimbing-utama.edit", compact("data"));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Data tidak ditemukan");
        }
    }

}
