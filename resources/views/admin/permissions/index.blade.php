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
                    <table class="table table-bordered" id="permissions" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class = 'text-center'>Sr.</th>
                                <th class = 'text-center'>Name</th>
                                <th class = 'text-center'>slug</th>
                                <th class = 'text-center'>Created@</th>
                                <th class = 'text-center'>Delete</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
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
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    @endsection


    @push('yajra-scripts')
        <script>
            $(document).ready(function() {
                $('#permissions').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.permissions.index') !!}',
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
                            data: "slug",
                            name: "slug"
                        },
                        {
                            data: "created_at",
                            name: "created_at",
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    @endpush

</x-admin.admin-master>
