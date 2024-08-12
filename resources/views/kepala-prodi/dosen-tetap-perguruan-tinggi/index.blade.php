@extends("adminlte::page")

@section("title", "Dosen Tetap Perguruan Tinggi")

@section("content_header")
    <h1>Dosen Tetap Perguruan Tinggi</h1>
@endsection

@section("content")
    <x-adminlte-card title="Dosen Tetap Perguruan Tinggi">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi.create') }}">
            Tambah Dosen Tetap Perguruan Tinggi
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
