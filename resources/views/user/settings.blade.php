@extends('layouts.layout')

@section('title', 'Settings')

@section('content')
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
                                <a href="#security" class="block py-2 px-3 hover:bg-gray-100 rounded">
                                    <i class="fas fa-shield-alt mr-2"></i> Security
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Settings Content -->
                <div class="md:w-3/4 p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div id="profile">
                        <h3 class="text-lg font-semibold mb-4">Profile Information</h3>

                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="flex items-center mb-6">
                                <div class="relative mr-4 w-24 h-24">
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                         alt="User Profile"
                                         class="w-24 h-24 rounded-full object-cover">

                                    <!-- File Input (hidden) -->
                                    <input
                                        type="file"
                                        name="profile_photo"
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

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                       class="w-full px-3 py-2 border rounded-md @error('name') border-red-500 @enderror">
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" disabled value="{{ $user->email }}"
                                       class="w-full px-3 py-2 border rounded-md bg-gray-100">
                            </div>

                            <div class="mb-4">
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea id="bio" name="bio" rows="3"
                                          class="w-full px-3 py-2 border rounded-md @error('bio') border-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="security" class="mt-8 pt-8 border-t">
                        <h3 class="text-lg font-semibold mb-4">Security Settings</h3>

                        <form method="POST" action="{{ route('settings.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" id="current_password" name="current_password"
                                       class="w-full px-3 py-2 border rounded-md @error('current_password') border-red-500 @enderror">
                                @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" id="password" name="password"
                                       class="w-full px-3 py-2 border rounded-md @error('password') border-red-500 @enderror">
                                @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="w-full px-3 py-2 border rounded-md">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Update Password
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
        document.addEventListener('DOMContentLoaded', function() {
            // Handle tab navigation
            const navLinks = document.querySelectorAll('nav a');
            const sections = document.querySelectorAll('#profile, #security');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Hide all sections
                    sections.forEach(section => {
                        section.classList.add('hidden');
                    });

                    // Show the selected section
                    const target = this.getAttribute('href').substring(1);
                    document.getElementById(target).classList.remove('hidden');

                    // Update active link
                    navLinks.forEach(l => {
                        l.classList.remove('bg-blue-50', 'text-blue-600');
                    });
                    this.classList.add('bg-blue-50', 'text-blue-600');
                });
            });

            // Initialize the first section as visible
            document.getElementById('profile').classList.remove('hidden');

            // Profile photo preview
            document.getElementById('profileImage').addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('.relative img').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush
