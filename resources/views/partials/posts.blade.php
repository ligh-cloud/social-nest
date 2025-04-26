@if(count($posts) > 0)
    @foreach($posts as $post)
        @if($post->privacy == 'public')
            <div class="bg-white rounded-lg shadow-sm overflow-hidden post-item">
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
                        <button
                            class="like_btn flex items-center px-2 py-1 rounded transition {{ $post->likes_status ? 'text-blue-500' : 'hover:text-blue-500' }}"
                            data-id="{{ $post->id }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5 mr-1"
                                 fill="{{ $post->likes_status ? 'currentColor' : 'none' }}"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                            </svg>

                            <span id="like_count_{{ $post->id }}">
                                {{ $post->likes_status ? 'Liked' : 'Like' }} ({{ $post->likes_count }})
                            </span>
                        </button>
                        <button
                            class="comment_btn flex items-center hover:text-blue-500 px-2 py-1 rounded transition"
                            data-id="{{ $post->id }}"
                        >
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

                    <!-- Comment Form (Initially Hidden) -->
                    <div id="comment-form-{{ $post->id }}" class="comment-form mt-3 pt-3 border-t hidden">
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-start">
                            @csrf
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                 alt="User Profile"
                                 class="w-8 h-8 rounded-full mr-2 mt-1">
                            <div class="flex-grow">
                                <textarea
                                    name="text"
                                    placeholder="Write a comment..."
                                    class="w-full py-2 px-3 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 transition resize-none"
                                    rows="2"
                                    required
                                ></textarea>
                                <button type="submit"
                                        class="mt-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-1 px-4 rounded-lg transition duration-200">
                                    Comment
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Display Comments -->
                    @if(isset($post->comments) && count($post->comments) > 0)
                        <div class="comments-container mt-3 pt-3 border-t">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Comments</h4>
                            @foreach($post->comments as $comment)
                                <div class="comment flex mb-3">
                                    <img src="{{ asset('storage/' . $comment->user->profile_photo_path) }}"
                                         alt="User Profile"
                                         class="w-8 h-8 rounded-full mr-2">
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
