@extends('adminlte::page')

@section('title', 'Mahasiswa Asing')

@section('content_header')
    <h1>Mahasiswa Asing</h1>
@stop

@section("content")
    <x-adminlte-card title="Edit Seleksi Mahasiswa">
        <form action="{{ route('kepala-prodi.mahasiswa.mahasiswa-asing.update', $mahasiswaAsing->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $mahasiswaAsing->id }}">
            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-input name="program_studi" label="Program Studi" placeholder="Program Studi" value="{{$mahasiswaAsing->program_studi}}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_aktif_ts2" label="Mahasiswa Aktif TS-2" placeholder="Mahasiswa Aktif TS-2" type="number" value="{{$mahasiswaAsing->mahasiswa_aktif_ts2}}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_aktif_ts1" label="Mahasiswa Aktif TS-1" placeholder="Mahasiswa Aktif TS-1" type="number" value="{{$mahasiswaAsing->mahasiswa_aktif_ts1}}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_aktif_ts" label="Mahasiswa Aktif TS" placeholder="Mahasiswa Aktif TS" type="number" value="{{$mahasiswaAsing->mahasiswa_aktif_ts}}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_asing_full_time_ts2" label="Mahasiswa Asing Full Time TS-2" placeholder="Mahasiswa Asing Full Time TS-2" type="number" value="{{$mahasiswaAsing->mahasiswa_asing_full_time_ts2}}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_asing_full_time_ts1" label="Mahasiswa Asing Full Time TS-1" placeholder="Mahasiswa Asing Full Time TS-1" type="number" value="{{$mahasiswaAsing->mahasiswa_asing_full_time_ts1}}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_asing_full_time_ts" label="Mahasiswa Asing Full Time TS" placeholder="Mahasiswa Asing Full Time TS" type="number" value="{{$mahasiswaAsing->mahasiswa_asing_full_time_ts}}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_asing_part_time_ts2" label="Mahasiswa Asing Part Time TS-2" placeholder="Mahasiswa Asing Part Time TS-2" type="number" value="{{$mahasiswaAsing->mahasiswa_asing_part_time_ts2}}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_asing_part_time_ts1" label="Mahasiswa Asing Part Time TS-1" placeholder="Mahasiswa Asing Part Time TS-1" type="number" value="{{$mahasiswaAsing->mahasiswa_asing_part_time_ts1}}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input name="mahasiswa_asing_part_time_ts" label="Mahasiswa Asing Part Time TS" placeholder="Mahasiswa Asing Part Time TS" type="number" value="{{$mahasiswaAsing->mahasiswa_asing_part_time_ts}}" />
                </div>
            </div>
            <x-adminlte-button label="Simpan" type="submit" theme="success" icon="fas fa-save" />
        </form>
    </x-adminlte-card>
@stop
