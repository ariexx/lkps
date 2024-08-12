@extends('adminlte::page')

@section('title', 'Mahasiswa Asing')

@section('content_header')
    <h1>Mahasiswa Asing</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <x-adminlte-card title="Mahasiswa Asing">
        <x-create-button route="{{ route('kepala-prodi.mahasiswa.mahasiswa-asing.create') }}">
            Tambah Mahasiswa Asing
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@stop
