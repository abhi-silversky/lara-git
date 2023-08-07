<x-admin.admin-master>
    @section('content')
        <h2>Edit Role</h2>




        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <label class="form-group" for="name">Name</label>
                    <input class="form-group @error('name') is-invalid  @enderror" type="text" name="name" id="name"
                        value="{{ $role->name }}">
                    @error('name')
                        <span class="invalid-feedback mb-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror()
                    <button type="submit" class="btn btn-info">Update</button>
                </form>
            </div>
        </div>

        <div class="row">
            <!-- DataTales Example -->
            @if ($permissions->isNotEmpty())
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h2>Permissions List</h2>
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    <h3>{{ session('error') }}</h3>
                                </div>
                            @elseif (session()->has('success'))
                                <div class="alert alert-success">
                                    <h3>{{ session('success') }}</h3>
                                </div>
                            @elseif (session()->has('warning'))
                                <div class="alert alert-warning">
                                    <h3>{{ session('warning') }}</h3>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sr.</th>
                                            <th class="text-center">Options</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">slug</th>
                                            <th class="text-center">Attach</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($permissions as $permission)
                                            <tr>
                                                <td class="text-center"> {{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="checkbox" class="checkbox"
                                                        @foreach ($role->permissions as $role_permission)
                                                        @if ($role_permission->slug == $permission->slug)
                                                        checked
                                                        @endif @endforeach
                                                        id="">
                                                </td>

                                                <td class="text-center"> {{ $permission->name }} </td>
                                                <td class="text-center"> {{ $permission->slug }}</td>
                                                <td class="text-center">
                                                    @if (auth()->user()->userHasRole('admin') && $role->permissions->contains($permission))
                                                        <button class="btn btn-outline-dark">Attach</button>
                                                    @else
                                                        <form action="{{ route('roles.attach.permission', $role) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="permission_id"
                                                                value="{{ $permission->id }}">
                                                            <input class="btn btn-outline-info" type="submit"
                                                                value="Attach">
                                                        </form>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (auth()->user()->userHasRole('admin') && $role->permissions->contains($permission))
                                                        <form action="{{ route('roles.detach.permission', $role) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="permission_id"
                                                                value="{{ $permission->id }}">
                                                            <input class="btn btn-outline-danger" type="submit"
                                                                value="Detach">
                                                        </form>
                                                    @else
                                                        <button class="btn btn-outline-dark">Detach</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty <tr>
                                                <td>Emptry array</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif()
            {{-- {{ $permissions->links('pagination::bootstrap-5') }} --}}
        </div>
    @endsection

</x-admin.admin-master>
