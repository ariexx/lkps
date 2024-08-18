<?php

namespace App\Http\Services;

use App\Models\DosenIndustriPraktisi;

class DosenIndustriPraktisiService
{
    public function __construct
    (
        public DosenIndustriPraktisi $dosenIndustriPraktisi,
        public LogActivityService $log,
    )
    {
    }

    public function showDosenIndustriPraktisi()
    {
        $data = $this->dosenIndustriPraktisi->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama,
                $item->nidn,
                $item->perusahaan,
                $item->pendidikan_terakhir,
                $item->bidang_keahlian,
                $item->sertifikat_kompetensi,
                $item->mata_kuliah,
                $item->bobot_kredit,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'NIDN',
            'Perusahaan',
            'Pendidikan Terakhir',
            'Bidang Keahlian',
            'Sertifikat Kompetensi',
            'Mata Kuliah',
            'Bobot Kredit',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view("dosen-industri.index", compact('config'));
    }

    public function createDosenIndustriPraktisi()
    {
        return view('dosen-industri.create');
    }

    public function storeDosenIndustriPraktisi(array $all)
    {
        try {
            $all['user_id'] = auth()->id();
            $this->dosenIndustriPraktisi->create($all);
            $this->log->log(["tambah", "Berhasil menambahkan data dosen industri praktisi - nama : $all[nama]"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi')->with('success', 'Berhasil menambahkan data dosen industri praktisi');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data dosen industri praktisi');
        }
    }

    public function editDosenIndustriPraktisi($id)
    {
        $data = $this->dosenIndustriPraktisi->find($id);
        return view('dosen-industri.edit', compact('data'));
    }

    public function updateDosenIndustriPraktisi(array $all, $id)
    {
        try {
            $this->dosenIndustriPraktisi->find($id)->update($all);
            $this->log->log(["edit", "Berhasil mengubah data dosen industri praktisi - nama : $all[nama]"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi')->with('success', 'Berhasil mengubah data dosen industri praktisi');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data dosen industri praktisi');
        }
    }

    public function deleteDosenIndustriPraktisi($id)
    {
        try {
            $data = $this->dosenIndustriPraktisi->find($id);
            $data->delete();
            $this->log->log(["hapus", "Berhasil menghapus data dosen industri praktisi - nama : $data->nama"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi')->with('success', 'Berhasil menghapus data dosen industri praktisi');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data dosen industri praktisi');
        }
    }

    public function approveDosenIndustriPraktisi($id)
    {
        try {
            $data = $this->dosenIndustriPraktisi->find($id);
            $data->update(['is_approve' => STATUS_APPROVED]);
            $this->log->log(["approve", "Berhasil menyetujui data dosen industri praktisi - nama : $data->nama"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi')->with('success', 'Berhasil menyetujui data dosen industri praktisi');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui data dosen industri praktisi');
        }
    }

    public function rejectDosenIndustriPraktisi($id)
    {
        try {
            $data = $this->dosenIndustriPraktisi->find($id);
            $data->update(['is_approve' => STATUS_REJECTED]);
            $this->log->log(["reject", "Berhasil menolak data dosen industri praktisi - nama : $data->nama"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi')->with('success', 'Berhasil menolak data dosen industri praktisi');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak data dosen industri praktisi');
        }
    }

}

