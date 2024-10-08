@extends("adminlte::page")

@section("title", "Kerjasama Penelitian")

@section("content_header")
    <h1>Kerjasama Penelitian</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <x-adminlte-card title="Kerjasama Penelitian">
        <x-create-button route="{{ route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.create') }}">
            Tambah Kerjasama Penelitian
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$heads" />
    </x-adminlte-card>
@endsection
