@extends("adminlte::page")

@section("title", "Edit Penggunaan Dana")

@section("content_header")
    <h1>Edit Penggunaan Dana</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.penggunaan-dana.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="jenis_penggunaan">Jenis Penggunaan</label>
                <input type="text" class="form-control" id="jenis_penggunaan" name="jenis_penggunaan" value="{{ $data->jenis_penggunaan }}" required>
            </div>
            <div class="form-group">
                <label for="unit_ts">Unit TS</label>
                <input type="number" class="form-control" id="unit_ts" name="unit_ts" value="{{ $data->unit_ts }}" required>
            </div>
            <div class="form-group">
                <label for="unit_ts1">Unit TS1</label>
                <input type="number" class="form-control" id="unit_ts1" name="unit_ts1" value="{{ $data->unit_ts1 }}" required>
            </div>
            <div class="form-group">
                <label for="unit_ts2">Unit TS2</label>
                <input type="number" class="form-control" id="unit_ts2" name="unit_ts2" value="{{ $data->unit_ts2 }}" required>
            </div>
            <div class="form-group">
                <label for="program_ts">Program TS</label>
                <input type="number" class="form-control" id="program_ts" name="program_ts" value="{{ $data->program_ts }}" required>
            </div>
            <div class="form-group">
                <label for="program_ts1">Program TS1</label>
                <input type="number" class="form-control" id="program_ts1" name="program_ts1" value="{{ $data->program_ts1 }}" required>
            </div>
            <div class="form-group">
                <label for="program_ts2">Program TS2</label>
                <input type="number" class="form-control" id="program_ts2" name="program_ts2" value="{{ $data->program_ts2 }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </x-adminlte-card>
@endsection
