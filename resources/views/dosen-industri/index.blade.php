@extends("adminlte::page")

@section("title", "Dosen Industri/Praktisi")

@section("content_header")
    <h1>Dosen Industri/Praktisi</h1>
@stop

@section("content")
    <x-adminlte-card title="Dosen Industri Praktisi">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.dosen-industri-praktisi.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
