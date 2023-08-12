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
                                <th class='text-center'>Sr.</th>
                                <th class='text-center'>Name</th>
                                <th class='text-center'>Email</th>
                                <th class='text-center'>Username</th>
                                <th class='text-center'>Created@</th>
                                <th class='text-center'>Avatar</th>
                                <th class='text-center'>Edit</th>
                                <th class='text-center'>Delete</th>
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
                $('#users').dataTable({
                    processing: false,
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
