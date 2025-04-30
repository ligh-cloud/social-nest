@extends('layouts.layout')

@section('title', 'Users You Might Know')

@section('content')
    <div class="mt-4">
        <!-- Search Bar -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-xl font-semibold mb-4">Users You Might Know</h2>
            <div class="relative">
                <input type="text" id="user-search" placeholder="Search users" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>

        <!-- Suggestions Section -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            @if ($suggestedUsers->isEmpty())
                <div class="text-sm text-gray-500 p-4 text-center">No suggestions found.</div>
            @else
                <div class="space-y-2" id="suggested-users-container">
                    @foreach ($suggestedUsers as $user)
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition relative user-card" data-name="{{ $user->name }}">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $user->profile_picture
                                    ? asset('storage/profile/'.$user->profile_picture)
                                    : asset('images/default-profile.jpg') }}"
                                     class="w-12 h-12 rounded-full object-cover border border-gray-200">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ '@'.Str::before($user->email, '@') }}</div>
                                </div>
                            </div>
                            <button data-id="{{ $user->id }}"
                                    class="send-request px-5 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-full transition disabled:opacity-50">
                                Add Friend
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Search Functionality
            const searchInput = document.getElementById('user-search');
            const userCards = document.querySelectorAll('.user-card');

            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase();
                userCards.forEach(card => {
                    const userName = card.dataset.name.toLowerCase();
                    if (userName.includes(query)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            // Send Friend Request
            document.querySelectorAll('.send-request').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.id;
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    fetch('/friends', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ receiver_id: userId })
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to send friend request');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                this.innerHTML = 'Request Sent';
                                this.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                                this.classList.add('bg-gray-300');
                            } else {
                                alert(data.message);
                                this.disabled = false;
                                this.innerHTML = 'Add Friend';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to send friend request');
                            this.disabled = false;
                            this.innerHTML = 'Add Friend';
                        });
                });
            });
        });
    </script>
@endpush
