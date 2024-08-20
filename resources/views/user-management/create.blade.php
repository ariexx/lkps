@extends("adminlte::page")

@section("title", "Create User")

@section("content_header")
    <h1>Create User</h1>
@stop

@section("content")
    <x-adminlte-card>
        <form action="{{ route('superadmin.user-management.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="superadmin">Superadmin</option>
                    <option value="admin_prodi">Admin Prodi</option>
                    <option value="dosen">Dosen</option>
                    <option value="prodi">Kepala Prodi</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-adminlte-card>
@endsection
