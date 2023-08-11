<li class="nav-item @if(Str::contains(Route::currentRouteName(), 'users'))active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
        aria-controls="collapseUser">
        <i class="fas fa-fw fa-cog"></i>
        <span>Users</span>
    </a>
    <div
        id="collapseUser"
        class="collapse @if (Str::contains(Route::currentRouteName(), 'users')) show @endif"
        aria-labelledby="headingTwo"
        data-parent="#accordionSidebar"
    >
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item
            @if (Route::currentRouteName() === 'admin.users.create') active @endif"
                href="{{ route('admin.users.create') }}">Register user</a>
            <a class="collapse-item
            @if (Route::currentRouteName() === 'admin.users.index') active @endif" href="{{ route('admin.users.index') }}">All Users</a>
        </div>
    </div>
</li>
