@extends("adminlte::page")

@section("title", "Pengabdian Masyarakat")

@section("content_header")
    <h1>Pengabdian Masyarakat</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <x-adminlte-card title="Pengabdian Masyarakat">
        <x-create-button route="{{ route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.pengabdian-masyarakat.create') }}">
            Tambah Pengabdian Masyarakat
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$heads" />
    </x-adminlte-card>
@endsection
