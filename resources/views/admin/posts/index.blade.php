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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Created@</th>
                                    <th>Creator</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a
                                                href="{{ route('posts.show', $post->id) }}">{{ Str::limit($post->title, 30, ' ...') }}</a>
                                        </td>
                                        <td>{{ Str::limit($post->content, 90, ' ..') }}</td>
                                        <td>
                                            <img class="img-rounded img-fluid rounded" style="width:200px;height:200px;"
                                                src="{{ $post->post_image }}" alt="404">
                                        </td>
                                        <td>{{ $post->created_at->format('h:i A F j, Y') }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>

                                            @can('update', $post)
                                                <a class="btn btn-outline-info"
                                                    href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                            @else
                                                <button class="btn btn-outline-warning">
                                                    <abbr title="This post not belongs to your account">
                                                        Edit
                                                    </abbr>
                                                </button>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('delete', $post)
                                                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-outline-danger" type="submit" value="Delete">
                                                </form>
                                            @else
                                                <button class="btn btn-outline-warning">
                                                    <abbr title="This post not belongs to your account">
                                                        Delete
                                                    </abbr>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $posts->links('pagination::bootstrap-5') }}
        @endsection


        @section('scripts')
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('js/datatable-script.js') }}"></script>
        @endsection

</x-admin.admin-master>
