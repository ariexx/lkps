@extends("adminlte::page")

@section("title", "Edit Capaian Pembelajaran")

@section("content_header")
    <h1>Edit Capaian Pembelajaran</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" class="form-control" id="semester" name="semester" value="{{ $data->semester }}" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ $data->kode }}" required>
            </div>
            <div class="form-group">
                <label for="mata_kuliah">Mata Kuliah</label>
                <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" value="{{ $data->mata_kuliah }}" required>
            </div>
            <div class="form-group">
                <label for="is_kompetensi">Mata Kuliah Kompetensi</label>
                <input type="hidden" name="is_kompetensi" value="0">
                <input type="checkbox" id="is_kompetensi" name="is_kompetensi" value="1" {{ $data->is_kompetensi ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="kuliah_responsi">Kuliah / Responsi / Tutorial</label>
                <input type="number" class="form-control" id="kuliah_responsi" name="kuliah_responsi" value="{{ $data->kuliah_responsi }}" required>
            </div>
            <div class="form-group">
                <label for="seminar">Seminar</label>
                <input type="hidden" name="seminar" value="0">
                <input type="checkbox" id="seminar" name="seminar" value="1" {{ $data->seminar ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="praktikum">Praktikum / Praktik / Praktik Lapangan</label>
                <input type="number" class="form-control" id="praktikum" name="praktikum" value="{{ $data->praktikum }}" required>
            </div>
            <div class="form-group">
                <label for="sikap">Sikap</label>
                <input type="hidden" name="sikap" value="0">
                <input type="checkbox" id="sikap" name="sikap" value="1" {{ $data->sikap ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="pengetahuan">Pengetahuan</label>
                <input type="hidden" name="pengetahuan" value="0">
                <input type="checkbox" id="pengetahuan" name="pengetahuan" value="1" {{ $data->pengetahuan ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="keterampilan_umum">Keterampilan Umum</label>
                <input type="hidden" name="keterampilan_umum" value="0">
                <input type="checkbox" id="keterampilan_umum" name="keterampilan_umum" value="1" {{ $data->keterampilan_umum ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="keterampilan_khusus">Keterampilan Khusus</label>
                <input type="hidden" name="keterampilan_khusus" value="0">
                <input type="checkbox" id="keterampilan_khusus" name="keterampilan_khusus" value="1" {{ $data->keterampilan_khusus ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="dokumen_rencana">Dokumen Rencana Pembelajaran</label>
                <input type="file" class="form-control" id="dokumen_rencana" name="dokumen_rencana" accept="*/*">
                <a href="{{ asset('storage/' . $data->dokumen_rencana) }}" target="_blank">Lihat Dokumen</a>
            </div>
            <div class="form-group">
                <label for="unit_penyelenggara">Unit Penyelenggara</label>
                <input type="text" class="form-control" id="unit_penyelenggara" name="unit_penyelenggara" value="{{ $data->unit_penyelenggara }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
