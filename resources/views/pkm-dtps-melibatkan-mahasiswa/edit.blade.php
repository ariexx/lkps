@extends("adminlte::page")

@section("title", "Edit PKM DTPS Melibatkan Mahasiswa")

@section("content_header")
    <h1>Edit PKM DTPS Melibatkan Mahasiswa</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.pkm-dtps.update', $data->id) : route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="{{ $data->nama_dosen }}" required>
            </div>
            <div class="form-group">
                <label for="tema_pkm">Tema PKM</label>
                <input type="text" class="form-control" id="tema_pkm" name="tema_pkm" value="{{ $data->tema_pkm }}" required>
            </div>
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <textarea class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required>{{ $data->nama_mahasiswa }}</textarea>
            </div>
            <div class="form-group">
                <label for="judul_kegiatan">Judul Kegiatan</label>
                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" value="{{ $data->judul_kegiatan }}" required>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $data->tahun }}" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="*/*">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
