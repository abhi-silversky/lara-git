@can('update', $post)
    <a class="btn btn-outline-info" href="{{ route('posts.edit', $post->id) }}">Edit</a>
@else
    <button class="btn btn-outline-warning">
        <abbr title="This post not belongs to your account">
            Edit
        </abbr>
    </button>
@endcan
