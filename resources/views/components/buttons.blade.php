<!-- resources/views/components/buttons.blade.php -->
@php
$role = Auth::user()->role ?? user()->role;
//const canEdit = [\App\Models\User::prodi, \App\Models\User::adminprodi];
//const canDelete = [\App\Models\User::prodi];
//const canApprove = [\App\Models\User::prodi];
@endphp
<div class="d-flex justify-content-between">
    @if(in_array($role, ["prodi", "admin_prodi"]))
        @php Log::info($role) @endphp
        <a href="{{$routeEdit}}" class="btn btn-primary mr-2">Edit</a>
        @if($role === "prodi")
        <form action="{{$routeDelete}}" method="post" class="d-inline mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
            @if($isApproved === STATUS_PENDING)
                <form action="{{$routeApprove ?? "#"}}" method="post" class="d-inline mr-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Setujui</button>
                </form>
                <form action="{{$routeReject ?? "#"}}" method="post" class="d-inline mr-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
            @endif
        @endif
    @endif
</div>
