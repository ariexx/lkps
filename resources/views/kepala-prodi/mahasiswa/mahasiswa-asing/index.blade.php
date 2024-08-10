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
{{--            <tfoot>--}}
{{--            <tr>--}}
{{--                <th>Jumlah</th>--}}
{{--                <th colspan="2"></th>--}}
{{--                <th>{{$total['pendaftar']}}</th>--}}
{{--                <th>{{$total['lulus_seleksi']}}</th>--}}
{{--                <th>{{$total['reguler_baru']}}</th>--}}
{{--                <th>{{$total['transfer_baru']}}</th>--}}
{{--                <th colspan="3"></th>--}}
{{--            </tr>--}}
{{--            </tfoot>--}}
        </x-adminlte-datatable>
    </x-adminlte-card>
@stop
