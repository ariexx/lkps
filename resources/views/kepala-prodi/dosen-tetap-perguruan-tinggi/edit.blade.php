@extends('adminlte::page')

@section('title', 'Edit Dosen Tetap Perguruan Tinggi')

@section('content_header')
    <h1>Edit Dosen Tetap Perguruan Tinggi</h1>
@stop

@section('content')
    @if(session('error'))
        <x-adminlte-alert theme="danger" title="Error">
            {{ session('error') }}
        </x-adminlte-alert>
    @elseif(session('success'))
        <x-adminlte-alert theme="success" title="Success">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kepala-prodi.sumber-daya-manusia.dosen-tetap-perguruan-tinggi.update', $dosenTetapPerguruanTinggi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-adminlte-input name="nama" label="Nama" placeholder="Nama" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->nama}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="nidn" label="NIDN/NIDK" placeholder="NIDN/NIDK" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->nidn}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="pendidikan_magister" label="Pendidikan Magister" placeholder="Pendidikan Magister" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->pendidikan_magister}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="pendidikan_doktor" label="Pendidikan Doktor" placeholder="Pendidikan Doktor" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->pendidikan_doktor}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="bidang_keahlian" label="Bidang Keahlian" placeholder="Bidang Keahlian" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->bidang_keahlian}}"/>
                </div>
                <label for="kesesuaian">Kesesuaian dengan Kompetensi Inti PS</label>
                <x-adminlte-select-bs name="kesesuaian">
                    <option value="1" @if($dosenTetapPerguruanTinggi->kesesuaian == 1) selected @endif>Ya</option>
                    <option value="0">Tidak</option>
                </x-adminlte-select-bs>
                <div class="row">
                    <x-adminlte-input name="jabatan_akademik" label="Jabatan Akademik" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->jabatan_akademik}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_pendidik" label="Sertifikat Pendidik Profesional" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->sertifikat_pendidik}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_kompetensi" label="Sertifikat Kompetensi/ Profesi/ Industri" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->sertifikat_kompetensi}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="mata_kuliah_ps_diakreditasi" label="Mata Kuliah yang Diampu pada PS yang Diakreditasi" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->mata_kuliah_ps_diakreditasi}}"/>
                </div>
                <label for="kesesuaian_bidang_keahlian">Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu</label>
                <x-adminlte-select-bs name="kesesuaian_bidang_keahlian">
                    <option value="1" @if($dosenTetapPerguruanTinggi->kesesuaian_bidang_keahlian == 1) selected @endif>Ya</option>
                    <option value="0">Tidak</option>
                </x-adminlte-select-bs>
                <div class="row">
                    <x-adminlte-input name="mata_kuliah_ps_lain" label="Mata Kuliah yang Diampu pada PS Lain" fgroup-class="col-md-12" disable-feedback value="{{$dosenTetapPerguruanTinggi->mata_kuliah_ps_lain}}"/>
                </div>
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </form>
        </div>
    </div>
@endsection
