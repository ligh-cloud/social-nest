@extends('layouts.layout')

@section('title', 'Users')

@section('content')
    <!-- Main Content Container -->
    <div class="w-full lg:w-4/5 lg:ml-[20%] p-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <h1 class="text-xl font-semibold">People You May Know</h1>
            <div class="relative w-full md:w-64">
                <input type="text" id="search-input" placeholder="Search users"
                       class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>

        <!-- Suggestions Container -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div id="friend-suggestions-container">
                @include('partials.friend_suggestions', ['suggestedUsers' => $suggestedUsers ?? collect()])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');

            // Initial load will use the server-rendered content
            // Only need to handle search functionality

            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        const query = this.value.trim();
                        loadSuggestions(query);
                    }, 300);
                });
            }

            function loadSuggestions(query = '') {
                fetch(`/friends/suggestions?q=${encodeURIComponent(query)}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.text();
                    })
                    .then(html => {
                        document.getElementById('friend-suggestions-container').innerHTML = html;
                        attachSendRequestHandlers();
                    })
                    .catch(error => {
                        console.error('Error loading suggestions:', error);
                        document.getElementById('friend-suggestions-container').innerHTML = `
                            <div class="text-center py-8 text-red-500">
                                Failed to load suggestions. Please try again.
                            </div>
                        `;
                    });
            }

            // Attach handlers to initial buttons
            attachSendRequestHandlers();

            function attachSendRequestHandlers() {
                document.querySelectorAll('.send-request').forEach(button => {
                    button.addEventListener('click', function() {
                        const receiverId = this.dataset.id;
                        const button = th is;

                        button.disabled = true;
                        button.innerHTML = `
                            <span class="inline-block animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-1"></span>
                            Sending...
                        `;

                        fetch('/friends', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ receiver_id: receiverId })
                        })
                            .then(response => {
                                if (!response.ok) throw new Error('Request failed');
                                return response.json();
                            })
                            .then(data => {
                                // Reload suggestions after successful request
                                loadSuggestions(searchInput ? searchInput.value.trim() : '');
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                button.disabled = false;
                                button.textContent = 'Add Friend';
                                alert('Failed to send friend request. Please try again.');
                            });
                    });
                });
            }
        });
    </script>
@endpush
