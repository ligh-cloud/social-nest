@extends('layouts.layout')

@section('title', 'Users')

@section('content')
    <div class="mt-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">People You May Know</h1>
            <div class="relative w-64">
                <input type="text" id="search-input" placeholder="Search users" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>

        <!-- Suggestions -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div id="friend-suggestions-container">
                <div class="text-sm text-gray-500">Loading suggestions...</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Load suggestions on page load
            loadSuggestions();

            function loadSuggestions(query = '') {
                fetch(`/friends/suggestions?q=${query}`)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('friend-suggestions-container').innerHTML = html;
                        attachSendRequestHandlers();
                    });
            }

            function attachSendRequestHandlers() {
                document.querySelectorAll('.send-request').forEach(button => {
                    button.addEventListener('click', function () {
                        const receiverId = this.dataset.id;

                        fetch('/friends', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ receiver_id: receiverId })
                        }).then(() => {
                            // Reload suggestions
                            loadSuggestions();
                        });
                    });
                });
            }

            // Search functionality
            document.getElementById('search-input').addEventListener('input', function () {
                const query = this.value.trim();
                loadSuggestions(query);
            });
        });
    </script>
@endpush

