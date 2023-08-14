@if (auth()->user()->userHasRole('admin') && $user->roles->contains($role))
<button class="btn btn-outline-dark">Attach</button>
@else
<form action="{{ route('user.role.attach', $user) }}" method="post">
    @csrf
    @method('PATCH')
    <input type="hidden" name="role" value="{{ $role->id }}">
    <input class="btn btn-outline-info" type="submit" value="Attach">
</form>
@endif
