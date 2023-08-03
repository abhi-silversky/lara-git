<x-admin-master>
@section('content')
<h3 class="text-left">
    @if (auth()->user()->isAdmin())
        All users
    @else
        My users
    @endIf
    </h1>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a
                                        href="{{ route('posts.showForAdmin', $user->name) }}">{{ $user->name }}</a>
                                </td>
                                <td>{{ Str::limit($user->email, 90, ' ..') }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->created_at->format('h:i A F j, Y') }}</td>
                                <td>
                                    <img class="img-rounded img-fluid rounded" width="100px"
                                        src="{{ $user->avatar }}" alt="404">
                                </td>
                                <td>

                                    <form action="{{ route('posts.edit', $user->id) }}" method="get">
                                        <input class="btn btn-outline-info" type="submit" value="Edit">
                                    </form>

                                </td>
                                <td>

                                    <form action="{{ route('posts.destroy', $user->id) }}"
                                        method="user">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-outline-danger" type="submit" value="Delete">
                                    </form>

                                </td>
                            </tr>
                            @empty <h2>Users not found</h2>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{ $users->links('pagination::bootstrap-5') }}
@endsection


@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatable-script.js') }}"></script>
@endsection

</x-admin-master>
