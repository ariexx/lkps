@extends("adminlte::page")

@section("title", "Produk/Jasa Yang Diadopsi Masyarakat")

@section("content_header")
    <h1>Produk/Jasa Yang Diadopsi Masyarakat</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-card title="Produk/Jasa Yang Diadopsi Masyarakat">
        <x-create-button route="{{ auth()->user()->role == 'dosen' ? route('dosen.kinerja-dosen.produk-jasa-dtps-diadopsi.create') : route('kepala-prodi.sumber-daya-manusia.produk-jasa-masyarakat.create') }}">
            Tambah
        </x-create-button>
        <x-adminlte-datatable id="table1" :config="$config" striped hoverable with-buttons :heads="$config['heads']">
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
