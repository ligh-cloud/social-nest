@extends('layouts.layout')

@section('content')
<div class="w-full lg:w-3/5 lg:ml-[20%] p-4">
    <div class="bg-white rounded-lg shadow-sm">
        <!-- Chat Header -->
        <div class="border-b p-4 flex items-center">
            <img src="{{ $user->profile_photo_url }}" 
                 alt="{{ $user->name }}" 
                 class="w-10 h-10 rounded-full object-cover">
            <div class="ml-3">
                <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                <p class="text-xs text-gray-500">Active now</p>
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="h-[500px] overflow-y-auto p-4 space-y-4">
            @if($messages->isEmpty())
                <div class="text-center py-8">
                    <i class="fas fa-comments text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">No messages yet. Start the conversation!</p>
                </div>
            @else
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[70%]">
                            <div class="flex items-end {{ $message->sender_id == auth()->id() ? 'flex-row-reverse' : '' }}">
                                @if($message->sender_id != auth()->id())
                                    <img src="{{ $message->sender->profile_photo_url }}" 
                                         alt="{{ $message->sender->name }}" 
                                         class="w-8 h-8 rounded-full object-cover mr-2">
                                @endif
                                <div class="{{ $message->sender_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-900' }} 
                                            rounded-2xl px-4 py-2">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    <span class="text-xs {{ $message->sender_id == auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Message Input -->
        <div class="border-t p-4">
            <form id="message-form" class="flex items-center space-x-2">
                <input type="text" 
                       id="message" 
                       class="flex-1 rounded-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       placeholder="Type your message...">
                <button type="submit" 
                        class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-600 transition-colors duration-200">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        encrypted: true
    });

    // Get the user IDs and sort them to match the channel format
    var userIds = [{{ $user->id }}, {{ auth()->id() }}].sort();
    var channel = pusher.subscribe('private-chat.' + userIds.join('.'));

    channel.bind('MessageSent', function(data) {
        var message = data.message;
        var isSender = message.sender_id == {{ auth()->id() }};
        appendMessage(message, isSender);
    });

    function appendMessage(message, isSender) {
        var messageHtml = `
            <div class="flex ${isSender ? 'justify-end' : 'justify-start'}">
                <div class="max-w-[70%]">
                    <div class="flex items-end ${isSender ? 'flex-row-reverse' : ''}">
                        ${!isSender ? `
                            <img src="${message.sender.profile_photo_url}" 
                                 alt="${message.sender.name}" 
                                 class="w-8 h-8 rounded-full object-cover mr-2">
                        ` : ''}
                        <div class="${isSender ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-900'} rounded-2xl px-4 py-2">
                            <p class="text-sm">${message.message}</p>
                            <span class="text-xs ${isSender ? 'text-blue-100' : 'text-gray-500'}">
                                ${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('chat-messages').innerHTML += messageHtml;
        document.getElementById('chat-messages').scrollTop = document.getElementById('chat-messages').scrollHeight;
    }

    document.getElementById('message-form').addEventListener('submit', function(e) {
        e.preventDefault();
        var messageInput = document.getElementById('message');
        var message = messageInput.value.trim();
        
        if (message === '') return;

        // Show loading state
        var submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        fetch('/chat/{{ $user->id }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Immediately append the sent message
                appendMessage(data.message, true);
                messageInput.value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
        });
    });

    // Scroll to bottom on page load
    window.onload = function() {
        document.getElementById('chat-messages').scrollTop = document.getElementById('chat-messages').scrollHeight;
    };
</script>
@endpush

@push('styles')
<style>
    .chat-messages {
        padding: 10px;
        background: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .message {
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
    }
    .message.sent {
        align-items: flex-end;
    }
    .message.received {
        align-items: flex-start;
    }
    .message-content {
        padding: 10px 15px;
        border-radius: 15px;
        max-width: 70%;
        word-wrap: break-word;
    }
    .message.sent .message-content {
        background: #007bff;
        color: white;
    }
    .message.received .message-content {
        background: #e9ecef;
        color: black;
    }
    .message-time {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 5px;
    }
</style>
@endpush
@endsection 