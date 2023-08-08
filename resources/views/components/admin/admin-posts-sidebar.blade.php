<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="false"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-lock"></i>
        <span>Posts</span>
    </a>
    <div id="collapsePost" class="collapse overlay-is-navbar-collapse" aria-labelledby="headingAuthorization"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item op" href="{{ route('posts.create') }}">Create post</a>
            <a class="collapse-item" href="{{ route('posts.index') }}">All Posts</a>
            <a class="collapse-item" href="{{ route('posts.my') }}">My post</a>
        </div>
    </div>
</li>
