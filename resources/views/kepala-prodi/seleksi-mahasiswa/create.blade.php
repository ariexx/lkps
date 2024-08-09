@extends("adminlte::page")

@section("title", "Seleksi Mahasiswa")

@section("content_header")
    <h1>Tambah Seleksi Mahasiswa</h1>
@stop

@section("content")
    <x-adminlte-card title="Tambah Seleksi Mahasiswa">
        <form action="{{ route('kepala-prodi.mahasiswa.seleksi-mahasiswa.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="tahun_akademik" label="Tahun Akademik" placeholder="Tahun Akademik" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="daya_tampung" label="Daya Tampung" placeholder="Daya Tampung" type="number" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="pendaftar" label="Pendaftar" placeholder="Pendaftar" type="number" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="lulus_seleksi" label="Lulus Seleksi" placeholder="Lulus Seleksi" type="number" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="reguler_baru" label="Mahasiswa Baru Reguler" placeholder="Mahasiswa Baru Reguler" type="number" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="transfer_baru" label="Mahasiswa Baru Transfer" placeholder="Mahasiswa Baru Transfer" type="number" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="reguler_aktif" label="Mahasiswa Aktif Reguler" placeholder="Mahasiswa Aktif Reguler" type="number" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="transfer_aktif" label="Mahasiswa Aktif Transfer" placeholder="Mahasiswa Aktif Transfer" type="number" />
                </div>
            </div>
            <x-adminlte-button label="Simpan" type="submit" theme="success" icon="fas fa-save" />
        </form>
    </x-adminlte-card>
@endsection
