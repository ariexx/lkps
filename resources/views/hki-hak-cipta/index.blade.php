@extends('adminlte::page')

@section('title', 'HKI Paten / Paten Sederhana')

@section('content_header')
    <h1>HKI Hak Cipta</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-alert theme="info" title="Informasi">
        <strong>HKI: a) Hak Cipta, b) Desain Produk Industri,  c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak Sirkuit Terpadu, e) dll.)</strong>
    </x-adminlte-alert>

    <x-adminlte-card title="HKI Hak Cipta">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-hak-cipta.create') }}">
            Tambah Hak Cipta
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
