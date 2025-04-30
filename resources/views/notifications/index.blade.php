@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-3xl">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-4 border-b">
                <h1 class="text-xl font-semibold text-gray-800">All Notifications</h1>
            </div>

            <div class="divide-y">
                @forelse($notifications as $notification)
                    @php
                        $data = $notification->data;
                        $message = $data['message'] ?? ($data['text'] ?? 'New notification');
                    @endphp

                    <div class="p-4 hover:bg-gray-50 transition {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                        <div class="flex items-start">
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-800">
                                    @if(isset($data['post_id']))
                                        <a href="{{ route('posts.show', ['post' => $data['post_id']]) }}" class="hover:text-blue-600">
                                            {{ $message }}
                                        </a>
                                    @elseif(isset($data['event_id']))
                                        <a href="{{ route('events.show', ['event' => $data['event_id']]) }}" class="hover:text-green-600">
                                            {{ $message }}
                                        </a>
                                    @else
                                        <span>{{ $message }}</span>
                                    @endif
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if(!$notification->read_at)
                                <span class="ml-2 flex-shrink-0 inline-block h-2 w-2 rounded-full bg-blue-500"></span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <p class="text-gray-500">You don't have any notifications yet.</p>
                    </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
                <div class="p-4 border-t">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
