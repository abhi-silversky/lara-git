@if (in_array($role->slug, ['admin', 'user']))
    <button class='btn btn-outline-warning'>Delete</button>
@else
    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class='btn btn-outline-danger'>Delete</button>
    </form>
@endif
