@extends('adminlte::page')

@section('title', 'Dosen Pembimbing Utama Tugas Akhir')

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
            <form method="POST" action="{{route("kepala-prodi.sumber-daya-manusia.ewmp.update", $ewmp->id)}}">
                @csrf
                @method('PUT')
                <label>Nama Dosen</label>
                <input type="text" name="name" required class="form-control" value="{{$ewmp->name}}"><br>
                <label>DTPS</label>
                <input type="checkbox" name="dtps" {{($ewmp->dtps ? "checked" : "")}} value="{{$ewmp->dtps}}"><br>
                <label>PS yang Diakreditasi</label>
                <input type="number" name="ps_diakreditasi" required class="form-control" value="{{$ewmp->ps_diakreditasi}}"><br>
                <label>PS Lain di dalam PT</label>
                <input type="number" name="ps_lain_didalam_pt" required class="form-control" value="{{$ewmp->ps_lain_didalam_pt}}"><br>
                <label>PS Lain di luar PT</label>
                <input type="number" name="pt_lain_diluar_pt" required class="form-control" value="{{$ewmp->pt_lain_diluar_pt}}"><br>
                <label>Penelitian</label>
                <input type="number" name="penelitian" required class="form-control" value="{{$ewmp->penelitian}}"><br>
                <label>PkM</label>
                <input type="number" name="pkm" required class="form-control" value="{{$ewmp->pkm}}"><br>
                <label>Tugas Tambahan dan/atau Penunjang</label>
                <input type="number" name="tugas_tambahan" required class="form-control" value="{{$ewmp->tugas_tambahan}}"><br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
@endsection
