<?php

namespace App\Http\Services\Tridharma;

use App\Http\Services\FileUploadService;
use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;

class PendidikanService
{
    public function __construct(
        public KerjasamaPendidikan $kerjasamaPendidikan,
        private FileUploadService $fileUploadService
    )
    {
    }

    public function createKerjasamaPendidikan()
    {
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.create-kerjasama-pendidikan');
    }

    /**
     * @throws \Exception
     */
    public function storeKerjasamaPendidikan(Request $request)
    {
        $validated = $request->validate([
            'lembaga_mitra' => 'required',
            'internasional' => 'required',
            'nasional' => 'required',
            'lokal' => 'required',
            'judul_kegiatan' => 'required',
            'manfaat_ps_diakreditasi' => 'required',
            'waktu_dan_durasi' => 'required',
            'tahun_berakhir_kerjasama' => 'required',
            'bukti_kerjasama' => 'sometimes|image'
        ]);

        if ($request->hasFile('bukti_kerjasama')) {
            $validated['bukti_kerjasama'] = $this->fileUploadService->uploadFile($request, 'bukti_kerjasama', 'kerjasama-pendidikan');
        }

        $this->kerjasamaPendidikan->create($validated);
        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil ditambahkan');
    }

    public function showKerjasamaPendidikan()
    {
        $data = $this->kerjasamaPendidikan->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->lembaga_mitra,
                is_approved_bool($item->internasional),
                is_approved_bool($item->nasional),
                is_approved_bool($item->lokal),
                $item->judul_kegiatan,
                $item->manfaat_ps_diakreditasi,
                $item->waktu_dan_durasi,
                $item->tahun_berakhir_kerjasama,
                "<a href='" . asset('storage/' . $item->bukti_kerjasama) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approved),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.delete', $item->id),
                    'isApproved' => $item->is_approved,
                    "routeApprove" => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.approve', $item->id),
                    "routeReject" => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.reject', $item->id),
                ])->render()
            ];
        });

        $heads = [
            'No',
            'Lembaga Mitra',
            'Internasional',
            'Nasional',
            'Lokal',
            'Judul Kegiatan Kerjasama',
            'Manfaat Bagi PS Diakreditasi',
            'Waktu dan Durasi',
            'Tahun Berakhir Kerjasama',
            'Bukti Kerjasama',
            'Status',
            'Aksi'
        ];

        $config = [
            'data' => $data,
            'heads' => $heads
        ];

        return view('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan', compact('config'));
    }

    public function editKerjasamaPendidikan($id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);

        return view('superadmin.tata-pamong-tata-kelola-kerjasama.edit-kerjasama-pendidikan', compact('data'));
    }

    public function updateKerjasamaPendidikan(Request $request, $id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);
        $validated = $request->validate([
            'lembaga_mitra' => 'required',
            'internasional' => 'required',
            'nasional' => 'required',
            'lokal' => 'required',
            'judul_kegiatan' => 'required',
            'manfaat_ps_diakreditasi' => 'required',
            'waktu_dan_durasi' => 'required',
            'tahun_berakhir_kerjasama' => 'required',
            'bukti_kerjasama' => 'sometimes|image'
        ]);

        if ($request->hasFile('bukti_kerjasama')) {
            $this->fileUploadService->deleteFile($data->bukti_kerjasama);
            $validated['bukti_kerjasama'] = $this->fileUploadService->uploadFile($request, 'bukti_kerjasama', 'kerjasama-pendidikan');
        }

        $data->update($validated);
        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil diperbarui');
    }

    public function approveFileKerjasamaPendidikan($id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);
        $data->update(['is_approved' => STATUS_APPROVED]);

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil disetujui');
    }

    public function deleteKerjasamaPendidikan($id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);
        $this->fileUploadService->deleteFile($data->bukti_kerjasama);
        $data->delete();

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil dihapus');
    }

    public function rejectFileKerjasamaPendidikan($id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);
        $data->update(['is_approved' => STATUS_REJECTED]);

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil ditolak');
    }
}
