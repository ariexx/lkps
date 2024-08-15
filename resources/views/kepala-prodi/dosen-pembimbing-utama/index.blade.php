@extends("adminlte::page")

@section("title", "Dosen Pembimbing Utama")

@section("content_header")
    <h1>Dosen Pembimbing Utama</h1>
@endsection

@section("content")
    <x-adminlte-card title="Dosen Tetap Perguruan Tinggi">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.dosen-pembimbing-utama-tugas-akhir.create') }}">
            Tambah Dosen Pembimbing Utama
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
            <tfoot>
            <tr>
                <td colspan='2'><b>Jumlah</b></td>
                <td><b>{{$config['rata_rata_ts']['total_ts2']}}</b></td>
                <td><b>{{$config['rata_rata_ts']['total_ts1']}}</b></td>
                <td><b>{{$config['rata_rata_ts']['total_ts']}}</b></td>
                <td><b>{{$config['rata_rata_ts']['total_rata_rata']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['total_ts2']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['total_ts1']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['total_ts']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['total_rata_rata']}}</b></td>
                <td colspan="2"><b>{{$config['rata']['total_sum']}}</b></td>
            </tr>
            <tr>
                <td colspan='2'><b>Rata-rata</b></td>
                <td><b>{{$config['rata_rata_ts']['rata_rata_ts2']}}</b></td>
                <td><b>{{$config['rata_rata_ts']['rata_rata_ts1']}}</b></td>
                <td><b>{{$config['rata_rata_ts']['rata_rata_ts']}}</b></td>
                <td><b>{{$config['rata_rata_ts']['rata_rata']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['rata_rata_ts2']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['rata_rata_ts1']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['rata_rata_ts']}}</b></td>
                <td><b>{{$config['rata_rata_ts_lain']['rata_rata']}}</b></td>
                <td colspan="2"><b>{{$config['rata']['rata_rata']}}</b></td>
            </tr>
            </tfoot>
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
