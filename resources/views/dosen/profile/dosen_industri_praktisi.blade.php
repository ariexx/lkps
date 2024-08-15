@extends('adminlte::page')

@section('title', 'Dashboard Dosen')

@section('content_header')
    <h1>Dosen Industri Praktisi</h1>
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
            <a href="{{route('dosen.dosen-industri-praktisi.create')}}" class="btn btn-primary">Tambah Dosen</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>NIDN/NIDK</th>
                        <th>Perusahaan/Industri</th>
                        <th>Pendidikan Tertinggi</th>
                        <th>Bidang Keahlian</th>
                        <th>Sertifikat Profesi/Kompetensi/Industri</th>
                        <th>Mata Kuliah yang Diampu</th>
                        <th>Bobot Kredit (SKS)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosenIndustriPraktisi as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->perusahaan }}</td>
                            <td>{{ $dosen->pendidikan_terakhir }}</td>
                            <td>{{ $dosen->bidang_keahlian }}</td>
                            <td>{{ $dosen->sertifikat_kompetensi }}</td>
                            <td>{{ $dosen->mata_kuliah }}</td>
                            <td>{{ $dosen->bobot_kredit }}</td>
                            <td>{!! is_approved($dosen->is_approve) !!}</td>
                            <td>
                                <a href="{{ route('dosen.dosen-industri-praktisi.edit', $dosen->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
