@extends("adminlte::page")

@section("title", "Edit Integrasi Kegiatan Penelitian")

@section("content_header")
    <h1>Edit Integrasi Kegiatan Penelitian</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('integrasi-kegiatan-penelitian.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $data->judul }}" required>
            </div>
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="{{ $data->nama_dosen }}" required>
            </div>
            <div class="form-group">
                <label for="mata_kuliah">Mata Kuliah</label>
                <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" value="{{ $data->mata_kuliah }}" required>
            </div>
            <div class="form-group">
                <label for="bentuk_integrasi">Bentuk Integrasi</label>
                <input type="text" class="form-control" id="bentuk_integrasi" name="bentuk_integrasi" value="{{ $data->bentuk_integrasi }}" required>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $data->tahun }}" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="*/*">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
