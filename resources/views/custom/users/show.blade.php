<a href="{{ route('users.edit', $user->id) }}">{{ Str::limit($user->name, 30, ' ...') }}</a>
