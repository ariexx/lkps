@extends("adminlte::page")

@section("title", "Rekognisi Dosen")

@section("content_header")
    <h1>Rekognisi Dosen</h1>
@stop

@section("content")
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="bidang">Bidang</label>
                <input type="text" class="form-control" id="bidang" name="bidang" required>
            </div>
            <div class="form-group">
                <label for="rekognisi">Rekognisi</label>
                <input type="text" class="form-control" id="rekognisi" name="rekognisi" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="internasional">Internasional</label>
                <div>
                    <label>
                        <input type="radio" name="internasional" value="1"> Yes
                    </label>
                    <label>
                        <input type="radio" name="internasional" value="0"> No
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun (YYYY)</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required pattern="\d{4}" maxlength="4">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
