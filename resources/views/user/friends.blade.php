@extends('layouts.layout')

@section('title', 'Friends')

@section('content')
    <!-- Friends Page Content -->
    <div class="mt-4">
        <!-- Friends Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <h1 class="text-xl font-semibold mb-2 md:mb-0">Friends</h1>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search friends" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>

            <div class="flex space-x-2 overflow-x-auto pb-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium whitespace-nowrap">All Friends</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Friend request</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Birthdays</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Work</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">College</button>
            </div>
        </div>

        <!-- Friend Requests Section -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Friend Requests</h2>

            @if(count($friendRequests ?? []) > 0)
                @foreach($friendRequests ?? [] as $request)
                    <!-- Friend Request Item -->
                @endforeach
            @else
                <!-- Sample Friend Request -->
                <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3 border-b">
                    <div class="flex items-center mb-2 md:mb-0">
                        <img src="{{ asset('storage/profile/user1.jpg') }}" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Michael Rodriguez</div>
                            <div class="text-xs text-gray-500">5 mutual friends</div>
                        </div>
                    </div>
                    <div class="flex space-x-2 w-full md:w-auto">
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium flex-1 md:flex-none">Accept</button>
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex-1 md:flex-none">Decline</button>
                    </div>
                </div>

                <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3">
                    <div class="flex items-center mb-2 md:mb-0">
                        <img src="{{ asset('storage/profile/user2.jpg') }}" alt="User Profile" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Emily Zhang</div>
                            <div class="text-xs text-gray-500">2 mutual friends</div>
                        </div>
                    </div>
                    <div class="flex space-x-2 w-full md:w-auto">
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium flex-1 md:flex-none">Accept</button>
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex-1 md:flex-none">Decline</button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Friends List -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h2 class="text-lg font-semibold mb-3">All Friends <span class="text-gray-500 font-normal">(273)</span></h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Sample Friends -->
                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/profile/profile.jpg') }}" alt="User Profile" class="w-14 h-14 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Sarah Johnson</div>
                            <div class="text-xs text-gray-500">Friends since 2020</div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>

                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/profile/user3.jpg') }}" alt="User Profile" class="w-14 h-14 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Jason Williams</div>
                            <div class="text-xs text-gray-500">Friends since 2021</div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>

                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/profile/user4.jpg') }}" alt="User Profile" class="w-14 h-14 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Amanda Thompson</div>
                            <div class="text-xs text-gray-500">Friends since 2019</div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>

                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/profile/user5.jpg') }}" alt="User Profile" class="w-14 h-14 rounded-full mr-3">
                        <div>
                            <div class="font-medium">David Chen</div>
                            <div class="text-xs text-gray-500">Friends since 2022</div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>

                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/profile/user6.jpg') }}" alt="User Profile" class="w-14 h-14 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Jessica Lee</div>
                            <div class="text-xs text-gray-500">Friends since 2020</div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>

                <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/profile/user7.jpg') }}" alt="User Profile" class="w-14 h-14 rounded-full mr-3">
                        <div>
                            <div class="font-medium">Ryan Garcia</div>
                            <div class="text-xs text-gray-500">Friends since 2021</div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-6">
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                    Show More
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Friends page specific JavaScript
        console.log('Friends page loaded');

        // Example: Friend request actions
        document.addEventListener('DOMContentLoaded', function() {
            const acceptButtons = document.querySelectorAll('.accept-request');
            const declineButtons = document.querySelectorAll('.decline-request');

            // Add event listeners for friend request actions
            // This is just placeholder functionality
        });
    </script>
@endpush
