@extends("adminlte::page")

@section("title", "HKI Buku")

@section("content_header")
    <h1>HKI Buku</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-alert theme="info" title="Informasi">
        <strong>IV. Buku ber-ISBN, Book Chapter</strong>
    </x-adminlte-alert>

    <x-adminlte-card title="HKI Buku">
        <x-create-button route="{{ route('kepala-prodi.sumber-daya-manusia.luaran-penelitian-pkm-buku.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
