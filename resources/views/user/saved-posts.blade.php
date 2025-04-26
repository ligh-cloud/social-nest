@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Saved Posts</h1>

        @if($savedPosts->isEmpty())
            <p class="text-gray-500">You have not saved any posts yet.</p>
        @else
            <div class="space-y-6">
                @foreach($savedPosts as $post)
                    <div class="p-4 border rounded-lg shadow-sm bg-white">
                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                        <p class="text-gray-700">{{ Str::limit($post->content, 100) }}</p>

                        <div class="mt-4 flex items-center gap-4">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">View Post</a>

                            <form action="{{ route('posts.unsave', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Unsave</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $savedPosts->links() }}
            </div>
        @endif
    </div>
@endsection
