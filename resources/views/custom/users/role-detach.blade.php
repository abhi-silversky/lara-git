@if (auth()->user()->userHasRole('admin') && $user->roles->contains($role))
    <form action="{{ route('user.role.detach', ['user' => $user->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="role" value="{{ $role->id }}">
        <input class="btn btn-outline-danger" type="submit" value="Detach">
    </form>
@else
    <button class="btn btn-outline-dark">Detach</button>
@endif
