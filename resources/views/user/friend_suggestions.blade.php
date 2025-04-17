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
                @include('partials.friend_suggestions')
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
                    button.addEventListener('click', async function() {
                        const receiverId = this.dataset.id;
                        const button = this;
                        const card = this.closest('.flex.items-center.justify-between');

                        try {
                            // Show loading state
                            button.disabled = true;
                            button.innerHTML = `
                    <span class="inline-block animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-1"></span>
                    Sending...
                `;

                            // Make the request
                            const response = await fetch('/friends', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ receiver_id: receiverId })
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                throw new Error(data.message || 'Request failed');
                            }

                            // Success - update UI
                            const successDiv = document.createElement('div');
                            successDiv.className = 'text-sm text-green-500';
                            successDiv.textContent = data.message;

                            // Replace button with success message
                            button.replaceWith(successDiv);

                            // Remove the card after 2 seconds
                            setTimeout(() => {
                                card.remove();
                            }, 2000);

                        } catch (error) {
                            console.error('Error:', error);

                            // Show error message temporarily
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'text-sm text-red-500 mt-1';
                            errorDiv.textContent = error.message;

                            // Insert after button
                            button.parentNode.insertBefore(errorDiv, button.nextSibling);

                            // Reset button
                            button.disabled = false;
                            button.textContent = 'Add Friend';

                            // Remove error message after 3 seconds
                            setTimeout(() => {
                                errorDiv.remove();
                            }, 3000);
                        }
                    });
                });
            }
        });
    </script>
@endpush
