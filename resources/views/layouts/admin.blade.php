<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body>
<!-- Main Layout -->
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Navigation -->
    <div class="w-64 bg-teal-600 flex flex-col py-6 shadow-lg">
        <div class="px-6 mb-8">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-white rounded flex items-center justify-center mr-3">
                    <i class="fas fa-share-alt text-teal-600 text-lg"></i>
                </div>
                <h1 class="text-white text-xl font-bold">Admin Portal</h1>
            </div>
        </div>

        <nav class="flex flex-col space-y-2 px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-teal-700' : 'hover:bg-teal-700' }} rounded text-white">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users') ? 'bg-teal-700' : 'hover:bg-teal-700' }} rounded text-white">
                <i class="fas fa-users w-6"></i>
                <span class="ml-3">User Management</span>
            </a>
            <a href="{{ route('admin.content') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.content') ? 'bg-teal-700' : 'hover:bg-teal-700' }} rounded text-white">
                <i class="fas fa-newspaper w-6"></i>
                <span class="ml-3">Content Moderation</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 hover:bg-teal-700 rounded text-white">
                <i class="fas fa-comment-alt w-6"></i>
                <span class="ml-3">Messages</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 hover:bg-teal-700 rounded text-white">
                <i class="fas fa-shield-alt w-6"></i>
                <span class="ml-3">Security</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 hover:bg-teal-700 rounded text-white">
                <i class="fas fa-chart-line w-6"></i>
                <span class="ml-3">Analytics</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 hover:bg-teal-700 rounded text-white">
                <i class="fas fa-cog w-6"></i>
                <span class="ml-3">Settings</span>
            </a>
        </nav>

        <div class="mt-auto px-6 py-4 border-t border-teal-700">
            <div class="flex items-center">
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Admin" class="w-10 h-10 rounded-full mr-3">
                <div>
                    <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-teal-300 text-xs">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-teal-700 text-white rounded hover:bg-teal-800">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm p-4 flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                <div class="ml-6 flex items-center text-sm text-gray-500">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-teal-600">Dashboard</a>
                    @yield('breadcrumbs')
                </div>
            </div>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <input type="text" placeholder="Search" class="w-64 py-2 pl-10 pr-3 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="relative">
                    <button class="relative p-1 rounded-full text-gray-500 hover:bg-gray-100 mr-3">
                        <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

@yield('scripts')
</body>
</html>
