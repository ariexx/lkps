@extends('adminlte::page')

@section('title', 'Dosen Pembimbing Utama Tugas Akhir')

@section('content_header')
    <h1>Dosen Pembimbing Utama Tugas Akhir</h1>
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
            <a href="{{route('dosen.dosen-pembimbing-utama-tugas-akhir.create')}}" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Dosen</th>
                    <th colspan="4">Jumlah Mahasiswa yang Dibimbing pada PS yang Diakreditasi</th>
                    <th colspan="4">Jumlah Mahasiswa yang Dibimbing pada PS Lain pada Program yang sama di PT</th>
                    <th rowspan="2">Rata-rata Jumlah Bimbingan di semua Program/Semester</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <th>TS-2</th>
                    <th>TS-1</th>
                    <th>TS</th>
                    <th>Rata-rata</th>
                    <th>TS-2</th>
                    <th>TS-1</th>
                    <th>TS</th>
                    <th>Rata-rata</th>
                </tr>
                @foreach($dosenPembimbingUtamaTugasAkhir as $dosen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dosen->name }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_dibimbing_ts2 }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_dibimbing_ts1 }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_dibimbing_ts }}</td>
                        <td>{{ number_format(($dosen->jumlah_mahasiswa_dibimbing_ts2+$dosen->jumlah_mahasiswa_dibimbing_ts1+$dosen->jumlah_mahasiswa_dibimbing_ts) / 3, 2) }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_dibimbing_ts2_lain }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_dibimbing_ts1_lain }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_dibimbing_ts_lain }}</td>
                        <td>{{ number_format(($dosen->jumlah_mahasiswa_dibimbing_ts2_lain+$dosen->jumlah_mahasiswa_dibimbing_ts1_lain+$dosen->jumlah_mahasiswa_dibimbing_ts_lain) / 3, 2) }}</td>
                        <td>
                            {{ number_format(($dosen->rata_rata_mahasiswa + $dosen->rata_rata_mahasiswa_lain) / 2, 2) }}

                        </td>
                        <td>
                            <a href="{{route('dosen.dosen-pembimbing-utama-tugas-akhir.edit', $dosen->id)}}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan='2'><b>Jumlah</b></td>
                    <td><b>{{$rataRataTS['total_ts2']}}</b></td>
                    <td><b>{{$rataRataTS['total_ts1']}}</b></td>
                    <td><b>{{$rataRataTS['total_ts']}}</b></td>
                    <td><b>{{$rataRataTS['total_rata_rata']}}</b></td>
                    <td><b>{{$rataRataTSLain['total_ts2']}}</b></td>
                    <td><b>{{$rataRataTSLain['total_ts1']}}</b></td>
                    <td><b>{{$rataRataTSLain['total_ts']}}</b></td>
                    <td><b>{{$rataRataTSLain['total_rata_rata']}}</b></td>
                    <td colspan="2"><b>{{$rata['total_sum']}}</b></td>
                </tr>
                <tr>
                    <td colspan='2'><b>Rata-rata</b></td>
                    <td><b>{{$rataRataTS['rata_rata_ts2']}}</b></td>
                    <td><b>{{$rataRataTS['rata_rata_ts1']}}</b></td>
                    <td><b>{{$rataRataTS['rata_rata_ts']}}</b></td>
                    <td><b>{{$rataRataTS['rata_rata']}}</b></td>
                    <td><b>{{$rataRataTSLain['rata_rata_ts2']}}</b></td>
                    <td><b>{{$rataRataTSLain['rata_rata_ts1']}}</b></td>
                    <td><b>{{$rataRataTSLain['rata_rata_ts']}}</b></td>
                    <td><b>{{$rataRataTSLain['rata_rata']}}</b></td>
                    <td colspan="2"><b>{{$rata['rata_rata']}}</b></td>
                </tr>
            </table>
        </div>
    </div>
@endsection
