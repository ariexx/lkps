@extends('adminlte::page')

@section('title', 'EWMP Dosen Tetap Perguruan Tinggi')

@section('content_header')
    <h1>EWMP Dosen Tetap Perguruan Tinggi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{route('dosen.ewmp-dosen-tetap-perguruan-tinggi.create')}}" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr class="align-content-center">
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Dosen</th>
                    <th rowspan="2">DTPS</th>
                    <th colspan="3">Pendidikan: Pembelajaran dan Pembimbingan</th>
                    <th colspan="3" rowspan="2">Penelitian</th>
                    <th colspan="3" rowspan="2">PkM</th>
                    <th colspan="3" rowspan="2">Tugas Tambahan dan/atau Penunjang</th>
                    <th rowspan="2">Jumlah</th>
                    <th rowspan="2">Rata-rata</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr class="align-content-center">
                    <th>PS yang Diakreditasi</th>
                    <th>PS Lain di dalam PT</th>
                    <th>PS Lain di luar PT</th>
                </tr>

                @foreach($ewmp as $ewmp)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ewmp->name }}</td>
                        <td>{{ ($ewmp->dtps) ? "Ya" : "Tidak" }}</td>
                        <td>{{ $ewmp->ps_diakreditasi }}</td>
                        <td>{{ $ewmp->ps_lain_didalam_pt }}</td>
                        <td>{{ $ewmp->pt_lain_diluar_pt }}</td>
                        <td colspan="3">{{ $ewmp->penelitian }}</td>
                        <td colspan="3">{{ $ewmp->pkm }}</td>
                        <td colspan="3">{{ $ewmp->tugas_tambahan }}</td>
                        <td>{{ $ewmp->jumlah() }}</td>
                        <td>{{ $ewmp->rataRata() }}</td>
                        <td>
                            <a href="{{route('dosen.ewmp-dosen-tetap-perguruan-tinggi.edit', $ewmp->id)}}" class="btn btn-warning">Edit</a>
{{--                            <form action="{{route('dosen.ewmp-dosen-tetap-perguruan-tinggi.destroy', $ewmp->id)}}" method="POST" class="d-inline">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>--}}
{{--                            </form>--}}
                        </td>
                    </tr>
                @endforeach
                <th colspan="12"></th>
                <th colspan="3">Rata Rata</th>
                <th>{{ $ewmp->rataRataJumlah() }}</th>
                <th>{{$ewmp->rataRataSKS()}}</th>
            </table>
        </div>
    </div>
@endsection
