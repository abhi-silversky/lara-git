@if (auth()->user()->userHasRole('admin') && $role->permissions->contains($permission))
    <button class="btn btn-outline-dark">Attach</button>
@else
    <form action="{{ route('roles.attach.permission', $role) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
        <button class="btn btn-outline-info" onclick="disableBtn()" id="attach" type="submit">Attach</button>
    </form>
@endif
