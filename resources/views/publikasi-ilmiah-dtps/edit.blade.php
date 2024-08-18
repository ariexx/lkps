@extends("adminlte::page")

@section("title", "Edit Publikasi Ilmiah DTPS")

@section("content_header")
    <h1>Edit Publikasi Ilmiah DTPS</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="jenis_publikasi">Jenis Publikasi</label>
                <input type="text" class="form-control" id="jenis_publikasi" name="jenis_publikasi" value="{{ $data->jenis_publikasi }}" required>
            </div>
            <div class="form-group">
                <label for="ts">TS</label>
                <input type="number" class="form-control" id="ts" name="ts" value="{{ $data->ts }}" required>
            </div>
            <div class="form-group">
                <label for="ts1">TS1</label>
                <input type="number" class="form-control" id="ts1" name="ts1" value="{{ $data->ts1 }}" required>
            </div>
            <div class="form-group">
                <label for="ts2">TS2</label>
                <input type="number" class="form-control" id="ts2" name="ts2" value="{{ $data->ts2 }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
