@extends("adminlte::page")

@section("title", "Dosen Tidak Tetap")

@section("content_header")
    <h1>Dosen Tidak Tetap</h1>
@endsection

@section("content")
    <x-adminlte-card title="Dosen Dosen Tidak Tetap">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap.create') }}">
            Tambah Dosen Tidak Tetap
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
