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
                            <table class="table table-bordered" id="permissions" width="100%" cellspacing="0">
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
                            </table>
                        </div>
                    </div>
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
                    ajax: '{!! route('admin.roles.edit', $role->id) !!}',
                    columns: [{
                            data: "DT_RowIndex",
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: "status",
                            name: "status",
                            orderable: false,
                            searchable: false,
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
