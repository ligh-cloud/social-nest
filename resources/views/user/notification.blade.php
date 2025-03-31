@extends('layouts.layout')

@section('title', 'Notifications')

@section('content')
    <!-- Notifications Page Content -->
    <div class="mt-4">
        <!-- Notifications Header -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex space-x-2 overflow-x-auto pb-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium whitespace-nowrap">All</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Unread</button>
            </div>
        </div>

        <!-- Today's Notifications -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Today</h2>

            <!-- Notification Items -->
            <div class="space-y-3">
                <!-- Unread Friend Request Accepted -->
                <div class="flex items-start p-3 rounded-lg bg-blue-50 border-l-4 border-blue-500">
                    <img src="https://i.pinimg.com/474x/e4/1a/34/e41a34e15c1b74a6eefbbdd396cc89be.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                    <div class="flex-1">
                        <div class="font-medium">
                            <span class="text-blue-600">Michael Rodriguez</span> accepted your friend request
                        </div>
                        <div class="text-xs text-gray-500 mt-1">2 hours ago</div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>

                <!-- Unread Comment Notification -->
                <div class="flex items-start p-3 rounded-lg bg-blue-50 border-l-4 border-blue-500">
                    <img src="https://i.pinimg.com/474x/2e/35/a8/2e35a825ca6943a3b8842454af9cd246.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                    <div class="flex-1">
                        <div class="font-medium">
                            <span class="text-blue-600">Emily Zhang</span> commented on your post: "This looks amazing! Where was this photo taken?"
                        </div>
                        <div class="text-xs text-gray-500 mt-1">4 hours ago</div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>

                <!-- Read Like Notification -->
                <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                    <img src="https://i.pinimg.com/474x/aa/06/d7/aa06d77cd048b867f5d0b40362e62a76.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                    <div class="flex-1">
                        <div class="font-medium">
                            <span>Ryan Garcia</span> liked your photo
                        </div>
                        <div class="text-xs text-gray-500 mt-1">10 hours ago</div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yesterday's Notifications -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Yesterday</h2>

            <!-- Notification Items -->
            <div class="space-y-3">
                <!-- Birthday Notification -->
                <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-full mr-3 bg-blue-100 flex items-center justify-center text-blue-500">
                        <i class="fas fa-birthday-cake text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">
                            <span>Jessica Lee</span> and <span>2 others</span> have birthdays today
                        </div>
                        <div class="text-xs text-gray-500 mt-1">1 day ago</div>
                        <div class="mt-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm font-medium">
                                Send wishes
                            </button>
                        </div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>

                <!-- Event Notification -->
                <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-full mr-3 bg-green-100 flex items-center justify-center text-green-500">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">
                            <span>Community Meetup</span> event is happening tomorrow
                        </div>
                        <div class="text-xs text-gray-500 mt-1">1 day ago</div>
                        <div class="mt-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm font-medium mr-2">
                                Going
                            </button>
                            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                                Not interested
                            </button>
                        </div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Week -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h2 class="text-lg font-semibold mb-3">This Week</h2>

            <!-- Notification Items -->
            <div class="space-y-3">
                <!-- Tag Notification -->
                <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                    <img src="https://i.pinimg.com/474x/83/5c/fc/835cfc1492a6c8ce9eeb2cd276cae78b.jpg" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                    <div class="flex-1">
                        <div class="font-medium">
                            <span>Jason Williams</span> tagged you in a post
                        </div>
                        <div class="text-xs text-gray-500 mt-1">2 days ago</div>
                        <div class="mt-2 p-3 bg-gray-100 rounded-lg text-sm">
                            "Throwback to our amazing hiking trip last summer with @you and the crew! #goodtimes"
                        </div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>

                <!-- Group Notification -->
                <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-full mr-3 bg-purple-100 flex items-center justify-center text-purple-500">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">
                            <span>Photography Enthusiasts</span> group has 5 new posts
                        </div>
                        <div class="text-xs text-gray-500 mt-1">3 days ago</div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>

                <!-- System Notification -->
                <div class="flex items-start p-3 rounded-lg hover:bg-gray-50">
                    <div class="w-12 h-12 rounded-full mr-3 bg-yellow-100 flex items-center justify-center text-yellow-500">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">
                            We've updated our privacy policy
                        </div>
                        <div class="text-xs text-gray-500 mt-1">5 days ago</div>
                        <div class="mt-2">
                            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                                Review changes
                            </button>
                        </div>
                    </div>
                    <div class="text-gray-400">
                        <button class="hover:text-gray-600">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-6">
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                    Load More
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Notifications page specific JavaScript
        console.log('Notifications page loaded');

        // Example: Mark notifications as read
        document.addEventListener('DOMContentLoaded', function() {
            const markAllReadBtn = document.querySelector('button:contains("Mark all as read")');
            const unreadNotifications = document.querySelectorAll('.bg-blue-50');

            // Add event listener for mark all as read button
            // This is just placeholder functionality
        });
    </script>
@endpush
