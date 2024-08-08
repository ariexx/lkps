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
        <a href="{{ route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.create') }}" class="btn btn-success mb-3">Tambah Kerjasama Penelitian</a>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$heads" />
    </x-adminlte-card>
@endsection
