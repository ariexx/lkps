@extends('adminlte::page')

@section('title', 'Edit Dosen Pembimbing Utama Tugas Akhir')

@section('content_header')
    <h1>Edit Dosen Pembimbing Utama Tugas Akhir</h1>
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
            <form method="POST" action="{{route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.update', $data->id)}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$data->id}}">
                <label>Nama Dosen:</label><br>
                <input type="text" name="name" required class="form-control" value="{{$data->name}}"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-2):</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts2" required class="form-control" value="{{$data->jumlah_mahasiswa_dibimbing_ts2}}"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-1):</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts1" required class="form-control" value="{{$data->jumlah_mahasiswa_dibimbing_ts1}}"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS):</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts" required class="form-control" value="{{$data->jumlah_mahasiswa_dibimbing_ts}}"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-2) - PS Lain pada Program yang sama di PT:</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts2_lain" required class="form-control" value="{{$data->jumlah_mahasiswa_dibimbing_ts2_lain}}"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS-1) - PS Lain pada Program yang sama di PT:</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts1_lain" required class="form-control" value="{{$data->jumlah_mahasiswa_dibimbing_ts1_lain}}"><br>

                <label>Jumlah Mahasiswa yang Dibimbing (TS) - PS Lain pada Program yang sama di PT:</label><br>
                <input type="number" name="jumlah_mahasiswa_dibimbing_ts_lain" required class="form-control" value="{{$data->jumlah_mahasiswa_dibimbing_ts_lain}}"><br>

                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>
    </div>
@endsection

