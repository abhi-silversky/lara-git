<x-admin.admin-master>

    @section('content')
        <h1>Update Post</h1>
        @if (session()->has('message'))
            <div class="alert alert-success">
                <h3>{{ session('message') }}</h3>
            </div>
        @endif
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class=form-group>
                <label for="title">Title:</label><br />
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Enter title" value="{{ $post->title }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class=form-group>
                <img width="400px" src="{{ $post->post_image }}" alt="404"><br>
                <label for="post_image">Image:</label><br />
                <input type="file" name="post_image" class="form-control @error('post_image') is-invalid @enderror">
                @error('post_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class=form-group>
                <label for="content">Content:</label><br />
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="5"
                    placeholder="Enter Content">{{ $post->content }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @can('update', $post)
                <input type="submit" value="Update Post" class='btn btn-outline-primary'>
            @endcan
        </form>


        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @endsection





</x-admin.admin-master>
