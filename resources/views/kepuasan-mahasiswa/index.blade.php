@extends("adminlte::page")

@section("title", "Kepuasan Mahasiswa")

@section("content_header")
    <h1>Kepuasan Mahasiswa</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Kepuasan Mahasiswa">
        <x-create-button route="{{ route('kepala-prodi.kepuasan-mahasiswa.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
            <tfoot>
            <tr>
                <th colspan="2">Rata-rata</th>
                <th>{{ $averageSangatBaik }}%</th>
                <th>{{ $averageBaik }}%</th>
                <th>{{ $averageCukup }}%</th>
                <th>{{ $averageKurang }}%</th>
                <th colspan="3"></th>
            </tr>
            </tfoot>
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
