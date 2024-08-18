@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Dosen Industri Praktisi</h1>
@stop

@section('content')
    @if(session('error'))
        <x-adminlte-alert theme="danger" title="Error">
            {{ session('error') }}
        </x-adminlte-alert>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sumber-daya-manusia.dosen-industri-praktisi.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-adminlte-input name="nama" label="Nama" placeholder="Nama"  fgroup-class="col-md-12" disable-feedback value="{{$data->nama}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="nidn" label="NIDN/NIDK" placeholder="NIDN/NIDK" fgroup-class="col-md-12" disable-feedback value="{{$data->nidn}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="perusahaan" label="Perusahaan" placeholder="Perusahaan" fgroup-class="col-md-12" disable-feedback value="{{$data->perusahaan}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="pendidikan_terakhir" label="Pendidikan Tertinggi" placeholder="Pendidikan Tertinggi" fgroup-class="col-md-12" disable-feedback value="{{$data->pendidikan_terakhir}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="bidang_keahlian" label="Bidang Keahlian" placeholder="Bidang Keahlian" fgroup-class="col-md-12" disable-feedback value="{{$data->bidang_keahlian}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_kompetensi" label="Sertifikat Profesi/Kompetensi/Industri" fgroup-class="col-md-12" disable-feedback value="{{$data->sertifikat_kompetensi}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="mata_kuliah" label="Mata Kuliah yang Diampu" fgroup-class="col-md-12" disable-feedback value="{{$data->mata_kuliah}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="bobot_kredit" label="Bobot Kredit (SKS)" fgroup-class="col-md-12" disable-feedback value="{{$data->bobot_kredit}}"/>
                </div>
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </form>
        </div>
    </div>
@endsection
