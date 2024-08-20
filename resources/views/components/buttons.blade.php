@php
    $role = Auth::user()->role ?? user()->role;
    $canEdit = ["prodi", "admin_prodi", "dosen"];
    $canDelete = ["prodi"];
    $canApprove = ["prodi"];
@endphp

<div class="d-flex justify-content-between">
    @if(in_array($role, $canEdit) && $isApproved !== STATUS_APPROVED)
        <a href="{{ $routeEdit }}" class="btn btn-primary mr-2">Edit</a>
    @endif

    @if(in_array($role, $canDelete))
        <form action="{{ $routeDelete }}" method="post" class="d-inline mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    @endif

    @if(in_array($role, $canApprove) && ($isApproved === 0 || $isApproved == STATUS_PENDING))
        <form action="{{ $routeApprove ?? '#' }}" method="post" class="d-inline mr-2">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Setujui</button>
        </form>
        <form action="{{ $routeReject ?? '#' }}" method="post" class="d-inline mr-2">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
    @endif

    @if($role === "superadmin")
            <a href="{{ $routeEdit }}" class="btn btn-primary mr-2">Edit</a>
            <form action="{{ $routeDelete }}" method="post" class="d-inline mr-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
    @endif
</div>
