<x-admin.admin-master>
    @section('content')
        <h2>{{ $user->name }} profile</h2>
        <div class="row">
            <div class="card-header py-3">
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
            <div class="col-sm-4">
                <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4"></div>
                    <div class="form-group mb-4">
                        <img width="250px" class="rounded mx-auto d-block" src="{{ $user->avatar }}"
                            alt="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png">
                    </div>
                    <div class="form-group @error('avatar') is-invalid @enderror">
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group @error('name') is-invalid @enderror">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group @error('username') is-invalid @enderror">
                        <label for="username">username</label>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group @error('email') is-invalid @enderror">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group @error('password') is-invalid @enderror">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group @error('password_confirmation') is-invalid @enderror">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success">
                    </div>

                </form>
            </div>
        </div>

        <div class="row md-2">
            <h3 class="text-left mb-4">
                Roles Action
            </h3>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Status</th>
                                <th>Name</th>
                                <th>slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>
                                        <input type="checkbox" name="checkbox" class="checkbox"
                                            @if ($user->roles->contains($role)) checked @endif id="">
                                    </td>

                                    <td> {{ $role->name }} </td>
                                    <td> {{ $role->slug }}</td>
                                    <td>
                                        @if (auth()->user()->userHasRole('admin') && $user->roles->contains($role))
                                            <button class="btn btn-outline-dark">Attach</button>
                                        @else
                                            <form action="{{ route('user.role.attach', $user) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="role" value="{{ $role->id }}">
                                                <input class="btn btn-outline-info" type="submit" value="Attach">
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->userHasRole('admin') && $user->roles->contains($role))
                                            <form action="{{ route('user.role.detach', ['user' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="role" value="{{ $role->id }}">
                                                <input class="btn btn-outline-danger" type="submit" value="Detach">
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
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @endsection

    @section('scripts')
        {{-- <script src="{{ asset('js/collapseMenu/users.js') }}"></script> --}}
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/datatable-script.js') }}"></script>
    @endsection
</x-admin.admin-master>
