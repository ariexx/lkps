@extends('adminlte::page')

@section('title', 'Kerjasama Pendidikan')

@section('content_header')
    <h1>Kerjasama Pendidikan</h1>
@stop

@section('content')
    <x-adminlte-card title="Kerjasama Pendidikan">
        <x-create-button route="{{ route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.create') }}">
            Tambah Kerjasama Pendidikan
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']" />
    </x-adminlte-card>
@stop
