@extends('adminlte::page')

@section('title', 'HKI Teknologi Tepat guna')

@section('content_header')
    <h1>HKI Teknologi Tepat guna</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-alert theme="info" title="Informasi">
        <strong>Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial</strong>
    </x-adminlte-alert>

    <x-adminlte-card title="HKI Teknologi Tepat guna">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-teknologi.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
