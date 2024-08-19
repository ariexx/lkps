@extends("adminlte::page")

@section("title", "Create Capaian Pembelajaran")

@section("content_header")
    <h1>Create Capaian Pembelajaran</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" class="form-control" id="semester" name="semester" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" required>
            </div>
            <div class="form-group">
                <label for="mata_kuliah">Mata Kuliah</label>
                <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required>
            </div>
            <div class="form-group">
                <label for="is_kompetensi">Mata Kuliah Kompetensi</label>
                <input type="hidden" name="is_kompetensi" value="0">
                <input type="checkbox" id="is_kompetensi" name="is_kompetensi" value="1">
            </div>
            <div class="form-group">
                <label for="kuliah_responsi">Kuliah / Responsi / Tutorial</label>
                <input type="number" class="form-control" id="kuliah_responsi" name="kuliah_responsi" required>
            </div>
            <div class="form-group">
                <label for="seminar">Seminar</label>
                <input type="hidden" name="seminar" value="0">
                <input type="checkbox" id="seminar" name="seminar" value="1">
            </div>
            <div class="form-group">
                <label for="praktikum">Praktikum / Praktik / Praktik Lapangan</label>
                <input type="number" class="form-control" id="praktikum" name="praktikum" required>
            </div>
            <div class="form-group">
                <label for="sikap">Sikap</label>
                <input type="hidden" name="sikap" value="0">
                <input type="checkbox" id="sikap" name="sikap" value="1">
            </div>
            <div class="form-group">
                <label for="pengetahuan">Pengetahuan</label>
                <input type="hidden" name="pengetahuan" value="0">
                <input type="checkbox" id="pengetahuan" name="pengetahuan" value="1">
            </div>
            <div class="form-group">
                <label for="keterampilan_umum">Keterampilan Umum</label>
                <input type="hidden" name="keterampilan_umum" value="0">
                <input type="checkbox" id="keterampilan_umum" name="keterampilan_umum" value="1">
            </div>
            <div class="form-group">
                <label for="keterampilan_khusus">Keterampilan Khusus</label>
                <input type="hidden" name="keterampilan_khusus" value="0">
                <input type="checkbox" id="keterampilan_khusus" name="keterampilan_khusus" value="1">
            </div>
            <div class="form-group">
                <label for="dokumen_rencana">Dokumen Rencana Pembelajaran</label>
                <input type="file" class="form-control" id="dokumen_rencana" name="dokumen_rencana" accept="*/*" required>
            </div>
            <div class="form-group">
                <label for="unit_penyelenggara">Unit Penyelenggara</label>
                <input type="text" class="form-control" id="unit_penyelenggara" name="unit_penyelenggara" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
