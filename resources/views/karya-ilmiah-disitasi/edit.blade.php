@extends("adminlte::page")

@section("title", "Edit Karya Ilmiah Disitasi")

@section("content_header")
    <h1>Edit Karya Ilmiah Disitasi</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.karya-ilmiah-dtps-disitasi.update', $data->id) : route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}" required>
            </div>
            <div class="form-group">
                <label for="judul_artikel">Judul Artikel</label>
                <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="{{ $data->judul_artikel }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_sitasi">Jumlah Sitasi</label>
                <input type="number" class="form-control" id="jumlah_sitasi" name="jumlah_sitasi" value="{{ $data->jumlah_sitasi }}" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti">
                <p>Current file: <a href="{{ asset('storage/' . $data->bukti) }}" target="_blank">View</a></p>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
