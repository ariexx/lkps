@extends("adminlte::page")

@section("title", "PKM DTPS")

@section("content_header")
    <h1>PKM DTPS</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <x-adminlte-card title="PKM DTPS">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.pkm-dtps.create') }}">
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
