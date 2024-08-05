@extends('adminlte::page')

@section('title', 'Tambah Dosen Pembimbing Utama Tugas Akhir')

@section('content_header')
    <h1>Tambah Dosen Pembimbing Utama Tugas Akhir</h1>
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
            <form method="POST" action="{{route('dosen.dosen-pembimbing-utama-tugas-akhir.store')}}">
                @csrf
                <label>Nama Dosen:</label><br>
                <input type="text" name="name" required class="form-control"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-2):</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts2" required class="form-control"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-1):</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts1" required class="form-control"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS):</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts" required class="form-control"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-2) - PS Lain pada Program yang sama di PT:</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts2_lain" required class="form-control"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-1) - PS Lain pada Program yang sama di PT:</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts1_lain" required class="form-control"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS) - PS Lain pada Program yang sama di PT:</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts_lain" required class="form-control"><br>

                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>
    </div>
@endsection
