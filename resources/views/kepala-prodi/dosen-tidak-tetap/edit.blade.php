@extends('adminlte::page')

@section('title', 'Edit Dosen Tidak Tetap')

@section('content_header')
    <h1>Edit Dosen Tidak Tetap</h1>
@stop

@section('content')
    @if(session('error'))
        <x-adminlte-alert theme="danger" title="Error">
            {{ session('error') }}
        </x-adminlte-alert>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kepala-prodi.sumber-daya-manusia.dosen-tidak-tetap.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-adminlte-input name="nama" label="Nama" placeholder="Nama" fgroup-class="col-md-12" disable-feedback value="{{$data->nama}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="nidn" label="NIDN/NIDK" placeholder="NIDN/NIDK" fgroup-class="col-md-12" disable-feedback value="{{$data->nidn}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="pendidikan_terakhir" label="Pendidikan" placeholder="Pendidikan" fgroup-class="col-md-12" disable-feedback value="{{$data->pendidikan_terakhir}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="bidang_keahlian" label="Bidang Keahlian" placeholder="Bidang Keahlian" fgroup-class="col-md-12" disable-feedback value="{{$data->bidang_keahlian}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="jabatan" label="Jabatan" placeholder="Jabatan" fgroup-class="col-md-12" disable-feedback value="{{$data->jabatan}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_pendidik" label="Sertifikat Pendidik Profesional" fgroup-class="col-md-12" disable-feedback value="{{$data->sertifikat_pendidik}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="sertifikat_kompetensi" label="Sertifikat Kompetensi" fgroup-class="col-md-12" disable-feedback value="{{$data->sertifikat_kompetensi}}"/>
                </div>
                <div class="row">
                    <x-adminlte-input name="mata_kuliah" label="Mata Kuliah" fgroup-class="col-md-12" disable-feedback value="{{$data->mata_kuliah}}"/>
                </div>
                <div class="row">
                    <div class="row">
                        <label for="kesesuaian_bidang">Kesesuaian Bidang Keahlian</label>
                        <x-adminlte-select-bs name="kesesuaian_bidang">
                            <option value="1" {{($data->kesesuaian_bidang == 1 ? "selected" : "")}}>Ya</option>
                            <option value="0" {{($data->kesesuaian_bidang == 0 ? "selected" : "")}}>Tidak</option>
                        </x-adminlte-select-bs>
                    </div>
                </div>
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </form>
        </div>
    </div>
@endsection
