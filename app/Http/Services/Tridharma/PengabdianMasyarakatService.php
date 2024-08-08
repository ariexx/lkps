<?php

namespace App\Http\Services\Tridharma;

use App\Http\Services\FileUploadService;
use Illuminate\Http\Request;

class PengabdianMasyarakatService
{
    public function __construct(
        public \App\Models\PengabdianMasyarakat $pengabdianMasyarakat,
        public FileUploadService $fileUploadService
    )
    {

    }

    public function createPengabdianMasyarakat()
    {
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.create-pengabdian-masyarakat');
    }

    public function storePengabdianMasyarakat(Request $request)
    {
        $validated = $request->validate([
            'lembaga' => 'required',
            'internasional' => 'required',
            'nasional' => 'required',
            'lokal' => 'required',
            'judul' => 'required',
            'manfaat' => 'required',
            'waktu' => 'required',
            'tahun_berakhir_kerjasama' => 'required',
            'bukti' => 'sometimes|image'
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'kerjasama-pengabdian-masyarakat');
        }

        $validated['is_approved'] = STATUS_PENDING;
        $this->pengabdianMasyarakat->create($validated);
        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat')->with('success', 'Data kerjasama pengabdian masyarakat berhasil ditambahkan');
    }

    public function showPengabdianMasyarakat()
    {
        $data = $this->pengabdianMasyarakat->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->lembaga,
                is_approved_bool($item->internasional),
                is_approved_bool($item->nasional),
                is_approved_bool($item->lokal),
                $item->judul,
                $item->manfaat,
                $item->waktu,
                $item->tahun_berakhir_kerjasama,
                "<a href='" . asset('storage/' . $item->bukti) . "' target='_blank'>Lihat Bukti</a>",
                is_approved($item->is_approved),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat.delete', $item->id),
                    'routeApprove' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat.approve', $item->id),
                    'routeReject' => route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat.reject', $item->id),
                    'isApproved' => $item->is_approved
                ])->render()
            ];
        })->toArray();

        $heads = [
            "No",
            "Lembaga Mitra",
            "Internasional",
            "Nasional",
            "Lokal",
            "Judul Kegiatan",
            "Manfaat PS Diakreditasi",
            "Waktu dan Durasi",
            "Tahun Berakhir Kerjasama",
            "Bukti Kerjasama",
            "Status",
            "Aksi"
        ];

        $config = [
            "heads" => $heads,
            "data" => $data,
        ];

        return view('superadmin.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat', compact('config', 'heads'));
    }

    public function approveFilePengabdianMasyarakat($id)
    {
        $data = $this->pengabdianMasyarakat->findOrFail($id);
        $data->update(['is_approved' => STATUS_APPROVED]);

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat')->with('success', 'Data kerjasama pengabdian masyarakat berhasil disetujui');
    }

    public function rejectFilePengabdianMasyarakat($id)
    {
        $data = $this->pengabdianMasyarakat->findOrFail($id);
        $data->update(['is_approved' => STATUS_REJECTED]);

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat')->with('success', 'Data kerjasama pengabdian masyarakat berhasil ditolak');
    }

    public function deletePengabdianMasyarakat($id)
    {
        $data = $this->pengabdianMasyarakat->findOrFail($id);
        $this->fileUploadService->deleteFile($data->bukti);
        $data->delete();

        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat')->with('success', 'Data kerjasama pengabdian masyarakat berhasil dihapus');
    }

    public function editPengabdianMasyarakat($id)
    {
        $data = $this->pengabdianMasyarakat->findOrFail($id);
        return view('superadmin.tata-pamong-tata-kelola-kerjasama.edit-pengabdian-masyarakat', compact('data'));
    }

    public function updatePengabdianMasyarakat(Request $request, $id)
    {
        $data = $request->validate([
            'lembaga' => 'required',
            'internasional' => 'required',
            'nasional' => 'required',
            'lokal' => 'required',
            'judul' => 'required',
            'manfaat' => 'required',
            'waktu' => 'required',
            'tahun_berakhir_kerjasama' => 'required',
            'bukti' => 'sometimes|image'
        ]);

        if ($request->hasFile('bukti')) {
            $oldFile = $this->pengabdianMasyarakat->findOrFail($id)->bukti;
            if ($oldFile) {
                $this->fileUploadService->deleteFile($oldFile);
            }
            $data['bukti'] = $this->fileUploadService->uploadFile($request, 'bukti', 'kerjasama-pengabdian-masyarakat');
        }

        $this->pengabdianMasyarakat->findOrFail($id)->update($data);
        return redirect()->route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat')->with('success', 'Data kerjasama pengabdian masyarakat berhasil diupdate');
    }
}
