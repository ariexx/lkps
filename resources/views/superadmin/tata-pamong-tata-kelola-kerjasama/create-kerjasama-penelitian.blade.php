@extends("adminlte::page")

@section("title", "Kerjasama Penelitian")

@section("content_header")
    <h1>Kerjasama Penelitian</h1>
@stop

@section("content")
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="lembaga_mitra">Lembaga Mitra:</label>
                    <input type="text" id="lembaga" name="lembaga" required class="form-control">
                </div>
                <div>
                    <label for="internasional">Internasional:</label>
                    <select type="text" id="internasional" name="internasional" required class="form-control">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div>
                    <label for="nasional">Nasional:</label>
                    <select type="text" id="nasional" name="nasional" required class="form-control">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div>
                    <label for="lokal">Wilayah/ Lokal:</label>
                    <select type="text" id="lokal" name="lokal" required class="form-control">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                    <div>
                        <label for="judul">Judul Kegiatan Kerjasama:</label>
                        <textarea id="judul" name="judul" required class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="manfaat">Manfaat bagi PS yang Diakreditasi:</label>
                        <textarea id="manfaat" name="manfaat" required class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="durasi">Waktu dan Durasi:</label>
                        <input type="date" id="durasi" name="durasi" class="form-control">
                    </div>
                    <div>
                        <label for="bukti">Bukti Kerjasama:</label>
                        <input type="file" id="bukti" name="bukti" required class="form-control">
                    </div>
                    <div>
                        <label for="tahun_kerjasama">Tahun Berakhirnya Kerjasama (YYYY):</label>
                        <input type="number" id="tahun_kerjasama" name="tahun_kerjasama" class="form-control">
                    </div>
                    <div><br />
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </div>
            </form>
    </div>
    <script>
        $(document).ready(function() {
            //set format tahun_kerjasama only accept year
            $('#tahun_kerjasama').on('input', function(e) {
                var value = e.target.value;
                if (value.length > 4) {
                    e.target.value = value.slice(0, 4);
                }
            });
        });
    </script>
@endsection
