@extends('layouts.layout')

@section('title', 'Settings')

@section('content')
    <!-- Settings Content -->
    <div class="mt-4">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-4 border-b">
                <h2 class="text-xl font-semibold">Account Settings</h2>
            </div>

            <div class="md:flex">
                <!-- Settings Navigation -->
                <div class="md:w-1/4 border-r">
                    <nav class="p-4">
                        <ul>
                            <li class="mb-1">
                                <a href="#profile" class="block py-2 px-3 bg-blue-50 text-blue-600 rounded font-medium">
                                    <i class="far fa-user mr-2"></i> Profile
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#privacy" class="block py-2 px-3 hover:bg-gray-100 rounded">
                                    <i class="fas fa-lock mr-2"></i> Privacy
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#notifications" class="block py-2 px-3 hover:bg-gray-100 rounded">
                                    <i class="far fa-bell mr-2"></i> Notifications
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#security" class="block py-2 px-3 hover:bg-gray-100 rounded">
                                    <i class="fas fa-shield-alt mr-2"></i> Security
                                </a>
                            </li>
                            <li>
                                <a href="#connected" class="block py-2 px-3 hover:bg-gray-100 rounded">
                                    <i class="fas fa-link mr-2"></i> Connected Accounts
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Settings Content -->
                <div class="md:w-3/4 p-6">
                    <div id="profile">
                        <h3 class="text-lg font-semibold mb-4">Profile Information</h3>



                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="flex items-center mb-6">
                                <div class="relative mr-4 w-24 h-24">
                                    <img src="{{ asset('storage/profile/profile.jpg') }}" alt="User Profile" class="w-24 h-24 rounded-full object-cover">

                                    <!-- File Input (hidden) -->
                                    <input
                                        type="file"
                                        name="image"
                                        id="profileImage"
                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                        accept="image/*"
                                    >

                                    <!-- Camera Button Overlay -->
                                    <label
                                        for="profileImage"
                                        class="absolute bottom-0 right-0 bg-blue-500 w-8 h-8 rounded-full flex items-center justify-center text-white hover:bg-blue-600 cursor-pointer shadow-md"
                                        title="Change Profile Picture"
                                    >
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                                <div>
                                    <h4 class="font-medium">{{ $user->name }}</h4>
                                    <p class="text-gray-500 text-sm">Member since {{ $user->created_at->format('F Y') }}</p>
                                </div>
                            </div>

                            <!-- Other form fields -->
                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="firstname" name="firstname" value="{{ $user->name }}" class="w-full px-3 py-2 border rounded-md">
                                </div>
                                <div>
                                    <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" value="Johnson" class="w-full px-3 py-2 border rounded-md">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" disabled value="{{ $user->email }}" class="w-full px-3 py-2 border rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea id="bio" name="bio" rows="3" class="w-full px-3 py-2 border rounded-md">Hiking enthusiast and nature photographer. Love exploring the great outdoors!</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <input type="text" id="location" name="location" value="Seattle, WA" class="w-full px-3 py-2 border rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                <input type="url" id="website" name="website" value="https://sarahjohnson.photo" class="w-full px-3 py-2 border rounded-md">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Save Changes
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Example of page-specific JavaScript
        console.log('Settings page loaded');

        // Handle tab navigation
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all links
                    navLinks.forEach(l => {
                        l.classList.remove('bg-blue-50', 'text-blue-600');
                    });

                    // Add active class to clicked link
                    this.classList.add('bg-blue-50', 'text-blue-600');
                });
            });
        });
    </script>
@endpush
