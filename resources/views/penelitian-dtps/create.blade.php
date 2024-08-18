@extends("adminlte::page")

@section("title", "Create Penelitian DTPS")

@section("content_header")
    <h1>Create Penelitian DTPS</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sumber_pembiayaan">Sumber Pembiayaan</label>
                <input type="text" class="form-control" id="sumber_pembiayaan" name="sumber_pembiayaan" required>
            </div>
            <div class="form-group">
                <label for="ts">TS</label>
                <input type="number" class="form-control" id="ts" name="ts" required>
            </div>
            <div class="form-group">
                <label for="ts1">TS1</label>
                <input type="number" class="form-control" id="ts1" name="ts1" required>
            </div>
            <div class="form-group">
                <label for="ts2">TS2</label>
                <input type="number" class="form-control" id="ts2" name="ts2" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
