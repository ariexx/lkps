<div class="d-flex justify-content-between">
    @if(in_array(user()->role, canEdit()) && in_array(user()->role, canDelete()))
        <a href="{{$routeEdit}}" class="btn btn-primary mr-2">Edit</a>
        <form action="{{$routeDelete}}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    @elseif(in_array(user()->role, canEdit()))
        <a href="{{$routeEdit}}" class="btn btn-primary">Edit</a>
    @endif
</div>
