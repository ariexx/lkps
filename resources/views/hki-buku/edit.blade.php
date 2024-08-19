@extends("adminlte::page")

@section("title", "Edit HKI Buku")

@section("content_header")
    <h1>Edit HKI Buku</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="luaran_dan_pkm">Luaran dan PKM</label>
                <input type="text" class="form-control" id="luaran_dan_pkm" name="luaran_dan_pkm" value="{{ $data->luaran_dan_pkm }}" required>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $data->tahun }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $data->keterangan }}</textarea>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
