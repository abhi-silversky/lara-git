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
                                    <th class='text-center center-text'>Sr.</th>
                                    <th class='text-center center-text'>Title</th>
                                    <th class='text-center center-text'>Content</th>
                                    <th class='text-center center-text'>Image</th>
                                    <th class='text-center center-text'>Creator</th>
                                    <th class='text-center center-text'>Created@</th>
                                    <th class='text-center center-text'>Edit</th>
                                    <th class='text-center cen-cell'>Delete</th>
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
                        @if (Route::currentRouteName() === 'posts.index')
                            ajax: '{!! route('posts.index') !!}',
                        @else
                            ajax: '{!! route('posts.my') !!}',
                        @endif
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
                                data: "image",
                                name: "image",
                                // render: function(data, type, full, meta) {
                                //     return '<img src="' + data + '" alt="Not Available" width="100">';
                                // },
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
            {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
        @endpush
</x-admin.admin-master>
