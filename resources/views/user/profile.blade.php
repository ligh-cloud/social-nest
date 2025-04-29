<?php
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- User Profile Card -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
            <div class="h-48 bg-gradient-to-r from-teal-500 to-teal-600 relative">
                <!-- Edit Profile Button (only visible to profile owner) -->
                @if(auth()->id() == $user->id)
                <a href="{{ route('profile.edit') }}" class="absolute top-4 right-4 bg-white bg-opacity-90 text-teal-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-100 transition-colors">
                    <i class="fas fa-edit mr-2"></i> Edit Profile
</a>
@endif

                <!-- Profile Photo -->
                <div class="absolute -bottom-16 left-8">
                    <div class="h-32 w-32 rounded-full border-4 border-white overflow-hidden bg-white">
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
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
                            <!-- Follow/Message buttons would go here -->
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-teal-600 transition-colors">
                                <i class="fas fa-user-plus mr-2"></i> Follow
                            </button>
                            <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                                <i class="fas fa-envelope mr-2"></i> Message
                            </button>
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
                                <p class="text-lg font-semibold">{{ $user->posts->sum(function($post) { return $post->comments->count(); }) }}</p>
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
                        <p class="text-gray-600">{{ $user->bio }}</p>
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
                    @foreach($user->posts as $post)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <!-- Post Header -->
                            <div class="p-4 flex items-center">
                                <div class="h-10 w-10 rounded-full overflow-hidden mr-3">
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium">{{ $user->name }}</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="mx-1">•</span>
                                        <span>
                                            @if($post->privacy == 'public')
                                                <i class="fas fa-globe-americas mr-1"></i> Public
                                            @elseif($post->privacy == 'friends')
                                                <i class="fas fa-user-friends mr-1"></i> Friends
                                            @else
                                                <i class="fas fa-lock mr-1"></i> Private
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <!-- Post Actions Dropdown -->
                                @if(auth()->id() == $user->id)
                                <div class="ml-auto relative">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <!-- Dropdown menu would go here -->
                                </div>
                                @endif
                            </div>

                            <!-- Post Content -->
                            <div class="px-4 pb-2">
                                <p class="text-gray-800 mb-4">{{ $post->text }}</p>

                                @if($post->image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full h-auto rounded-lg">
                                </div>
                                @endif
                            </div>

                            <!-- Post Stats -->
                            <div class="px-4 py-2 border-t border-gray-100 flex text-sm text-gray-500">
                                <div class="flex items-center mr-6">
                                    <i class="fas fa-heart mr-1 {{ $post->likes_status ? 'text-red-500' : '' }}"></i>
                                    <span>{{ $post->likes->count() }} likes</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-comment mr-1"></i>
                                    <span>{{ $post->comments->count() }} comments</span>
                                </div>
                            </div>

                            <!-- Post Actions -->
                            <div class="px-4 py-2 border-t border-gray-100 flex">
                                <button class="flex-1 flex items-center justify-center py-2 text-gray-600 hover:bg-gray-50 rounded-lg {{ $post->likes_status ? 'text-red-500' : '' }}">
                                    <i class="fas fa-heart mr-2"></i>
                                    <span>Like</span>
                                </button>
                                <button class="flex-1 flex items-center justify-center py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                                    <i class="fas fa-comment mr-2"></i>
                                    <span>Comment</span>
                                </button>
                                <button class="flex-1 flex items-center justify-center py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                                    <i class="fas fa-share mr-2"></i>
                                    <span>Share</span>
                                </button>
                            </div>

                            <!-- Comments Section (collapsed by default) -->
                            <div class="hidden px-4 py-3 border-t border-gray-100 bg-gray-50">
                                <!-- Comment form -->
                                <div class="flex mb-4">
                                    <div class="h-8 w-8 rounded-full overflow-hidden mr-2">
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1 relative">
                                        <input type="text" placeholder="Write a comment..." class="w-full py-2 px-3 bg-white border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                        <button class="absolute right-3 top-2 text-teal-500">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Comments list would go here -->
                            </div>
                        </div>
                    @endforeach
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
            });
        });
    });
</script>
@endsection
