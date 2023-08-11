<a href="{{ route('posts.show', $post->id) }}">{{ Str::limit($post->title, 30, ' ...') }}</a>
