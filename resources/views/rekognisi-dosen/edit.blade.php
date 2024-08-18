@extends("adminlte::page")

@section("title", "Edit Rekognisi Dosen")

@section("content_header")
    <h1>Edit Rekognisi Dosen</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}" required>
            </div>
            <div class="form-group">
                <label for="bidang">Bidang</label>
                <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $data->bidang }}" required>
            </div>
            <div class="form-group">
                <label for="rekognisi">Rekognisi</label>
                <input type="text" class="form-control" id="rekognisi" name="rekognisi" value="{{ $data->rekognisi }}" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*">
            </div>
            <div class="form-group">
                <label for="internasional">Internasional</label>
                <div>
                    <label>
                        <input type="radio" name="internasional" value="1" {{ $data->internasional ? 'checked' : '' }}> Yes
                    </label>
                    <label>
                        <input type="radio" name="internasional" value="0" {{ !$data->internasional ? 'checked' : '' }}> No
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun (YYYY)</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $data->tahun }}" required pattern="\d{4}" maxlength="4">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
