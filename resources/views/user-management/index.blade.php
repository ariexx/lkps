@extends("adminlte::page")

@section("title", "Management User")

@section("content_header")
    <h1>Management User</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <x-create-button route="{{ route('superadmin.user-management.create') }}">
        Tambah
    </x-create-button>

    <x-adminlte-card title="Management User">
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']"/>
    </x-adminlte-card>
@endsection
