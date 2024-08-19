@extends("adminlte::page")

@section("title", "Edit Kepuasan Mahasiswa")

@section("content_header")
    <h1>Edit Kepuasan Mahasiswa</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.kepuasan-mahasiswa.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="aspek">Aspek</label>
                <input type="text" class="form-control" id="aspek" name="aspek" value="{{ $data->aspek }}" required>
            </div>
            <div class="form-group">
                <label for="sangat_baik">Sangat Baik</label>
                <input type="number" class="form-control" id="sangat_baik" name="sangat_baik" value="{{ $data->sangat_baik }}" required>
            </div>
            <div class="form-group">
                <label for="baik">Baik</label>
                <input type="number" class="form-control" id="baik" name="baik" value="{{ $data->baik }}" required>
            </div>
            <div class="form-group">
                <label for="cukup">Cukup</label>
                <input type="number" class="form-control" id="cukup" name="cukup" value="{{ $data->cukup }}" required>
            </div>
            <div class="form-group">
                <label for="kurang">Kurang</label>
                <input type="number" class="form-control" id="kurang" name="kurang" value="{{ $data->kurang }}" required>
            </div>
            <div class="form-group">
                <label for="rencana_tindak_lanjut">Rencana Tindak Lanjut</label>
                <input type="text" class="form-control" id="rencana_tindak_lanjut" name="rencana_tindak_lanjut" value="{{ $data->rencana_tindak_lanjut }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
