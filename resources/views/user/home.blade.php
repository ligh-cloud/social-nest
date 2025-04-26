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
            @include('partials.posts', ['posts' => $posts, 'user' => $user])
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
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            let page = 1;
            let loading = false;
            let hasMore = true;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content') || "{{ csrf_token() }}";

            // Initial setup of like buttons
            attachLikeHandlers();

            // Initial setup of comment buttons
            attachCommentHandlers();

            // Handle infinite scroll
            window.addEventListener('scroll', () => {
                if (loading || !hasMore) return;

                const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

                // Check if we're near the bottom of the page (within 200px)
                if (scrollTop + clientHeight >= scrollHeight - 200) {
                    console.log('Near bottom of page, loading more posts...');
                    loadMorePosts();
                }
            });

            // Function to handle like button clicks
            function attachLikeHandlers() {
                const likeBtns = document.querySelectorAll('.like_btn');
                likeBtns.forEach(button => {
                    // Remove any existing event listeners to prevent duplicates
                    button.removeEventListener('click', handleLikeClick);
                    // Add new event listener
                    button.addEventListener('click', handleLikeClick);
                });
            }

            // Function to handle comment button clicks
            function attachCommentHandlers() {
                const commentBtns = document.querySelectorAll('.comment_btn');
                commentBtns.forEach(button => {
                    // Remove any existing event listeners to prevent duplicates
                    button.removeEventListener('click', handleCommentClick);
                    // Add new event listener
                    button.addEventListener('click', handleCommentClick);
                });
            }

            // Handler function for comment button clicks
            function handleCommentClick() {
                const postId = this.getAttribute('data-id');
                const commentForm = document.getElementById(`comment-form-${postId}`);

                // Toggle the form's visibility
                if (commentForm.classList.contains('hidden')) {
                    commentForm.classList.remove('hidden');
                    // Focus on the comment textarea
                    commentForm.querySelector('textarea').focus();
                } else {
                    commentForm.classList.add('hidden');
                }
            }

            // Handler function for like button clicks
            function handleLikeClick() {
                const button = this;
                const postId = button.getAttribute('data-id');
                console.log('Like button clicked for post:', postId);

                fetch('/post/like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ post_id: postId })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Like response:', data);
                        // Find the like count span within this specific button
                        const countSpan = button.querySelector('span');
                        if (data.liked) {
                            countSpan.textContent = `Liked (${data.count})`;
                            button.classList.add('text-blue-500');
                            // Update the SVG fill
                            const svg = button.querySelector('svg');
                            if (svg) svg.setAttribute('fill', 'currentColor');
                        } else {
                            countSpan.textContent = `Like (${data.count})`;
                            button.classList.remove('text-blue-500');
                            // Update the SVG fill
                            const svg = button.querySelector('svg');
                            if (svg) svg.setAttribute('fill', 'none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error processing your like. Please try again.');
                    });
            }

            function loadMorePosts() {
                if (loading || !hasMore) return;

                loading = true;
                document.getElementById('loading').classList.remove('hidden');

                // Get the current path and add the necessary query parameters
                const currentPath = window.location.pathname;
                const endpoint = `${currentPath}?page=${page + 1}&per_page=5`;

                console.log('Fetching more posts from:', endpoint);

                fetch(endpoint, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        console.log('Response status:', response.status);

                        if (!response.ok) {
                            throw new Error(`Network response was not ok: ${response.status}`);
                        }

                        return response.json();
                    })
                    .then(data => {
                        console.log('Received data');

                        // Check if we have HTML content to append
                        if (!data.html || data.html.trim() === '') {
                            console.log('No more posts to load');
                            hasMore = false;
                            document.getElementById('loading').innerHTML = '<p class="text-gray-500">No more posts</p>';
                            loading = false;
                            return;
                        }

                        // Create a temporary container and append the HTML
                        const tempContainer = document.createElement('div');
                        tempContainer.innerHTML = data.html.trim();

                        // Check if the response contains post items
                        const newPosts = tempContainer.querySelectorAll('.post-item');
                        console.log('Found new posts:', newPosts.length);

                        if (newPosts.length === 0) {
                            hasMore = false;
                            document.getElementById('loading').innerHTML = '<p class="text-gray-500">No more posts</p>';
                        } else {
                            // We found posts, so append them
                            document.getElementById('post-container').insertAdjacentHTML('beforeend', data.html);

                            // If we got fewer posts than asked for, assume we're at the end
                            if (newPosts.length < 5) {
                                hasMore = false;
                            }
                        }

                        // Attach event handlers to newly loaded content
                        attachLikeHandlers();
                        attachCommentHandlers();

                        // Increment the page number for the next request
                        page++;
                        loading = false;
                        document.getElementById('loading').classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error loading more posts:', error);
                        document.getElementById('loading').innerHTML = '<p class="text-red-500">Error loading posts. <button id="retry-btn" class="underline">Retry</button></p>';

                        // Add retry button functionality
                        document.getElementById('retry-btn')?.addEventListener('click', () => {
                            document.getElementById('loading').innerHTML = '';
                            document.getElementById('loading').classList.add('hidden');
                            loading = false;
                            loadMorePosts();
                        });

                        loading = false;
                    });
            }
        });
    </script>
@endpush
