<x-admin-master>

    @section('content')
        <h3 class="text-left">All posts</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Created@</th>
                                    <th>Creator</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Created@</th>
                                    <th>Creator</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit($post->title, 30, ' ...') }}</td>
                                        <td>{{ Str::limit($post->content, 90, ' ..') }}</td>
                                        <td>
                                            <img class="img-rounded" height="100px" width="100px"
                                                src="{{ $post->post_image }}" alt="404">
                                        </td>
                                        <td>{{ $post->created_at->format('h:i A F j, Y') }}</td>
                                        <td>{{ $post->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection


        @section('scripts')
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('js/datatable-script.js') }}"></script>
        @endsection

</x-admin-master>
