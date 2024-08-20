@extends("adminlte::page")

@section("title", "Rekognisi Dosen")

@section("content_header")
    <h1>Rekognisi Dosen</h1>
@stop

@section("content")
    <x-adminlte-card title="Rekognisi Dosen">
        <x-create-button route="{{ auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.rekognisi-dosen.create') : route('kepala-prodi.sumber-daya-manusia.rekognisi-dosen.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
