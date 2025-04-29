@extends('layouts.layout')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- User Profile Card -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="h-48 bg-gradient-to-r from-teal-500 to-teal-600 relative">
                    <!-- Edit Profile Button (only visible to profile owner) -->
                    @if(auth()->id() == $user->id)
                        <a href="{{ route('settings.update') }}" class="absolute top-4 right-4 bg-white bg-opacity-90 text-teal-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-100 transition-colors">
                            <i class="fas fa-edit mr-2"></i> Edit Profile
                        </a>
                    @endif

                    <!-- Profile Photo -->
                    <div class="absolute -bottom-16 left-8">
                        <div class="h-32 w-32 rounded-full border-4 border-white overflow-hidden bg-white">
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-200 text-gray-500">
                                    <i class="fas fa-user text-3xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="pt-20 px-8 pb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                            <p class="text-gray-500">Joined {{ $user->created_at->format('F Y') }}</p>
                        </div>

                        <div class="flex mt-4 md:mt-0 space-x-3">
                            @if(auth()->id() != $user->id)
                                <!-- Follow/Message buttons -->
                                <button class="bg-teal-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-teal-600 transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i> Follow
                                </button>
{{--                                <a href="{{ route('chat.show', $user->id) }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">--}}
{{--                                    <i class="fas fa-envelope mr-2"></i> Message--}}
{{--                                </a>--}}
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex flex-wrap gap-6 mb-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-newspaper text-teal-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Posts</p>
                                    <p class="text-lg font-semibold">{{ $user->posts->count() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-heart text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Likes Received</p>
                                    <p class="text-lg font-semibold">{{ $user->posts->sum(function($post) { return $post->likes->count(); }) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-comment text-purple-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Comments</p>
                                    <p class="text-lg font-semibold">{{ $user->comments->count() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Active</p>
                                    <p class="text-lg font-semibold">{{ $user->last_active_at ? $user->last_active_at->diffForHumans() : 'Never' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-2">About</h2>
                            <p class="text-gray-600">{{ $user->bio ?? 'No bio available' }}</p>
                        </div>

                        @if($user->google_id || $user->facebook_id)
                            <div class="flex gap-2">
                                @if($user->google_id)
                                    <div class="text-sm px-3 py-1 bg-red-100 text-red-600 rounded-full">
                                        <i class="fab fa-google mr-1"></i> Connected
                                    </div>
                                @endif

                                @if($user->facebook_id)
                                    <div class="text-sm px-3 py-1 bg-blue-100 text-blue-600 rounded-full">
                                        <i class="fab fa-facebook mr-1"></i> Connected
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Posts</h2>

                @if($user->posts->isEmpty())
                    <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                        <div class="h-20 w-20 mx-auto mb-4 text-gray-300">
                            <i class="fas fa-newspaper text-5xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">No Posts Yet</h3>
                        <p class="text-gray-500">{{ $user->name }} hasn't published any posts yet.</p>
                    </div>
                @else
                    <div class="space-y-6">

                        <div id="post-container" class="space-y-4">
                            @include('partials.profile', ['posts' => $user->posts, 'user' => $user])
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle comments section
        document.querySelectorAll('[data-action="toggle-comments"]').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const commentsSection = document.querySelector(`[data-comments-section="${postId}"]`);
                commentsSection.classList.toggle('hidden');
            });
        });

        // Like post functionality
        document.querySelectorAll('[data-action="like-post"]').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');

                fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update like count and toggle like button state
                            const likeCount = document.querySelector(`[data-like-count="${postId}"]`);
                            likeCount.textContent = `${data.likes_count} likes`;

                            if (data.liked) {
                                this.classList.add('text-red-500');
                            } else {
                                this.classList.remove('text-red-500');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection

