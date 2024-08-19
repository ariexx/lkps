@extends("adminlte::page")

@section("title", "Pengunaan Dana")

@section("content_header")
    <h1>Pengunaan Dana</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Pengunaan Dana">
        <x-create-button route="{{ route('kepala-prodi.penggunaan-dana.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
            <tfoot>
            <tr>
                <th colspan="2">Jumlah</th>
                <th>{{$config['jumlah_unit_ts']}}</th>
                <th>{{$config['jumlah_unit_ts1']}}</th>
                <th>{{$config['jumlah_unit_ts2']}}</th>
                <th>{{$config['rata_rata_unit']}}</th>
                <th>{{$config['jumlah_program_ts']}}</th>
                <th>{{$config['jumlah_program_ts1']}}</th>
                <th>{{$config['jumlah_program_ts2']}}</th>
                <th>{{$config['rata_rata_program']}}</th>
            </tr>
            </tfoot>
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
