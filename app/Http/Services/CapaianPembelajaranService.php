<?php

namespace App\Http\Services;

use App\Models\CapaianPembelajaran;

class CapaianPembelajaranService
{
    public function __construct(
        public CapaianPembelajaran $capaianPembelajaran,
        public FileUploadService $fileUploadService,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showKurikulumCapaianPembelajaranDanRencanaPembelajaran()
    {
        $data = $this->capaianPembelajaran->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->semester,
                $item->kode,
                $item->mata_kuliah,
                $item->is_kompetensi ? 'Yes' : 'No',
                $item->kuliah_responsi,
                $item->seminar,
                $item->praktikum,
                (int) ((($item->kuliah_responsi * 150) * 14) / 60),
                is_approved_bool($item->sikap),
                is_approved_bool($item->pengetahuan),
                is_approved_bool($item->keterampilan_umum),
                is_approved_bool($item->keterampilan_khusus),
                "<a href='" . asset('storage/' . $item->dokumen_rencana) . "' target='_blank'>Download</a>",
                $item->unit_penyelenggara,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.approve', $item->id),
                    "routeReject" => route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Semester',
            'Kode Mata Kuliah',
            'Nama Mata Kuliah',
            'Mata Kuliah Kompetensi',
            'Kuliah / Responsi / Tutorial',
            'Seminar',
            'Praktikum / Praktik / Praktik Lapangan',
            'Konversi Kredit ke Jam', // (kuliah responsi * 150) * 14) / 60
            'Sikap',
            'Pengetahuan',
            'Keterampilan Umum',
            'Keterampilan Khusus',
            'Dokumen Rencana Pembelajaran', // file
            'Unit Penyelenggara',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view("kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.index", compact('config'));
    }

    public function createKurikulumCapaianPembelajaranDanRencanaPembelajaran()
    {
        return view("kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.create");
    }

    public function storeKurikulumCapaianPembelajaranDanRencanaPembelajaran(\Illuminate\Http\Request $request)
    {
        $all = $request->all();
        if ($request->hasFile('dokumen_rencana')) {
            $all['dokumen_rencana'] = $this->fileUploadService->uploadFile($request, 'dokumen_rencana', 'kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran');
        }

        $this->capaianPembelajaran->create($all);
        $this->logActivityService->log(["tambah", "Berhasil menambahkan data capaian pembelajaran $request[mata_kuliah]"]);
        return redirect()->route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran')->with('success', 'Berhasil menambahkan data capaian pembelajaran');
    }

    public function editKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        $data = $this->capaianPembelajaran->find($id);
        return view('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.edit', compact('data'));
    }

    public function updateKurikulumCapaianPembelajaranDanRencanaPembelajaran(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->capaianPembelajaran->find($id);

        if ($request->hasFile('dokumen_rencana')) {
            $request['dokumen_rencana'] = $this->fileUploadService->uploadFile($request, 'dokumen_rencana', 'kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran');
        }

        $data->update($request->all());
        $this->logActivityService->log(["ubah", "Berhasil mengubah data capaian pembelajaran $data[mata_kuliah]"]);
        return redirect()->route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran')->with('success', 'Berhasil mengubah data capaian pembelajaran');
    }

    public function deleteKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        try {
            $data = $this->capaianPembelajaran->find($id);
            $this->fileUploadService->deleteFile($data->dokumen_rencana);
            $data->delete();
            $this->logActivityService->log(["hapus", "Berhasil menghapus data capaian pembelajaran $data[mata_kuliah]"]);
            return redirect()->route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran')->with('success', 'Berhasil menghapus data capaian pembelajaran');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran')->with('error', 'Gagal menghapus data capaian pembelajaran');
        }
    }

    public function approveKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        $data = $this->capaianPembelajaran->find($id);
        $data->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Berhasil menyetujui data capaian pembelajaran $data[mata_kuliah]"]);
        return redirect()->route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran')->with('success', 'Berhasil menyetujui data capaian pembelajaran');
    }

    public function rejectKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        $data = $this->capaianPembelajaran->find($id);
        $data->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Berhasil menolak data capaian pembelajaran $data[mata_kuliah]"]);
        return redirect()->route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran')->with('success', 'Berhasil menolak data capaian pembelajaran');
    }
}
