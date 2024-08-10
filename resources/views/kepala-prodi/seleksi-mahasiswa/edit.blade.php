@extends("adminlte::page")

@section("title", "Seleksi Mahasiswa")

@section("content_header")
    <h1>Edit Seleksi Mahasiswa</h1>
@stop

@section("content")
    <x-adminlte-card title="Tambah Seleksi Mahasiswa">
        <form action="{{ route('kepala-prodi.mahasiswa.seleksi-mahasiswa.update', $data->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="tahun_akademik" label="Tahun Akademik" placeholder="Tahun Akademik" value="{{$data->tahun_akademik}}" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="daya_tampung" label="Daya Tampung" placeholder="Daya Tampung" type="number" value="{{$data->daya_tampung}}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="pendaftar" label="Pendaftar" placeholder="Pendaftar" type="number" value="{{$data->pendaftar}}"  />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="lulus_seleksi" label="Lulus Seleksi" placeholder="Lulus Seleksi" type="number" value="{{$data->lulus_seleksi}}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="reguler_baru" label="Mahasiswa Baru Reguler" placeholder="Mahasiswa Baru Reguler" type="number" value="{{$data->reguler_baru}}" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="transfer_baru" label="Mahasiswa Baru Transfer" placeholder="Mahasiswa Baru Transfer" type="number" value="{{$data->transfer_baru}}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="reguler_aktif" label="Mahasiswa Aktif Reguler" placeholder="Mahasiswa Aktif Reguler" type="number" value="{{$data->reguler_aktif}}" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="transfer_aktif" label="Mahasiswa Aktif Transfer" placeholder="Mahasiswa Aktif Transfer" type="number" value="{{$data->transfer_aktif}}" />
                </div>
            </div>
            <x-adminlte-button label="Simpan" type="submit" theme="success" icon="fas fa-save" />
        </form>
    </x-adminlte-card>
@endsection
