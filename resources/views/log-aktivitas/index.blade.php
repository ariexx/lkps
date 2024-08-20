@extends("adminlte::page")

@section("title", "Log Aktivitas")

@section("content_header")
    <h1>Log Aktivitas</h1>
@stop

@section("content")
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
    <x-adminlte-card title="Log Aktivitas">
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']"/>
    </x-adminlte-card>
@endsection
