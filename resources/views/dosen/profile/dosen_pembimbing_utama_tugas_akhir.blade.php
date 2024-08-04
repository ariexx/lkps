@extends('adminlte::page')

@section('title', 'Dosen Pembimbing Utama Tugas Akhir')

@section('content_header')
    <h1>Dosen Pembimbing Utama Tugas Akhir</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Dosen</th>
                    <th colspan="4">Jumlah Mahasiswa yang Dibimbing pada PS yang Diakreditasi</th>
                    <th colspan="4">Jumlah Mahasiswa yang Dibimbing pada PS Lain pada Program yang sama di PT</th>
                    <th rowspan="2">Rata-rata Jumlah Bimbingan di semua Program/Semester</th>
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
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_ts2_ps_diakreditasi }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_ts1_ps_diakreditasi }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_ts_ps_diakreditasi }}</td>
                        <td>{{ $dosen->rata_rata_mahasiswa }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_ts2_ps_lain }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_ts1_ps_lain }}</td>
                        <td>{{ $dosen->jumlah_mahasiswa_ts_ps_lain }}</td>
                        <td>{{ $dosen->rata_rata_mahasiswa_ps_lain }}</td>
                        <td>{{ $dosen->rata_rata_mahasiswa_semua_program }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan='2'><b>Rata-rata</b></td>
                    <td><b>46</b></td>
                    <td><b>47</b></td>
                    <td><b>17</b></td>
                    <td><b>9.5</b></td>
                    <td><b>29.5</b></td>
                    <td><b>2.5</b></td>
                    <td><b>27</b></td>
                    <td><b>39</b></td>
                    <td><b>24.25</b></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
@endsection
