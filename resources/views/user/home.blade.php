@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <!-- Main Content Container -->
    <div class="w-full lg:w-4/5 lg:ml-[20%]">
        <!-- Post Creation Form -->
        <div class="bg-white rounded-lg shadow-sm mb-4">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-4">
                    <!-- User Info and Text Input -->
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                             alt="User Profile"
                             class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200">

                        <div class="flex-grow">
                            <input
                                type="text"
                                name="text"
                                placeholder="What's on your mind, {{ $user->name }}?"
                                class="w-full py-3 px-4 bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-200 transition"
                                required
                            >
                        </div>
                    </div>

                    <!-- Media Upload and Options -->
                    <div class="flex flex-wrap items-center justify-between pt-3 border-t">
                        <!-- Media Upload Button -->
                        <label for="media" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg cursor-pointer transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium">Photo/Video</span>
                            <input type="file" name="media" id="media" class="hidden" accept="image/*,video/*">
                        </label>

                        <!-- Privacy Dropdown -->
                        <div class="relative">
                            <select name="privacy" class="appearance-none bg-gray-100 border-0 rounded-lg py-2 pl-3 pr-8 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                                <option value="public">🌍 Public</option>
                                <option value="friends">👥 Friends</option>
                                <option value="private">🔒 Private</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200 ml-auto">
                            Post
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Posts Container -->
        <div id="post-container" class="space-y-4">
            @if(count($posts) > 0)
                @foreach($posts as $post)
                    @if($post->privacy == 'public')
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden post-item">
                            <div class="p-4">
                                <!-- Post Header -->
                                <div class="flex items-center mb-3">
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">

                                    <div>
                                        <div class="font-medium">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>

                                <!-- Post Content -->
                                <p class="mb-4 text-gray-800">{{ $post->content }}</p>

                                <!-- Post Media -->
                                @if($post->image)
                                    <div class="w-full rounded-lg mb-3 overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $post->image) }}"
                                             alt="Post Image"
                                             class="w-full max-h-96 object-contain">
                                    </div>
                                @endif

                                <!-- Post Actions -->
                                <div class="flex justify-between text-gray-500 text-sm pt-3 border-t">
                                    <button class="flex items-center hover:text-blue-500 px-2 py-1 rounded transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        <span>Like ({{ $post->likes_count ?? 0 }})</span>
                                    </button>
                                    <button class="flex items-center hover:text-blue-500 px-2 py-1 rounded transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span>Comment ({{ $post->comments_count ?? 0 }})</span>
                                    </button>
                                    <button class="flex items-center hover:text-blue-500 px-2 py-1 rounded transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
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

        <!-- Loading indicator -->
        <div id="loading" class="text-center p-4 hidden">
            <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-blue-500 border-r-transparent" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let page = 1;
        let loading = false;
        let hasMore = true;

        window.addEventListener('scroll', () => {
            if (loading || !hasMore) return;

            const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
            if (scrollTop + clientHeight >= scrollHeight - 100) {
                loadMorePosts();
            }
        });

        function loadMorePosts() {
            if (loading || !hasMore) return;

            loading = true;
            document.getElementById('loading').classList.remove('hidden');

            // Update the URL to match your posts endpoint with per_page parameter
            const endpoint = window.location.pathname + '?page=' + (page + 1) + '&per_page=5';

            fetch(endpoint, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    // First check if the response is valid
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    // Check the content type header to decide how to parse
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            // If we get HTML directly, wrap it in an object to match our expected format
                            return { html: text };
                        });
                    }
                })
                .then(data => {
                    // Handle both formats - direct HTML string or JSON with html property
                    const htmlContent = typeof data === 'string' ? data : data.html;

                    if (!htmlContent || htmlContent.trim() === '') {
                        hasMore = false;
                        document.getElementById('loading').innerHTML = '<p class="text-gray-500">No more posts</p>';
                        return;
                    }

                    // Create a temporary container to parse the HTML
                    const tempContainer = document.createElement('div');
                    tempContainer.innerHTML = htmlContent;

                    // Find all post items in the response and add them to our container
                    const newPosts = tempContainer.querySelectorAll('.post-item');

                    if (newPosts.length === 0) {
                        // If we didn't find post items with the expected class, we may be at the end
                        if (htmlContent.includes('No more posts') || htmlContent.trim() === '') {
                            hasMore = false;
                            document.getElementById('loading').innerHTML = '<p class="text-gray-500">No more posts</p>';
                        } else {
                            // Otherwise append the whole HTML
                            document.getElementById('post-container').insertAdjacentHTML('beforeend', htmlContent);
                        }
                    } else {
                        // Track if we found any new posts to determine if there's more content
                        if (newPosts.length < 5) {
                            hasMore = false;
                        }

                        // Append each post separately
                        newPosts.forEach(post => {
                            // Check for duplicates by comparing post content or using data attributes
                            const postContent = post.querySelector('p').textContent;
                            const existingPosts = document.querySelectorAll('.post-item p');
                            let isDuplicate = false;

                            existingPosts.forEach(existingPost => {
                                if (existingPost.textContent === postContent) {
                                    isDuplicate = true;
                                }
                            });

                            if (!isDuplicate) {
                                document.getElementById('post-container').appendChild(post);
                            }
                        });
                    }

                    page++;
                    loading = false;
                    document.getElementById('loading').classList.add('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loading').innerHTML = '<p class="text-red-500">Error loading posts</p>';
                    loading = false;
                });
        }
    </script>
@endpush
