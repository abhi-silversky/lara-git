<x-admin.admin-master>

    @section('content')
        <h3 class="text-left">
            Roles List
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>slug</th>
                                <th>Created@</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    <td>{{ $role->slug }}</td>
                                    <td>{{ $role->created_at->format('h:i A F j, Y') }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $roles->links('pagination::bootstrap-5') }}
    @endsection


    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/datatable-script.js') }}"></script>
    @endsection

</x-admin.admin-master>
