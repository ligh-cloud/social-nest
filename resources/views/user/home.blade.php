@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <!-- Feed Content -->
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-t-lg shadow-sm w-full lg:w-4/5 lg:ml-[20%]">
        @csrf

        <div class="p-4">
            <!-- User Info and Text Input -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('storage/profile/profile.jpg') }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">

                <div class="bg-gray-100 rounded-full flex-grow">
                    <input
                        type="text"
                        name="text"
                        placeholder="What's on your mind?"
                        class="post-input w-full py-2 px-4 bg-transparent rounded-full focus:outline-none"
                        required
                    >
                </div>
            </div>

            <!-- Media Upload = -->
            <div class="flex flex-wrap justify-between items-center">

                <!-- Media Upload -->
                <label for="media" class="flex items-center p-2 text-gray-600 hover:bg-gray-100 rounded-lg cursor-pointer transition mb-2 sm:mb-0">
                    <i class="fas fa-image mr-2"></i>
                    <span>Add media</span>
                    <input type="file" name="media" id="media" class="hidden">
                </label>

                <!-- privacy -->
                <div class="flex items-center">
                    <select name="privacy" class="p-2 bg-gray-100 rounded-lg text-gray-700">
                        <option value="">Select category</option>
                        <option value="public">Public</option>
                        <option value="friends">Friends</option>
                        <option value="private">Private</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="ml-auto mt-2 sm:mt-0">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Post
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="mt-4" id="post-container">


        @if(count($posts) > 0)
            @foreach($posts as $post)
                @if($post->privacy == 'public')
                <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center mb-3">
                            <img src="{{ $user->image ? asset('storage/profile/' . $post->user->profile_image) : asset('images/default-avatar.jpg') }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                            <div>
                                <div class="font-medium">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <p class="mb-4">{{ $post->content }}</p>

                        @if($post->image)
                            <div class="w-full h-64 rounded-lg mb-3 overflow-hidden">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-full object-cover">
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
                @endif
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
