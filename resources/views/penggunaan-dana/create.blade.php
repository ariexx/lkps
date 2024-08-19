@extends("adminlte::page")

@section("title", "Create Penggunaan Dana")

@section("content_header")
    <h1>Create Penggunaan Dana</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.penggunaan-dana.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="jenis_penggunaan">Jenis Penggunaan</label>
                <input type="text" class="form-control" id="jenis_penggunaan" name="jenis_penggunaan" required>
            </div>
            <div class="form-group">
                <label for="unit_ts">Unit TS</label>
                <input type="number" class="form-control" id="unit_ts" name="unit_ts" required>
            </div>
            <div class="form-group">
                <label for="unit_ts1">Unit TS1</label>
                <input type="number" class="form-control" id="unit_ts1" name="unit_ts1" required>
            </div>
            <div class="form-group">
                <label for="unit_ts2">Unit TS2</label>
                <input type="number" class="form-control" id="unit_ts2" name="unit_ts2" required>
            </div>
            <div class="form-group">
                <label for="program_ts">Program TS</label>
                <input type="number" class="form-control" id="program_ts" name="program_ts" required>
            </div>
            <div class="form-group">
                <label for="program_ts1">Program TS1</label>
                <input type="number" class="form-control" id="program_ts1" name="program_ts1" required>
            </div>
            <div class="form-group">
                <label for="program_ts2">Program TS2</label>
                <input type="number" class="form-control" id="program_ts2" name="program_ts2" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
