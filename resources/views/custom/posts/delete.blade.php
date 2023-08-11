@can('delete', $post)
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-outline-danger" type="submit" value="Delete">
    </form>
@else
    <button class="btn btn-outline-warning">
        <abbr title="This post not belongs to your account">
            Delete
        </abbr>
    </button>
@endcan
