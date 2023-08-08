<x-admin.admin-master>

    @section('content')
        <div class="row">
            <div class="col-sm-3">
                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <label class="form-group" for="name">Permission Name</label><br>
                    <input class="form-group @error('name') is-invalid  @enderror" type="text" name="name" id="name">
                    @error('name')
                        <span class="invalid-feedback mb-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror()
                    <input class="btn  btn-outline-info mb-4" type="submit" value="Create">
                </form>
            </div>
        </div>
        <!-- DataTales Example -->
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
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>slug</th>
                                <th>Created@</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a
                                            href="{{ route('permissions.edit', $permission->id) }}">{{ $permission->name }}</a>
                                    </td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>{{ $permission->created_at->format('h:i A F j, Y') }}</td>
                                    <td>
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='btn btn-outline-danger'>Delete</button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $permissions->links('pagination::bootstrap-5') }}
    @endsection


    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/datatable-script.js') }}"></script>

        <script src="{{ asset('js\collapseMenu\authorize.js') }}"></script>
    @endsection

</x-admin.admin-master>
