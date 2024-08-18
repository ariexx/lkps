@extends("adminlte::page")

@section("title", "Publikasi Ilmiah DTPS")

@section("content_header")
    <h1>Publikasi Ilmiah DTPS</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Publikasi Ilmiah DTPS">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps.create') }}">
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
