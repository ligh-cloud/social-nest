@extends('layouts.layout')

@section('title', 'Friends')

@section('content')
    <div class="mt-4">
        <!-- Search & Filter -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <h1 class="text-xl font-semibold mb-2 md:mb-0">Friends</h1>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search friends" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>

            <div class="flex space-x-2 overflow-x-auto pb-2" id="filter-buttons">
                <button class="filter-btn px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium whitespace-nowrap">All Friends</button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Friend request</button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Birthdays</button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Work</button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">College</button>
            </div>
        </div>

        <!-- Friend Requests -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Friend Requests</h2>
            <div id="friend-requests-container">
                <div class="text-sm text-gray-500">Loading requests...</div>
            </div>
        </div>

        <!-- All Friends -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h2 class="text-lg font-semibold mb-3">All Friends <span class="text-gray-500 font-normal">(273)</span></h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Friends Loop (static for now) -->
                @foreach(range(1, 6) as $i)
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <img src="{{ asset("storage/profile/user{$i}.jpg") }}" class="w-14 h-14 rounded-full mr-3">
                            <div>
                                <div class="font-medium">Friend {{ $i }}</div>
                                <div class="text-xs text-gray-500">Friends since {{ 2020 + ($i % 3) }}</div>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-h"></i></button>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-6">
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Show More</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        //adding the color switch for each button
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('bg-blue-500', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });

                button.classList.remove('bg-gray-200', 'text-gray-700');
                button.classList.add('bg-blue-500', 'text-white');
            });
        });



        document.addEventListener('DOMContentLoaded', function () {
            loadFriendRequests();

            function loadFriendRequests() {
                fetch("{{ route('friends.show', ['status' => 'pending']) }}")
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('friend-requests-container').innerHTML = html;
                        attachRequestHandlers();
                    });
            }

            function attachRequestHandlers() {
                document.querySelectorAll('.accept-request').forEach(button => {
                    button.addEventListener('click', function () {
                        let id = this.dataset.id;
                        fetch(`/friends/${id}`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ status: true })
                        }).then(() => loadFriendRequests());
                    });
                });

                document.querySelectorAll('.decline-request').forEach(button => {
                    button.addEventListener('click', function () {
                        let id = this.dataset.id;
                        fetch(`/friends/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            }
                        }).then(() => loadFriendRequests());
                    });
                });
            }
        });
    </script>
@endpush
