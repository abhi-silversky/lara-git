<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Posts</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="{{ route('posts.create') }}">Create post</a>
            @if (auth()->user()->isAdmin())
                <a class="collapse-item" href="{{ route('posts.index') }}">View all posts</a>
            @else
                <a class="collapse-item" href="{{ route('posts.my') }}">My post</a>
            @endIf
        </div>
    </div>
</li>
