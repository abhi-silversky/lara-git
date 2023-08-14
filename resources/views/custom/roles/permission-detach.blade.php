@if (auth()->user()->userHasRole('admin') && $role->permissions->contains($permission))
    <form action="{{ route('roles.detach.permission', $role) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
        <input class="btn btn-outline-danger" type="submit" value="Detach">
    </form>
@else
    <button class="btn btn-outline-dark">Detach</button>
@endif
