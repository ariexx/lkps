@extends("adminlte::page")

@section("title", "Create PKM DTPS Melibatkan Mahasiswa")

@section("content_header")
    <h1>Create PKM DTPS Melibatkan Mahasiswa</h1>
@stop

@section("content")
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <x-adminlte-card>
        <form action="{{ auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.pkm-dtps.store') : route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
            </div>
            <div class="form-group">
                <label for="tema_pkm">Tema PKM</label>
                <input type="text" class="form-control" id="tema_pkm" name="tema_pkm" required>
            </div>
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <textarea class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required></textarea>
            </div>
            <div class="form-group">
                <label for="judul_kegiatan">Judul Kegiatan</label>
                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" required>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" id="tahun" name="tahun" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="*/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
