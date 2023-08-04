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

                    <a href="{{ route('public.posts.show', $post->id) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $post->created_at->diffForHumans() }} by
                    {{-- Posted on {{ $post->created_at->format('F j, Y') }} by --}}
                    <a href="#">{{ $post->user->name }}</a>
                </div>
            </div>
        @endforeach
        {{ $posts->links('pagination::bootstrap-5') }}
    @endsection
</x-home-master>
