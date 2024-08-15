@extends('adminlte::page')

@section('title', 'Dashboard Dosen')

@section('content_header')
    <h1>Tambah Dosen Tidak Tetap</h1>
@stop

@section('content')
    @if(session('error'))
        <x-adminlte-alert theme="danger" title="Error">
            {{ session('error') }}
        </x-adminlte-alert>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dosen.dosen-tidak-tetap.store') }}" method="POST">
                @csrf
                <div class="row">
                    <x-adminlte-input name="nama" label="Nama" placeholder="Nama" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="nidn" label="NIDN/NIDK" placeholder="NIDN/NIDK" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="pendidikan_terakhir" label="Pendidikan" placeholder="Pendidikan" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="bidang_keahlian" label="Bidang Keahlian" placeholder="Bidang Keahlian" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="jabatan" label="Jabatan" placeholder="Jabatan" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_pendidik" label="Sertifikat Pendidik Profesional" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_kompetensi" label="Sertifikat Kompetensi" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <x-adminlte-input name="mata_kuliah" label="Mata Kuliah" fgroup-class="col-md-12" disable-feedback/>
                </div>
                <div class="row">
                    <label for="kesesuaian_bidang">Kesesuaian Bidang Keahlian</label>
                    <x-adminlte-select-bs name="kesesuaian_bidang">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-adminlte-select-bs>
                </div>
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </form>
        </div>
    </div>
@endsection
