<li class="nav-item @if (Str::contains(Route::currentRouteName(), 'posts')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="false"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-lock"></i>
        <span>Posts</span>
    </a>
    <div id="collapsePost"
    class="collapse @if (Str::contains(Route::currentRouteName(), 'posts')) show @endif"
    aria-labelledby="headingAuthorization"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if (Route::currentRouteName() === 'posts.create') active @endif" href="{{ route('posts.create') }}">Create post</a>
            <a class="collapse-item @if (Route::currentRouteName() === 'posts.index') active @endif" href="{{ route('posts.index') }}">All Posts</a>
            <a class="collapse-item @if (Route::currentRouteName() === 'posts.my') active @endif" href="{{ route('posts.my') }}">My post</a>
        </div>
    </div>
</li>
