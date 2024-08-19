@extends('adminlte::page')

@section('title', 'HKI Paten / Paten Sederhana')

@section('content_header')
    <h1>HKI Paten / Paten Sederhana</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-card title="HKI Paten / Paten Sederhana">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-hki-paten.create') }}">
            Tambah HKI Paten / Paten Sederhana
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
