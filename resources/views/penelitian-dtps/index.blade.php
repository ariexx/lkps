@extends("adminlte::page")

@section("title", "Penelitian DTPS")

@section("content_header")
    <h1>Penelitian DTPS</h1>
@stop

@section("content")
    <x-adminlte-card title="Penelitian DTPS">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
            <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th>{{ $config['ts'] }}</th>
                <th>{{ $config['ts1'] }}</th>
                <th>{{ $config['ts2'] }}</th>
                <th>{{ $config['total'] }}</th>
                <th colspan="2"></th>
            </tr>
            </tfoot>
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
