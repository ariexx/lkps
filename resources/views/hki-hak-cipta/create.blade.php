@extends("adminlte::page")

@section("title", "Create HKI Hak Cipta")

@section("content_header")
    <h1>Create HKI Hak Cipta</h1>
@stop

@section("content")
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="luaran_dan_pkm">Luaran dan PKM</label>
                <input type="text" class="form-control" id="luaran_dan_pkm" name="luaran_dan_pkm" required>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
