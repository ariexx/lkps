<!-- resources/views/components/buttons.blade.php -->
@php
$role = Auth::user()->role ?? user()->role;
@endphp
<div class="d-flex justify-content-between">
    @if(in_array($role, App\Models\User::canEdit) && in_array($role, App\Models\User::canDelete))
        <a href="{{$routeEdit}}" class="btn btn-primary mr-2">Edit</a>
        <form action="{{$routeDelete}}" method="post" class="d-inline mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        @if(in_array($role, App\Models\User::canApprove))
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
    @elseif(in_array($role, App\Models\User::canEdit))
        <a href="{{$routeEdit}}" class="btn btn-primary">Edit</a>
    @elseif(in_array($role, App\Models\User::canDelete))
        <form action="{{$routeDelete}}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    @elseif(in_array($role, App\Models\User::canDelete))
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
</div>
