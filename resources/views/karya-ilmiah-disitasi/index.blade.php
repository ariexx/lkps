@extends("adminlte::page")

@section("title", "Karya Ilmiah DTPS Disitasi")

@section("content_header")
    <h1>Karya Ilmiah DTPS Disitasi</h1>
@stop

@section("content")
    <x-adminlte-card title="Karya Ilmiah DTPS Disitasi">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.karya-ilmiah-dtps-disitasi.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
