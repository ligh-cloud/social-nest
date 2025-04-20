@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-6">
    <!-- Content Moderation Section -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Content Moderation</h2>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <input type="text" placeholder="Search posts" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-4 py-3">Post</th>
                    <th class="px-4 py-3">Author</th>
                    <th class="px-4 py-3">Likes</th>
                    <th class="px-4 py-3">Comments</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Posted</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($posts as $post)
                <tr>
                    <td class="px-4 py-3">
                        <div class="max-w-md">
                            <p class="text-sm font-medium text-gray-900">{{ Str::limit($post->content, 100) }}</p>
                            @if($post->media)
                                <div class="mt-2">
                                    <img src="{{ $post->media }}" alt="Post media" class="h-20 w-20 object-cover rounded">
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center">
                            <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-2">
                                <img src="{{ $post->user->profile_photo_path ?? '/api/placeholder/32/32' }}" alt="User" class="h-full w-full object-cover"/>
                            </div>
                            <div>
                                <p class="text-sm font-medium">{{ $post->user->name }}</p>
                                <p class="text-xs text-gray-500">@{{ $post->user->username }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $post->likes_count }}</td>
                    <td class="px-4 py-3 text-sm">{{ $post->comments_count }}</td>
                    <td class="px-4 py-3">
                        @if($post->trashed())
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Deleted</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $post->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if($post->trashed())
                                <button onclick="restorePost({{ $post->id }})" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-undo"></i>
                                </button>
                            @else
                                <button onclick="deletePost({{ $post->id }})" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deletePost(postId) {
    if (confirm('Are you sure you want to delete this post?')) {
        fetch(`/admin/posts/${postId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete post: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete post: ' + error.message);
        });
    }
}

function restorePost(postId) {
    if (confirm('Are you sure you want to restore this post?')) {
        fetch(`/admin/posts/${postId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to restore post');
            }
        });
    }
}
</script>
@endpush
@endsection 