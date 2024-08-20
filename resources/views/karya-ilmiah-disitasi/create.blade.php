@extends("adminlte::page")

@section("title", "Create Karya Ilmiah Disitasi")

@section("content_header")
    <h1>Create Karya Ilmiah Disitasi</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.karya-ilmiah-dtps-disitasi.store') : route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="judul_artikel">Judul Artikel</label>
                <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" required>
            </div>
            <div class="form-group">
                <label for="jumlah_sitasi">Jumlah Sitasi</label>
                <input type="number" class="form-control" id="jumlah_sitasi" name="jumlah_sitasi" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
