@extends("adminlte::page")

@section("title", "Integrasi Kegiatan Penelitian")

@section("content_header")
    <h1>Integrasi Kegiatan Penelitian</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Integrasi Kegiatan Penelitian">
        <x-create-button route="{{ route('kepala-prodi.integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']"/>
    </x-adminlte-card>
@endsection
