@extends('layouts.layout')

@section('content')
<div class="w-full lg:w-3/5 lg:ml-[20%] p-4">
    <div class="bg-white rounded-lg shadow-sm p-4">
        <h2 class="text-xl font-semibold mb-4">Messages</h2>

        @if($users->isEmpty())
            <div class="text-center py-8">
                <i class="fas fa-comments text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">No users found to chat with.</p>
            </div>
        @else
            <div class="space-y-2">
                @foreach($users as $user)
                    @if($user->id !== auth()->id())
                        <a href="{{ route('chat.index', $user) }}"
                           class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                     alt="{{ $user->name }}"
                                     class="w-12 h-12 rounded-full object-cover">

                            </div>
                            <div class="ml-3 flex-1">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $user->name }}</h3>
                                    @if($user->lastMessage)
                                        <span class="text-xs text-gray-500">
                                            {{ $user->lastMessage->created_at->diffForHumans() }}
                                        </span>
                                    @endif
                                </div>
                                @if($user->lastMessage)
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ $user->lastMessage->text }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400">No messages yet</p>
                                @endif
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
