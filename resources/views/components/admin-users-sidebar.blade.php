<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Users</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="{{ route('admin.users.create') }}">Register user</a>
            @if (auth()->user()->userHasRole('admin'))
                <a class="collapse-item" href="{{ route('admin.users.index') }}">All Users</a>
            @endif
        </div>
    </div>
</li>
