<form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class='btn btn-outline-danger'>Delete</button>
</form>
