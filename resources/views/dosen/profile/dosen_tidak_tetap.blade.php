@extends('adminlte::page')

@section('title', 'Dashboard Dosen')

@section('content_header')
    <h1>Dosen Tidak Tetap</h1>
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
            <a href="{{route('dosen.dosen-tidak-tetap.create')}}" class="btn btn-primary">Tambah Dosen</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>NIDN/NIDK</th>
                        <th>Pendidikan Pasca Sarjana</th>
                        <th>Bidang Keahlian</th>
                        <th>Jabatan Akademik</th>
                        <th>Sertifikat Pendidik Profesional</th>
                        <th>Sertifikat Kompetensi</th>
                        <th>Mata Kuliah</th>
                        <th>Kesesuaian Bidang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosenTidakTetap as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->pendidikan_terakhir }}</td>
                            <td>{{ $dosen->bidang_keahlian }}</td>
                            <td>{{ $dosen->jabatan }}</td>
                            <td>{{ $dosen->sertifikat_pendidik }}</td>
                            <td>{{ $dosen->sertifikat_kompetensi }}</td>
                            <td>{{ $dosen->mata_kuliah }}</td>
                            <td>{{ $dosen->kesesuaian_bidang }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
