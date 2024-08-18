@extends("adminlte::page")

@section("title", "Edit Penelitian DTPS")

@section("content_header")
    <h1>Edit Penelitian DTPS</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="sumber_pembiayaan">Sumber Pembiayaan</label>
                <input type="text" class="form-control" id="sumber_pembiayaan" name="sumber_pembiayaan" value="{{ $data->sumber_pembiayaan }}" required>
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
