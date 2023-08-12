<x-admin.admin-master>
    @section('content')
        <h3 class="text-left">
            @if (auth()->user()->userHasRole('admin'))
                All users
            @else
                My users
            @endIf
        </h3>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="users" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Created@</th>
                                <th>Avatar</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ Str::limit($user->email, 90, ' ..') }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->created_at->format('h:i A F j, Y') }}</td>
                                    <td>
                                        <img class="img-rounded img-fluid rounded" style="width:100px;height:100px;"
                                            src="{{ $user->avatar }}" alt="404">
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-info"
                                            href="{{ route('users.edit', $user->id) }}">Edit</a>
                                    </td>
                                    <td>
                                        @can('delete', $user)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-outline-danger" type="submit" value="Delete">
                                            </form>
                                        @else
                                            <button class="btn btn-outline-warning">
                                                <abbr title="You cant delete yourself">
                                                    Delete
                                                </abbr>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty <h2>Users not found</h2>
                            @endforelse
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    @endsection


    @push('yajra-scripts')
        <script>
            $(document).ready(function() {
                $('#users').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.users.index') !!}',
                    columns: [{
                            data: "DT_RowIndex",
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: "name",
                            name: "name"
                        },
                        {
                            data: "email",
                            name: "email"
                        },
                        {
                            data: "username",
                            name: "username",
                        },
                        {
                            data: "created_at",
                            name: "created_at",
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: "avatar",
                            name: "avatar",
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'edit',
                            name: 'edit',
                            processing: false,
                            serverSide: false,
                        },
                        {
                            data: 'delete',
                            name: 'delete',
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
        {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    @endpush
</x-admin.admin-master>
