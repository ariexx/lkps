@extends("adminlte::page")

@section("title", "Dosen Pembimbing Utama")

@section("content_header")
    <h1>Dosen Pembimbing Utama</h1>
@endsection

@section("content")
    <x-adminlte-card title="Dosen Tetap Perguruan Tinggi">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.create') }}">
            Tambah Dosen Pembimbing Utama
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
