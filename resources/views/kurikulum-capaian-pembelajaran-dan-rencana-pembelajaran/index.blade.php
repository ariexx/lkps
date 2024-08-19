@extends('adminlte::page')

@section('title', 'Kurikulum, Capaian Pembelajaran dan Rencana Pembelajaran')

@section('content_header')
    <h1>Kurikulum, Capaian Pembelajaran dan Rencana Pembelajaran</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <x-adminlte-card title="Kurikulum, Capaian Pembelajaran dan Rencana Pembelajaran">
        <x-create-button route="{{ route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.create') }}">
            Tambah Kurikulum, Capaian Pembelajaran dan Rencana Pembelajaran
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@endsection
