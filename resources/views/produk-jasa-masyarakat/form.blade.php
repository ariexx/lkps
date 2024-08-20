@extends("adminlte::page")

@section("title", isset($produk) ? "Edit Produk Jasa Masyarakat" : "Create Produk Jasa Masyarakat")

@section("content_header")
    <h1>{{ isset($produk) ? "Edit Produk Jasa Masyarakat" : "Create Produk Jasa Masyarakat" }}</h1>
@stop

@section("content")
    @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <x-adminlte-card>
        <form action="{{ isset($produk) ? (auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi.update', $produk->id) : route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.update', $produk->id)) : (auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi.store') : route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.store')) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($produk))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $produk->nama ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control-file" id="bukti" name="bukti" {{ isset($produk) ? '' : 'required' }}>
                @if(isset($produk) && $produk->bukti)
                    <p>Current file: <a href="{{ asset('storage/' . $produk->bukti) }}" target="_blank">{{ $produk->bukti }}</a></p>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($produk) ? 'Update' : 'Create' }}</button>
        </form>
    </x-adminlte-card>
@endsection
