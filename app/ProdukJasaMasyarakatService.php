<?php

namespace App;

use App\Http\Services\FileUploadService;
use App\Http\Services\LogActivityService;
use App\Models\ProdukJasaMasyarakat;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukJasaMasyarakatService
{
    public function __construct(
        public ProdukJasaMasyarakat $produkJasaMasyarakat,
        public FileUploadService $fileUpload,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showProdukJasaMasyarakat()
    {
        $data = $this->produkJasaMasyarakat->get()->when(auth()->user()->role == 'dosen', function ($query) {
            $query->where('user_id', auth()->id());
        })->
        map(function ($item, $key) {
           return [
               $key + 1,
                $item->nama,
                $item->nama_produk,
                $item->deskripsi,
                "<a href='".asset('storage/'.$item->bukti)."'>Download</a>",
                is_approved($item->is_approve),
               view('components.buttons', [
                   'routeEdit' => auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi.edit', $item->id) : route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.edit', $item->id),
                   'routeReject' => route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.reject', $item->id),
                   'isApproved' => $item->is_approve,
                   'routeApprove' => route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.approve', $item->id),
                   'routeDelete' => auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi.delete', $item->id) : route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.delete', $item->id),               ])->render()
           ] ;
        })->toArray();

        $heads = [
            '#',
            'Nama',
            'Nama Produk',
            'Deskripsi',
            'Bukti',
            'Status',
            'Action'
        ];

        $config = [
            'heads' => $heads,
            'data' => $data,
            'title' => 'Produk Jasa Masyarakat',
            'breadcrumb' => 'Produk Jasa Masyarakat'
        ];

        return view('produk-jasa-masyarakat.index', compact('config'));
    }

    public function createProdukJasaMasyarakat()
    {
        return view('produk-jasa-masyarakat.form');
    }

    public function storeProdukJasaMasyarakat(\Illuminate\Http\Request $request)
    {
        try {
            $file = $this->fileUpload->uploadFile($request, 'bukti', 'produk-jasa-masyarakat');
            $this->produkJasaMasyarakat->create(array_merge($request->all(), ['bukti' => $file]));
            $this->logActivityService->log(["tambah", "Berhasil menambah produk jasa masyarakat : $request->nama_produk"]);
            if (auth()->user()->role == User::dosen) {
                return redirect()->route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi')->with('success', 'Produk Jasa Masyarakat berhasil ditambahkan');
            }
            return redirect()->route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat')->with('success', 'Produk Jasa Masyarakat berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editProdukJasaMasyarakat($id)
    {
        $produk = $this->produkJasaMasyarakat->findOrFail($id);
        return view('produk-jasa-masyarakat.form', compact('produk'));
    }

    public function updateProdukJasaMasyarakat(Request $request, $id)
    {
        try {
            $produk = $this->produkJasaMasyarakat->findOrFail($id);
            $file = $this->fileUpload->uploadFile($request, 'bukti', 'produk-jasa-masyarakat');
            $produk->update(array_merge($request->all(), ['bukti' => $file]));
            $this->logActivityService->log(["edit", "Berhasil mengubah produk jasa masyarakat : $request->nama_produk"]);
            if (auth()->user()->role == User::dosen) {
                return redirect()->route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi')->with('success', 'Produk Jasa Masyarakat berhasil diubah');
            }
            return redirect()->route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat')->with('success', 'Produk Jasa Masyarakat berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteProdukJasaMasyarakat($id)
    {
        try {
            $produk = $this->produkJasaMasyarakat->findOrFail($id);
            $produk->delete();
            $this->logActivityService->log(["hapus", "Berhasil menghapus produk jasa masyarakat : $produk->nama_produk"]);
            if (auth()->user()->role == User::dosen) {
                return redirect()->route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi')->with('success', 'Produk Jasa Masyarakat berhasil dihapus');
            }
            return redirect()->route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat')->with('success', 'Produk Jasa Masyarakat berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function approveProdukJasaMasyarakat($id)
    {
        try {
            $produk = $this->produkJasaMasyarakat->findOrFail($id);
            $produk->update(['is_approve' => STATUS_APPROVED]);
            $this->logActivityService->log(["approve", "Berhasil menyetujui produk jasa masyarakat : $produk->nama_produk"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat')->with('success', 'Produk Jasa Masyarakat berhasil disetujui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function rejectProdukJasaMasyarakat($id)
    {
        try {
            $produk = $this->produkJasaMasyarakat->findOrFail($id);
            $produk->update(['is_approve' => STATUS_REJECTED]);
            $this->logActivityService->log(["reject", "Berhasil menolak produk jasa masyarakat : $produk->nama_produk"]);
            return redirect()->route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat')->with('success', 'Produk Jasa Masyarakat berhasil ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
