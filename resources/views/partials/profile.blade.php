@if (!$posts->isEmpty())
    @foreach ($posts as $post)
        @if ($post->privacy === 'public')
            <div class="bg-white rounded-lg shadow-sm overflow-hidden post-item mb-6">
                <div class="p-4">
                    <!-- Post Header -->
                    <div class="flex items-center mb-3">
                        <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                        <div>
                            <div class="font-medium">{{ $post->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <p class="mb-4 text-gray-800">{{ $post->content }}</p>

                    <!-- Post Image -->
                    @if ($post->image)
                        @php
                            $mediaPath = storage_path('app/public/' . $post->image);
                            $extension = pathinfo($mediaPath, PATHINFO_EXTENSION);
                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                            $videoExtensions = ['mp4', 'webm', 'ogg'];
                        @endphp

                        <div class="w-full rounded-lg mb-3 overflow-hidden border border-gray-200">
                            @if (in_array(strtolower($extension), $imageExtensions))
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full max-h-96 object-contain">
                            @elseif (in_array(strtolower($extension), $videoExtensions))
                                <video controls class="w-full max-h-96 object-contain">
                                    <source src="{{ asset('storage/' . $post->image) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <p class="text-gray-500 text-sm">Unsupported media format.</p>
                            @endif
                        </div>
                    @endif


                    <!-- Post Actions -->
                    <div class="flex justify-between text-gray-500 text-sm pt-3 border-t">
                        <!-- Like Button -->
                        <button
                            class="like_btn flex items-center px-2 py-1 rounded transition {{ $post->likes_status ? 'text-blue-500' : 'hover:text-blue-500' }}"
                            data-id="{{ $post->id }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="{{ $post->likes_status ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                            </svg>
                            <span id="like_count_{{ $post->id }}">{{ $post->likes_status ? 'Liked' : 'Like' }} ({{ $post->likes_count }})</span>
                        </button>

                        <!-- Comment Button -->
                        <button class="comment_btn flex items-center hover:text-blue-500 px-2 py-1 rounded transition" data-id="{{ $post->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span>Comment ({{ $post->comments_count ?? 0 }})</span>
                        </button>

                        <!-- Save Button -->
                        <form action="/posts/{{ $post->id }}/save" method="POST">
                            @csrf
                            <button class="flex items-center hover:text-blue-500 px-2 py-1 rounded transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                </svg>
                                <span>Save</span>
                            </button>
                        </form>
                    </div>

                    <!-- Comment Form -->
                    <div id="comment-form-{{ $post->id }}" class="comment-form mt-3 pt-3 border-t hidden">
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-start">
                            @csrf
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Profile" class="w-8 h-8 rounded-full mr-2 mt-1">
                            <div class="flex-grow">
                                <textarea name="text" placeholder="Write a comment..." class="w-full py-2 px-3 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 transition resize-none" rows="2" required></textarea>
                                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-1 px-4 rounded-lg transition duration-200">
                                    Comment
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Comments Display -->
                    @if (isset($post->comments) && count($post->comments) > 0)
                        <div class="comments-container mt-3 pt-3 border-t">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Comments</h4>
                            @foreach ($post->comments as $comment)
                                <div class="comment flex mb-3">
                                    <img src="{{ asset('storage/' . $comment->user->profile_photo_path) }}" alt="User Profile" class="w-8 h-8 rounded-full mr-2">
                                    <div class="bg-gray-100 rounded-lg py-2 px-3 flex-grow">
                                        <div class="font-medium text-sm">{{ $comment->user->name }}</div>
                                        <p class="text-sm text-gray-700">{{ $comment->content }}</p>
                                        <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                    @auth
                                        @if(Auth::user()->role_id == 1)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <p class="text-gray-500">No posts available. Follow more users or create a post!</p>
    </div>
@endif
<script>

        const csrfToken = '{{ csrf_token() }}'; // Include CSRF token for AJAX

        document.addEventListener('DOMContentLoaded', function () {
        attachLikeHandlers();
        attachCommentHandlers();
    });

        function attachLikeHandlers() {
        document.querySelectorAll('.like_btn').forEach(button => {
            button.addEventListener('click', handleLikeClick);
        });
    }

        function handleLikeClick(e) {
        e.preventDefault();
        const button = this;
        const postId = button.getAttribute('data-id');

        fetch('/post/like', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
    },
        body: JSON.stringify({ post_id: postId })
    })
        .then(res => res.json())
        .then(data => {
        const countSpan = button.querySelector('span');
        const svg = button.querySelector('svg');
        if (data.liked) {
        countSpan.textContent = `Liked (${data.count})`;
        button.classList.add('text-blue-500');
        if (svg) svg.setAttribute('fill', 'currentColor');
    } else {
        countSpan.textContent = `Like (${data.count})`;
        button.classList.remove('text-blue-500');
        if (svg) svg.setAttribute('fill', 'none');
    }
    })
        .catch(() => alert('Like failed. Try again.'));
    }

        function attachCommentHandlers() {
        document.querySelectorAll('.comment_btn').forEach(button => {
            button.addEventListener('click', function () {
                const postId = this.getAttribute('data-id');
                const form = document.getElementById(`comment-form-${postId}`);
                form.classList.toggle('hidden');
                if (!form.classList.contains('hidden')) {
                    form.querySelector('textarea').focus();
                }
            });
        });
    }


</script>
