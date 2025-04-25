@extends('layouts.layout')

@section('content')
    <div class="bg-white rounded-lg shadow-sm w-full lg:w-3/5 lg:ml-[20%] py-4">
        <div class="container mx-auto px-4">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('home') }}" class="flex items-center text-blue-500 hover:underline">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Feed
                </a>
            </div>

            <!-- Single Post Card -->
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
        </div>
    </div>

    <!-- Notification Bell Button -->
    <div class="fixed top-4 right-4 z-50">
        <button id="notification-toggle" class="relative p-2 text-gray-600 hover:text-blue-500 focus:outline-none bg-white rounded-full shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>

            <!-- Notification Counter -->
            <span id="notification-counter" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full {{ Auth::user()->unreadNotifications->count() > 0 ? '' : 'hidden' }}">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        </button>
    </div>

    <!-- Notification Dropdown -->
    <div id="notification-dropdown" class="fixed right-4 top-16 w-80 bg-white rounded-lg shadow-lg overflow-hidden z-50 hidden">
        <div class="py-2 px-3 bg-gray-100 border-b">
            <h3 class="text-sm font-medium text-gray-700">Notifications</h3>
        </div>
        <div id="notification-list" class="max-h-64 overflow-y-auto">
            <!-- Notifications will be loaded here via AJAX -->
        </div>
        <div class="p-2 bg-gray-50 border-t text-center">
            <a href="{{ route('notifications.index') }}" class="text-sm text-blue-500 hover:underline">View all notifications</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
    <script>
        function likePost(postId) {
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to like post');
                    return response.json();
                })
                .then(data => {
                    document.getElementById(`likes-count-${postId}`).textContent = data.likesCount;
                    const likeButton = document.getElementById(`like-button-${postId}`);
                    if (data.liked) {
                        likeButton.classList.add('text-blue-500');
                    } else {
                        likeButton.classList.remove('text-blue-500');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function focusCommentInput(postId) {
            document.getElementById(`comment-input-${postId}`).focus();
        }

        function deleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to delete comment');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`comment-${commentId}`).remove();
                            const commentsCount = document.getElementById(`comments-count-${data.post_id}`);
                            if (commentsCount) {
                                commentsCount.textContent = parseInt(commentsCount.textContent) - 1;
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Handle comment form submission
        document.querySelectorAll('[id^="comment-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const postId = this.id.split('-').pop();

                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to post comment');
                        return response.json();
                    })
                    .then(data => {
                        if (data.comment) {
                            const commentsContainer = document.getElementById(`comments-container-${postId}`);
                            const commentInput = document.getElementById(`comment-input-${postId}`);

                            // Create new comment element
                            const commentElement = document.createElement('div');
                            commentElement.className = 'flex mb-3';
                            commentElement.id = `comment-${data.comment.id}`;
                            commentElement.innerHTML = `
                            <img src="${data.comment.user.profile_photo_url}"
                                 alt="${data.comment.user.name}"
                                 class="w-8 h-8 rounded-full mr-2">
                            <div class="bg-white rounded-lg px-3 py-2 flex-grow">
                                <div class="font-medium text-sm">${data.comment.user.name}</div>
                                <p class="text-gray-800 text-sm">${data.comment.content}</p>
                                <div class="text-xs text-gray-500 mt-1">just now</div>
                            </div>
                            <div class="ml-2">
                                <button class="text-gray-400 hover:text-gray-600" onclick="deleteComment(${data.comment.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;

                            // Prepend new comment
                            commentsContainer.prepend(commentElement);

                            // Update comments count
                            const commentsCount = document.getElementById(`comments-count-${postId}`);
                            if (commentsCount) {
                                commentsCount.textContent = parseInt(commentsCount.textContent) + 1;
                            }

                            // Clear input
                            commentInput.value = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Notification System
        document.addEventListener('DOMContentLoaded', function() {
            const notificationToggle = document.getElementById('notification-toggle');
            const notificationDropdown = document.getElementById('notification-dropdown');
            const notificationCounter = document.getElementById('notification-counter');
            const notificationList = document.getElementById('notification-list');

            function loadNotifications() {
                fetch('/notifications/get-unread')
                    .then(response => response.json())
                    .then(data => {
                        updateNotificationList(data.notifications);
                        updateCounter(data.notifications.length);
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateNotificationList(notifications) {
                notificationList.innerHTML = notifications.length === 0 ?
                    '<div class="p-4 text-center text-gray-500 text-sm">No notifications yet</div>' :
                    notifications.map(notification => `
                        <div class="flex items-center p-3 border-b hover:bg-gray-50 transition ${notification.read_at ? '' : 'bg-blue-50'}">
                            <div class="flex-shrink-0 mr-3">
                                <img src="${notification.data.user_image || '/images/default-avatar.png'}"
                                     alt="" class="w-10 h-10 rounded-full">
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-medium">${notification.data.message}</p>
                                <p class="text-xs text-gray-500 mt-1">${new Date(notification.created_at).toLocaleTimeString()}</p>
                            </div>
                        </div>
                    `).join('');
            }

            function updateCounter(count) {
                if (count > 0) {
                    notificationCounter.textContent = count;
                    notificationCounter.classList.remove('hidden');
                } else {
                    notificationCounter.classList.add('hidden');
                }
            }

            if (notificationToggle) {
                notificationToggle.addEventListener('click', function() {
                    notificationDropdown.classList.toggle('hidden');
                    if (!notificationDropdown.classList.contains('hidden')) {
                        markNotificationsAsSeen();
                    }
                });
            }

            function markNotificationsAsSeen() {
                fetch('/notifications/mark-as-seen', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            notificationCounter.classList.add('hidden');
                        }
                    });
            }

            // Initialize notifications
            loadNotifications();

            // Set up real-time updates with Pusher
            const echo = new Echo({
                broadcaster: 'pusher',
                key: '{{ config('broadcasting.connections.pusher.key') }}',
                cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
                encrypted: true
            });

            echo.private(`App.Models.User.{{ auth()->id() }}`)
                .notification((notification) => {
                    loadNotifications(); // Refresh notifications when new one arrives
                });
        });
    </script>
@endpush
