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
            <a href="{{ route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.create') }}" class="btn btn-primary">Tambah Kerjasama Pendidikan</a>
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
                    <th rowspan="2">Status</th>
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
                        <td>{{ is_approved_bool($item->internasional) }}</td>
                        <td>{{ is_approved_bool($item->nasional) }}</td>
                        <td>{{ is_approved_bool($item->lokal) }}</td>
                        <td>{{ $item->judul_kegiatan }}</td>
                        <td>{{ $item->manfaat_ps_diakreditasi }}</td>
                        <td>{{ $item->waktu_dan_durasi }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $item->bukti_kerjasama) }}" target="_blank">Lihat Bukti</a>
                        </td>
                        <td>{{ $item->tahun_berakhir_kerjasama }}</td>
                        <td>{!! is_approved($item->is_approved) !!}</td>
                        <td>
                            <x-buttons
                                route-edit="{{route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.edit', $item->id)}}"
                                route-delete="{{route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.delete', $item->id)}}"
                                route-approve="{{route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.approve', $item->id)}}"
                                route-reject="{{route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.reject', $item->id)}}"
                                :is-approved="$item->is_approved"
                            />
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $data->links() }}
        </div>
    </div>
@stop
