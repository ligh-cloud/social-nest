@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Saved Posts</h1>
        @foreach ($videoPosts as $post)
            <div class="mb-4">
                <video controls class="w-full rounded">
                    <source src="{{ asset('storage/' . $post->image) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endforeach

    </div>
@endsection
