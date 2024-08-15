@extends('adminlte::page')

@section('title', 'Dosen Tetap Perguruan Tinggi')

@section('content_header')
    <h1>Dosen Tetap Perguruan Tinggi</h1>
@stop

@section('content')
@if(session('success'))
    <x-adminlte-alert theme="success" title="Success">
        {{ session('success') }}
    </x-adminlte-alert>
@elseif(session('error'))
    <x-adminlte-alert theme="danger" title="Error">
        {{ session('error') }}
    </x-adminlte-alert>
@endif

<div class="card">
    <div class="card-body">
        <a href="{{route('dosen.dosen-tetap-perguruan-tinggi.create')}}" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama Dosen</th>
                <th>NIDN/NIDK</th>
                <th colspan="2">Pendidikan Pasca Sarjana</th>
                <th>Bidang Keahlian</th>
                <th>Kesesuaian dengan Kompetensi Inti PS</th>
                <th>Jabatan Akademik</th>
                <th>Sertifikat Pendidik Profesional</th>
                <th>Sertifikat Kompetensi/ Profesi/ Industri</th>
                <th>Mata Kuliah pada PS yang Diakreditasi</th>
                <th>Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu</th>
                <th>Mata Kuliah pada PS Lain</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Magister/ Magister Terapan/ Spesialis</th>
                <th>Doktor/ Doktor Terapan/ Spesialis</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($dosenTetapPerguruanTinggi as $dosen)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dosen->nama }}</td>
                    <td>{{ $dosen->nidn }}</td>
                    <td>{{ $dosen->pendidikan_magister }}</td>
                    <td>{{ $dosen->pendidikan_doktor }}</td>
                    <td>{{ $dosen->bidang_keahlian }}</td>
                    <td>{{ $dosen->kesesuaian }}</td>
                    <td>{{ $dosen->jabatan_akademik }}</td>
                    <td>{{ $dosen->sertifikat_pendidik }}</td>
                    <td>{{ $dosen->sertifikat_kompetensi }}</td>
                    <td>{{ $dosen->mata_kuliah_ps_diakreditasi }}</td>
                    <td>{{ $dosen->kesesuaian_bidang_keahlian }}</td>
                    <td>{{ $dosen->mata_kuliah_ps_lain }}</td>
                    <td>{!! is_approved($dosen->is_approve) !!}</td>
                    <td>
                        @if(in_array($dosen->is_approve, [STATUS_PENDING, STATUS_REJECTED]))
                            <a href="{{route('dosen.dosen-tetap-perguruan-tinggi.edit', $dosen->id)}}" class="btn btn-warning">Edit</a>
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
