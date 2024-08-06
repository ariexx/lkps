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
        return redirect()->route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil ditambahkan');
    }

    public function showKerjasamaPendidikan()
    {
        $data = $this->kerjasamaPendidikan->get();

        return view('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan', compact('data'));
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
        return redirect()->route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil diperbarui');
    }

    public function approveFileKerjasamaPendidikan($id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);
        $data->update(['is_approved' => true]);

        return redirect()->route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil disetujui');
    }

    public function deleteKerjasamaPendidikan($id)
    {
        $data = $this->kerjasamaPendidikan->findOrFail($id);
        $this->fileUploadService->deleteFile($data->bukti_kerjasama);
        $data->delete();

        return redirect()->route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan')->with('success', 'Data kerjasama pendidikan berhasil dihapus');
    }
}
