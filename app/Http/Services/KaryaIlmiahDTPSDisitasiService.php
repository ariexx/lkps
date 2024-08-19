<?php

namespace App\Http\Services;

use App\Models\KaryaIlmiahDTPSDisitasi;

class KaryaIlmiahDTPSDisitasiService
{
    public function __construct(
        public KaryaIlmiahDTPSDisitasi $karyaIlmiahDTPSDisitasi,
        public LogActivityService $logActivityService,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function showKaryaIlmiahDTPSDisitasi()
    {
        $data = $this->karyaIlmiahDTPSDisitasi->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->nama,
                $item->judul_artikel,
                $item->jumlah_sitasi,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama Dosen',
            'Judul Artikel',
            'Jumlah Sitasi',
            'Bukti',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data
        ];

        return view('karya-ilmiah-disitasi.index', compact('config'));
    }

    public function createKaryaIlmiahDTPSDisitasi()
    {
        return view('karya-ilmiah-disitasi.create');
    }

    public function storeKaryaIlmiahDTPSDisitasi(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $data['is_approve'] = STATUS_PENDING;
        $data['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'karya-ilmiah-dtps-disitasi');
        $this->karyaIlmiahDTPSDisitasi->create($data);
        $this->logActivityService->log(["tambah", "Karya Ilmiah DTPS Disitasi $request->nama"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi')->with('success', 'Berhasil menambahkan data karya ilmiah DTPS disitasi');
    }

    public function editKaryaIlmiahDTPSDisitasi($id)
    {
        $data = $this->karyaIlmiahDTPSDisitasi->find($id);
        return view('karya-ilmiah-disitasi.edit', compact('data'));
    }

    public function updateKaryaIlmiahDTPSDisitasi(\Illuminate\Http\Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'karya-ilmiah-dtps-disitasi');
        }
        $this->karyaIlmiahDTPSDisitasi->find($id)->update($data);
        $this->logActivityService->log(["ubah", "Karya Ilmiah DTPS Disitasi $request->nama"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi')->with('success', 'Berhasil mengubah data karya ilmiah DTPS disitasi');
    }

    public function deleteKaryaIlmiahDTPSDisitasi($id)
    {
        $data = $this->karyaIlmiahDTPSDisitasi->find($id);
        $this->karyaIlmiahDTPSDisitasi->find($id)->delete();
        $this->logActivityService->log(["hapus", "Karya Ilmiah DTPS Disitasi $data->nama"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi')->with('success', 'Berhasil menghapus data karya ilmiah DTPS disitasi');
    }

    public function approveKaryaIlmiahDTPSDisitasi($id)
    {
        $data = $this->karyaIlmiahDTPSDisitasi->find($id);
        $data->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Karya Ilmiah DTPS Disitasi $data->nama"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi')->with('success', 'Berhasil menyetujui data karya ilmiah DTPS disitasi');
    }

    public function rejectKaryaIlmiahDTPSDisitasi($id)
    {
        $data = $this->karyaIlmiahDTPSDisitasi->find($id);
        $data->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["menolak", "Karya Ilmiah DTPS Disitasi $data->nama"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi')->with('success', 'Berhasil menolak data karya ilmiah DTPS disitasi');
    }
}
