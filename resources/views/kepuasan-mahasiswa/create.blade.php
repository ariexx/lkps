@extends("adminlte::page")

@section("title", "Create Kepuasan Mahasiswa")

@section("content_header")
    <h1>Create Kepuasan Mahasiswa</h1>
@stop

@section("content")
    <x-adminlte-alert theme="info" title="Perhatian">
        Semua kolom <b>harus</b> diisi. Dan Baik, Cukup, Kurang <b>harus</b> berupa angka yang akan di konversi menjadi presentase.
    </x-adminlte-alert>
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.kepuasan-mahasiswa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="aspek">Aspek</label>
                <input type="text" class="form-control" id="aspek" name="aspek" required>
            </div>
            <div class="form-group">
                <label for="sangat_baik">Sangat Baik</label>
                <input type="number" class="form-control" id="sangat_baik" name="sangat_baik" required>
            </div>
            <div class="form-group">
                <label for="baik">Baik</label>
                <input type="number" class="form-control" id="baik" name="baik" required>
            </div>
            <div class="form-group">
                <label for="cukup">Cukup</label>
                <input type="number" class="form-control" id="cukup" name="cukup" required>
            </div>
            <div class="form-group">
                <label for="kurang">Kurang</label>
                <input type="number" class="form-control" id="kurang" name="kurang" required>
            </div>
            <div class="form-group">
                <label for="rencana_tindak_lanjut">Rencana Tindak Lanjut</label>
                <input type="text" class="form-control" id="rencana_tindak_lanjut" name="rencana_tindak_lanjut" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
