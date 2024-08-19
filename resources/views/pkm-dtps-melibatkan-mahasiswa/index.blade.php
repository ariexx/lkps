@extends("adminlte::page")

@section("title", "PKM DTPS Melibatkan Mahasiswa")

@section("content_header")
    <h1>PKM DTPS Melibatkan Mahasiswa</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="PKM DTPS Melibatkan Mahasiswa">
        <x-create-button route="{{ route('kepala-prodi.pkm-dtps-yang-melibatkan-mahasiswa.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
