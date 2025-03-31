@extends('layouts.layout')

@section('title', 'Friend Requests')

@section('content')
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Main Content (Left Side) -->
        <div class="flex-1">
            <!-- Friends Header -->
            <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <h1 class="text-xl font-semibold mb-2 md:mb-0">Friends</h1>
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Search friends" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex space-x-2 overflow-x-auto pb-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">All Friends</button>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium whitespace-nowrap">Friend request</button>
                </div>
            </div>

            <!-- Friend Requests Section -->
            <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
                <h2 class="text-lg font-semibold mb-3">Friend Requests</h2>

                <!-- Received Requests -->
                <div class="mb-6">
                    <h3 class="text-md font-medium mb-2">Received Requests</h3>
                    <div id="receivedRequests">
                        <!-- Received Request Data -->
                        <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3 border-b">
                            <div class="flex items-center mb-2 md:mb-0">
                                <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                                <div>
                                    <div class="font-medium">John Doe</div>
                                    <div class="text-xs text-gray-500">3 mutual friends</div>
                                </div>
                            </div>
                            <div class="flex space-x-2 w-full md:w-auto">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium flex-1 md:flex-none accept-request">Accept</button>
                                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex-1 md:flex-none decline-request">Decline</button>
                            </div>
                        </div>

                        <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3 border-b">
                            <div class="flex items-center mb-2 md:mb-0">
                                <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                                <div>
                                    <div class="font-medium">Jane Smith</div>
                                    <div class="text-xs text-gray-500">2 mutual friends</div>
                                </div>
                            </div>
                            <div class="flex space-x-2 w-full md:w-auto">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium flex-1 md:flex-none accept-request">Accept</button>
                                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex-1 md:flex-none decline-request">Decline</button>
                            </div>
                        </div>
                    </div>

                    <div id="noReceivedRequests" class="hidden text-center py-4 text-gray-500">
                        No new friend requests.
                    </div>
                </div>

                <!-- Sent Requests -->
                <div>
                    <h3 class="text-md font-medium mb-2">Sent Requests</h3>
                    <div id="sentRequests">
                        <!-- Sent Request Data -->
                        <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3 border-b">
                            <div class="flex items-center mb-2 md:mb-0">
                                <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                                <div>
                                    <div class="font-medium">Mark Turner</div>
                                    <div class="text-xs text-gray-500">4 mutual friends</div>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex-1 md:flex-none cancel-request">Cancel Request</button>
                        </div>

                        <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3 border-b">
                            <div class="flex items-center mb-2 md:mb-0">
                                <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                                <div>
                                    <div class="font-medium">Lucy Adams</div>
                                    <div class="text-xs text-gray-500">1 mutual friend</div>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex-1 md:flex-none cancel-request">Cancel Request</button>
                        </div>
                    </div>

                    <div id="noSentRequests" class="hidden text-center py-4 text-gray-500">
                        No pending sent requests.
                    </div>
                </div>
            </div>
        </div>

        <!-- Suggested Friends (Right Side) -->
        <div class="md:w-72 mt-4 md:mt-0">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <h3 class="text-md font-medium mb-3">Suggested Friends</h3>

                <!-- Suggested Friend List -->
                <div class="space-y-3">
                    <!-- Suggested Friend 1 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="User Profile" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <div class="font-medium">Robert Johnson</div>
                                <div class="text-xs text-gray-500">5 mutual friends</div>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs font-medium add-friend">Add</button>
                    </div>

                    <!-- Suggested Friend 2 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/6.jpg" alt="User Profile" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <div class="font-medium">Sarah Williams</div>
                                <div class="text-xs text-gray-500">3 mutual friends</div>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs font-medium add-friend">Add</button>
                    </div>

                    <!-- Suggested Friend 3 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/7.jpg" alt="User Profile" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <div class="font-medium">Michael Davis</div>
                                <div class="text-xs text-gray-500">7 mutual friends</div>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs font-medium add-friend">Add</button>
                    </div>

                    <!-- Suggested Friend 4 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/8.jpg" alt="User Profile" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <div class="font-medium">Emily Wilson</div>
                                <div class="text-xs text-gray-500">2 mutual friends</div>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs font-medium add-friend">Add</button>
                    </div>

                    <!-- Suggested Friend 5 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/9.jpg" alt="User Profile" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <div class="font-medium">James Brown</div>
                                <div class="text-xs text-gray-500">4 mutual friends</div>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs font-medium add-friend">Add</button>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button class="text-blue-500 text-sm font-medium">See More Suggestions</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate No Friend Requests
            const receivedRequests = document.getElementById('receivedRequests');
            const noReceivedRequests = document.getElementById('noReceivedRequests');
            if (!receivedRequests || receivedRequests.children.length === 0) {
                noReceivedRequests.classList.remove('hidden');
            }

            const sentRequests = document.getElementById('sentRequests');
            const noSentRequests = document.getElementById('noSentRequests');
            if (!sentRequests || sentRequests.children.length === 0) {
                noSentRequests.classList.remove('hidden');
            }

            // Accept Friend Request
            document.querySelectorAll('.accept-request').forEach(button => {
                button.addEventListener('click', function() {
                    const requestCard = this.closest('.flex.items-start');
                    requestCard.innerHTML = '<div class="p-3 bg-green-50 text-green-700 rounded-md">Friend request accepted!</div>';
                    setTimeout(() => {
                        requestCard.style.opacity = '0';
                        requestCard.style.transition = 'opacity 0.5s ease';
                        setTimeout(() => {
                            requestCard.remove();
                        }, 500);
                    }, 1500);
                });
            });

            // Decline Friend Request
            document.querySelectorAll('.decline-request').forEach(button => {
                button.addEventListener('click', function() {
                    const requestCard = this.closest('.flex.items-start');
                    requestCard.style.opacity = '0';
                    requestCard.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        requestCard.remove();
                    }, 500);
                });
            });

            // Cancel Sent Request
            document.querySelectorAll('.cancel-request').forEach(button => {
                button.addEventListener('click', function() {
                    const requestCard = this.closest('.flex.items-start');
                    requestCard.style.opacity = '0';
                    requestCard.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        requestCard.remove();
                    }, 500);
                });
            });

            // Add Friend (for Suggested Friends)
            document.querySelectorAll('.add-friend').forEach(button => {
                button.addEventListener('click', function() {
                    const originalText = this.textContent;
                    this.textContent = "Sent";
                    this.classList.remove('bg-blue-500');
                    this.classList.add('bg-gray-300', 'text-gray-700');
                    this.disabled = true;
                });
            });
        });
    </script>
@endpush
