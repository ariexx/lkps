@extends("adminlte::page")

@section("title", "Penelitian DTPS Yang Melibatkan Mahasiswa")

@section("content_header")
    <h1>Penelitian DTPS Yang Melibatkan Mahasiswa</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Penelitian DTPS Yang Melibatkan Mahasiswa">
        <x-create-button route="{{ route('kepala-prodi.penelitian-dtps-melibatkan-mahasiswa.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
