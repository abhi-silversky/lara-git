<x-admin-master>



    @section('content')
        <h1>Create Post</h1>
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
    @endsection



</x-admin-master>
