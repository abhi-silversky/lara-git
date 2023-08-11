<x-admin.admin-master>



    @section('content')
        <h1>Create Post</h1>
        @if (session()->has('message'))
            <div class="alert alert-success">
                <h3>{{ session('message') }}</h3>
            </div>
        @endif
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class=form-group>
                <label for="title">Title:</label><br />
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class=form-group>
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
                    placeholder="Enter Content">{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input type="submit" value="Create Post" class='btn btn-outline-primary'>

        </form>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @endsection



</x-admin.admin-master>
