@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <!-- Feed Content -->
    <div class="mt-4" id="post-container">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center mb-3">
                            <img src="{{ $post->user->profile_image ? asset('storage/profile/' . $post->user->profile_image) : asset('images/default-avatar.jpg') }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                            <div>
                                <div class="font-medium">{{ $post->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <p class="mb-4">{{ $post->content }}</p>

                        @if($post->image)
                            <div class="w-full h-64 rounded-lg mb-3 overflow-hidden">
                                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="Post Image" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="flex justify-between text-gray-500 text-sm pt-2 border-t">
                            <button class="flex items-center hover:text-blue-500">
                                <i class="far fa-thumbs-up mr-1"></i>
                                <span>Like ({{ $post->likes_count ?? 0 }})</span>
                            </button>
                            <button class="flex items-center hover:text-blue-500">
                                <i class="far fa-comment mr-1"></i>
                                <span>Comment ({{ $post->comments_count ?? 0 }})</span>
                            </button>
                            <button class="flex items-center hover:text-blue-500">
                                <i class="far fa-share-square mr-1"></i>
                                <span>Share</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-500">No posts available. Follow more users or create a post!</p>
            </div>
        @endif
    </div>

    <!-- Loading indicator for infinite scroll -->
    <div id="loading" class="text-center p-4 hidden">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Add any page-specific scripts -->
    <script>
        // Example of page-specific JavaScript
        console.log('Home page loaded');

        // Infinite scroll JavaScript
        let page = 1;
        let loading = false;

        document.addEventListener('scroll', () => {
            const nearBottom = window.innerHeight + window.scrollY >= document.body.offsetHeight - 200;
            if (!loading && nearBottom) {
                loading = true;
                page++;
                fetchMorePosts(page);
            }
        });

        function fetchMorePosts(page) {
            document.getElementById('loading').classList.remove('hidden');

            fetch(`?page=${page}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === '') {
                        document.getElementById('loading').innerHTML = 'No more posts';
                        return;
                    }

                    document.getElementById('post-container').insertAdjacentHTML('beforeend', data);
                    document.getElementById('loading').classList.add('hidden');
                    loading = false;
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById('loading').innerHTML = "Something went wrong.";
                });
        }
    </script>
@endpush
