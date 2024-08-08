@extends('adminlte::page')

@section('title', 'Kerjasama Pendidikan')

@section('content_header')
    <h1>Kerjasama Pendidikan</h1>
@stop

@section('content')
    <div class="card">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            <a href="{{ route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.create') }}" class="btn btn-primary">Tambah Kerjasama Pendidikan</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Lembaga Mitra</th>
                    <th colspan="3">Tingkat *)</th>
                    <th rowspan="2">Judul Kegiatan Kerjasama</th>
                    <th rowspan="2">Manfaat bagi PS yang Diakreditasi</th>
                    <th rowspan="2">Waktu dan Durasi</th>
                    <th rowspan="2">Bukti Kerjasama</th>
                    <th rowspan="2">Tahun Berakhirnya Kerjasama (YYYY)</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>Internasional</th>
                    <th>Nasional</th>
                    <th>Wilayah/ Lokal</th>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->lembaga_mitra }}</td>
                        <td>{{ $item->internasional }}</td>
                        <td>{{ $item->nasional }}</td>
                        <td>{{ $item->lokal }}</td>
                        <td>{{ $item->judul_kegiatan }}</td>
                        <td>{{ $item->manfaat_ps_diakreditasi }}</td>
                        <td>{{ $item->waktu_dan_durasi }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $item->bukti_kerjasama) }}" target="_blank">Lihat Bukti</a>
                        </td>
                        <td>{{ $item->tahun_berakhir_kerjasama }}</td>
                        <td>
                            <x-buttons
                                route-edit="{{route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.edit', $item->id)}}"
                                route-delete="{{route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.delete', $item->id)}}"
                            />
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
