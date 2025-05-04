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
                    @if($post->text)
                        <p class="mb-4 text-gray-800">{{ $post->text }}</p>
                    @endif
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
                            <span id="comment_count_{{ $post->id }}">Comment ({{ $post->comments_count ?? 0 }})</span>
                        </button>
                        <form action="posts/{{$post->id}}/save" method="post" >
                            @csrf
                            <button class="flex items-center hover:text-blue-500 px-2 py-1 rounded transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                </svg>

                                <span>Save</span>
                            </button>
                        </form>


                    </div>

                    <!-- Comment Form (Initially Hidden) -->
                    <div id="comment-form-{{ $post->id }}" class="comment-form mt-3 pt-3 border-t hidden">
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-start comment-ajax-form">
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

                            <!-- Latest Comment -->
                            @php
                                $latestComment = $post->comments->sortByDesc('created_at')->first();
                            @endphp
                            <div id="latest-comment-{{ $post->id }}" class="comment flex mb-3">
                                <img src="{{ asset('storage/' . $latestComment->user->profile_photo_path) }}"
                                     alt="User Profile"
                                     class="w-8 h-8 rounded-full mr-2">
                                <div class="bg-gray-100 rounded-lg py-2 px-3 flex-grow">
                                    <div class="font-medium text-sm">{{ $latestComment->user->name }}</div>
                                    <p class="text-sm text-gray-700">{{ $latestComment->content }}</p>
                                    <div class="text-xs text-gray-500 mt-1">{{ $latestComment->created_at->diffForHumans() }}</div>
                                </div>
                                @auth
                                    @if(Auth::user()->role_id == 1)
                                        <form action="{{ route('comments.destroy', $latestComment->id) }}" method="POST" class="ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>

                            <!-- Hidden Comments -->
                            @if(count($post->comments) > 1)
                                <div class="hidden-comments-{{ $post->id }} hidden">
                                    @foreach($post->comments->sortByDesc('created_at')->slice(1) as $comment)
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

                                <!-- Show All Comments Button -->
                                <button
                                    class="text-sm text-blue-500 hover:text-blue-600 font-medium show-comments-btn"
                                    data-post-id="{{ $post->id }}"
                                    onclick="toggleComments({{ $post->id }})"
                                >
                                    Show all {{ count($post->comments) }} comments
                                </button>
                            @endif
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
    function toggleComments(postId) {
        const hiddenComments = document.querySelector(`.hidden-comments-${postId}`);
        const button = document.querySelector(`button[data-post-id="${postId}"]`);

        if (hiddenComments.classList.contains('hidden')) {
            hiddenComments.classList.remove('hidden');
            button.textContent = `Hide comments`;
        } else {
            hiddenComments.classList.add('hidden');
            button.textContent = `Show all ${hiddenComments.querySelectorAll('.comment').length + 1} comments`;
        }
    }

    // Add AJAX functionality for comment submission
    document.addEventListener('DOMContentLoaded', function() {
        // Add submit event to comment forms
        const commentForms = document.querySelectorAll('.comment-ajax-form');
        commentForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formAction = this.getAttribute('action');
                const textArea = this.querySelector('textarea[name="text"]');
                const commentText = textArea.value;
                const token = this.querySelector('input[name="_token"]').value;
                const postId = formAction.split('/').pop();

                if (!commentText.trim()) return;

                // Disable the submit button to prevent double submission
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;

                // Use fetch to submit the comment
                fetch(formAction, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        text: commentText
                    })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Reset form
                        textArea.value = '';
                        submitButton.disabled = false;

                        // Update comment count
                        const commentCountElement = document.getElementById(`comment_count_${postId}`);
                        if (commentCountElement) {
                            const currentCount = parseInt(data.comments_count || 1);
                            commentCountElement.textContent = `Comment (${currentCount})`;
                        }

                        // Create new comment HTML
                        const newComment = `
                        <div class="comment flex mb-3">
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                 alt="User Profile"
                                 class="w-8 h-8 rounded-full mr-2">
                            <div class="bg-gray-100 rounded-lg py-2 px-3 flex-grow">
                                <div class="font-medium text-sm">{{ $user->name }}</div>
                                <p class="text-sm text-gray-700">${commentText}</p>
                                <div class="text-xs text-gray-500 mt-1">Just now</div>
                            </div>
                            ${data.can_delete ? `
                                <form action="/comments/${data.comment_id}" method="POST" class="ml-2">
                                    @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                    </form>
` : ''}
                        </div>
                    `;

                        // Get the comments container
                        let commentsContainer = form.closest('.post-item').querySelector('.comments-container');

                        // If comments container doesn't exist, create it
                        if (!commentsContainer) {
                            const postContainer = form.closest('.p-4');
                            commentsContainer = document.createElement('div');
                            commentsContainer.className = 'comments-container mt-3 pt-3 border-t';
                            commentsContainer.innerHTML = '<h4 class="text-sm font-medium text-gray-700 mb-2">Comments</h4>';
                            postContainer.appendChild(commentsContainer);
                        }

                        // Get the latest comment element
                        const latestCommentElement = document.getElementById(`latest-comment-${postId}`);

                        if (latestCommentElement) {
                            // If there was already a comment, move the old latest to hidden comments
                            let hiddenCommentsContainer = form.closest('.post-item').querySelector(`.hidden-comments-${postId}`);

                            if (!hiddenCommentsContainer) {
                                // Create hidden comments container if it doesn't exist
                                hiddenCommentsContainer = document.createElement('div');
                                hiddenCommentsContainer.className = `hidden-comments-${postId} hidden`;
                                commentsContainer.appendChild(hiddenCommentsContainer);

                                // Create show all button
                                const showAllButton = document.createElement('button');
                                showAllButton.className = 'text-sm text-blue-500 hover:text-blue-600 font-medium show-comments-btn';
                                showAllButton.setAttribute('data-post-id', postId);
                                showAllButton.setAttribute('onclick', `toggleComments(${postId})`);
                                showAllButton.textContent = `Show all 2 comments`;
                                commentsContainer.appendChild(showAllButton);
                            } else {
                                // Update the show all button text
                                const showAllButton = form.closest('.post-item').querySelector(`button[data-post-id="${postId}"]`);
                                const commentCount = hiddenCommentsContainer.querySelectorAll('.comment').length + 2; // +2 for the old latest and new comment
                                showAllButton.textContent = `Show all ${commentCount} comments`;
                            }

                            // Move the old latest comment to hidden comments
                            hiddenCommentsContainer.insertAdjacentHTML('afterbegin', latestCommentElement.outerHTML);

                            // Replace the latest comment with the new one
                            latestCommentElement.outerHTML = newComment;
                        } else {
                            // This is the first comment, just add it
                            const newCommentElement = document.createElement('div');
                            newCommentElement.id = `latest-comment-${postId}`;
                            newCommentElement.innerHTML = newComment;
                            commentsContainer.appendChild(newCommentElement);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        submitButton.disabled = false;
                        alert('Failed to add comment. Please try again.');
                    });
            });
        });
    });
</script>
