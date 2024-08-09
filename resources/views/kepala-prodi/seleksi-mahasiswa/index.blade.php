@extends("adminlte::page")

@section("title", "Seleksi Mahasiswa")

@section("content_header")
    <h1>Seleksi Mahasiswa</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <x-adminlte-card title="Seleksi Mahasiswa">
        <x-create-button route="{{ route('kepala-prodi.mahasiswa.seleksi-mahasiswa.create') }}">
            Tambah Seleksi Mahasiswa
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$heads">
            <tfoot>
            <tr>
                <th>Jumlah</th>
                <th colspan="2"></th>
                <th>{{$total['pendaftar']}}</th>
                <th>{{$total['lulus_seleksi']}}</th>
                <th>{{$total['reguler_baru']}}</th>
                <th>{{$total['transfer_baru']}}</th>
                <th colspan="3"></th>
            </tr>
            </tfoot>
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
