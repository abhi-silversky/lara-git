<x-home-master>
    @section('content')
        <h1 class="my-4">Posts List
        </h1>


        <!-- Blog Post -->
        @foreach ($posts as $post)
            <div class="card mb-4">
                <img class="card-img-top" height="500px" width="500px" src="{{ $post->post_image }}" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ Str::limit($post->title, 100, ' . . .') }}</h2>
                    <p class="card-text">{{ Str::limit($post->content, 125, ' . . .') }}</p>

                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $post->created_at->diffForHumans() }} by
                    {{-- Posted on {{ $post->created_at->format('F j, Y') }} by --}}
                    <a href="#">{{ $post->user->name }}</a>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>
    @endsection
</x-home-master>
