@extends('adminlte::page')

@section('title', 'Kerjasama Pendidikan')

@section('content_header')
    <h1>Edit Kerjasama Pendidikan</h1>
@stop

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @else
        <div class="alert alert-info">Isi form berikut untuk mengubah data kerjasama pendidikan.</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('kepala-prodi.tata-pamong-tata-kelola-kerjasama.kerjasama-pendidikan.update', $data->id)}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                @method('PUT')
                <div class="form-group">
                    <label for="lembaga_mitra">Lembaga Mitra:</label>
                    <input type="text" id="lembaga_mitra" name="lembaga_mitra" required class="form-control" value="{{$data->lembaga_mitra}}">
                </div>
                <div class="form-group">
                    <label for="internasional">Internasional:</label>
                    <select type="text" id="internasional" name="internasional" required class="form-control">
                        <option value="1" @if($data->internasional == 1) selected @endif>Ya</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nasional">Nasional:</label>
                    <select type="text" id="nasional" name="nasional" required class="form-control">
                        <option value="1" @if($data->nasional == 1) selected @endif>Ya</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="wilayah_lokal">Wilayah/ Lokal:</label>
                    <select type="text" id="lokal" name="lokal" required class="form-control">
                        <option value="1" @if($data->lokal == 1) selected @endif>Ya</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                    <div class="form-group">
                        <label for="judul_kegiatan">Judul Kegiatan Kerjasama:</label>
                        <textarea id="judul_kegiatan" name="judul_kegiatan" required class="form-control">{{$data->judul_kegiatan}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="manfaat_ps_diakreditasi">Manfaat bagi PS yang Diakreditasi:</label>
                        <textarea id="manfaat_ps_diakreditasi" name="manfaat_ps_diakreditasi" required class="form-control">{{$data->manfaat_ps_diakreditasi}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="waktu_dan_durasi">Waktu dan Durasi:</label>
                        <input type="date" id="waktu_dan_durasi" name="waktu_dan_durasi" class="form-control" value="{{$data->waktu_dan_durasi}}">
                    </div>
                    <div class="form-group">
                        <label for="bukti_kerjasama">Bukti Kerjasama:</label>
                        <input type="file" id="bukti_kerjasama" name="bukti_kerjasama" class="form-control">
                        @if($data->bukti_kerjasama)
                            <a href="{{ asset('storage/' . $data->bukti_kerjasama) }}" target="_blank">Lihat Bukti</a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tahun_berakhir_kerjasama">Tahun Berakhirnya Kerjasama (YYYY):</label>
                        <input type="number" id="tahun_berakhir_kerjasama" name="tahun_berakhir_kerjasama" class="form-control" value="{{$data->tahun_berakhir_kerjasama}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        //format tahun_berakhir_kerjasama only accept year
        document.getElementById('tahun_berakhir_kerjasama').addEventListener('input', function(e) {
            var value = e.target.value;
            if (value.length > 4) {
                e.target.value = value.slice(0, 4);
            }
        });
    </script>
@endsection
