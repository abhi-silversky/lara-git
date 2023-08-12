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
                    <table class="table table-bordered" id="roles" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Sr.</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">slug</th>
                                <th class="text-center">Attach</th>
                                <th class="text-center">Detach</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @push('yajra-scripts')
        <script>
            $(document).ready(function() {
                $('#roles').dataTable({
                    processing: false,
                    serverSide: true,
                    ajax: '{!! route('users.edit', $user->id) !!}',
                    columns: [{
                            data: "DT_RowIndex",
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: "status",
                            name: "status"
                        },
                        {
                            data: "name",
                            name: "name"
                        },
                        {
                            data: "slug",
                            name: "slug",
                        },
                        {
                            data: 'attach',
                            name: 'attach',
                            processing: false,
                            serverSide: false,
                        },
                        {
                            data: 'detach',
                            name: 'detach',
                            processing: false,
                            serverSide: false,
                        },
                    ]
                });
            });
        </script>
    @endpush

    @push('head-script-yajra')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    @endpush
</x-admin.admin-master>
