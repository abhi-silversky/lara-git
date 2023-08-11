<li class="nav-item @if (Str::contains(Route::currentRouteName(), ['roles', 'permissions'])) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthorization"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Authorization</span>
    </a>
    <div id="collapseAuthorization" class="collapse @if (Str::contains(Route::currentRouteName(), ['roles', 'permissions'])) show @endif"
        aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if (Str::contains(Route::currentRouteName(), 'roles')) active @endif" href="{{ route('admin.roles.index') }}">Roles</a>
            <a class="collapse-item @if (Str::contains(Route::currentRouteName(), 'permissions')) active @endif" href="{{ route('admin.permissions.index') }}">Permissions</a>
        </div>
    </div>
</li>
