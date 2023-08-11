@can('delete', $user)
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-outline-danger" type="submit" value="Delete">
    </form>
@else
    <button class="btn btn-outline-warning">
        <abbr title="You cant delete this user">
            Delete
        </abbr>
    </button>
@endcan
