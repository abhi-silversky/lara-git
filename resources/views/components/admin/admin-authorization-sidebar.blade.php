<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthorization"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Authorization</span>
    </a>
    <div id="collapseAuthorization" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.roles.index') }}">Roles</a>
            <a class="collapse-item" href="{{ route('admin.permissions.index') }}">Permissions</a>
        </div>
    </div>
</li>
