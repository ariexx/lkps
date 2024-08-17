@extends('adminlte::page')

@section('title', 'EWMP')

@section('content_header')
    <h1>EWMP</h1>
@stop

@section('content')
    <x-adminlte-card title="EWMP">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.ewmp.create') }}">
            Tambah EWMP
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
