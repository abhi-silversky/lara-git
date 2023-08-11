<x-admin.admin-master>

    @section('content')
        <h3 class="text-left">
            @if (auth()->user()->userHasRole('admin'))
                All posts
            @else
                My posts
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
                        <table class="table" id="posts" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Creator</th>
                                    <th>Created@</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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
                    $('#posts').dataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('posts.index') !!}',
                        columns: [{
                                data: "DT_RowIndex",
                                orderable: false,
                                searchable: false,
                            },
                            {
                                data: "title",
                                name: "title"
                            },
                            {
                                data: "content",
                                name: "content"
                            },
                            {
                                data: "post_image",
                                name: "post_image",
                                render: function(data, type, full, meta) {
                                    return '<img src="' + data + '" alt="Not Available" width="100">';
                                },
                                orderable: false,
                                searchable: false,
                            },
                            {
                                data: "user.name",
                                name: "user.name",
                            },

                            {
                                data: "created_at",
                                name: "created_at",
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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"
                integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        @endpush
</x-admin.admin-master>
