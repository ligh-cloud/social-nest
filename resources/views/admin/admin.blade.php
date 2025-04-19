<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<!-- Main Layout -->
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Navigation -->
    <div class="w-16 bg-teal-600 flex flex-col items-center py-6 shadow-lg">
        <div class="mb-8">
            <div class="w-10 h-10 bg-white rounded flex items-center justify-center">
                <i class="fas fa-share-alt text-teal-600 text-lg"></i>
            </div>
        </div>

        <nav class="flex flex-col space-y-8 items-center">
            <a href="#" class="w-10 h-10 bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-tachometer-alt"></i>
            </a>
            <a href="#" class="w-10 h-10 hover:bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-users"></i>
            </a>
            <a href="#" class="w-10 h-10 hover:bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-newspaper"></i>
            </a>
            <a href="#" class="w-10 h-10 hover:bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-comment-alt"></i>
            </a>
            <a href="#" class="w-10 h-10 hover:bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-shield-alt"></i>
            </a>
            <a href="#" class="w-10 h-10 hover:bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-chart-line"></i>
            </a>
            <a href="#" class="w-10 h-10 hover:bg-teal-700 rounded flex items-center justify-center text-white">
                <i class="fas fa-cog"></i>
            </a>
        </nav>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Top Header -->
        <header class="bg-white shadow-sm">
            <div class="flex justify-between items-center px-6 py-4">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Admin Dashboard</h1>
                    <div class="ml-6 flex items-center text-sm text-gray-500">
                        <a href="#" class="hover:text-teal-600">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-700">Content Moderation</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="relative mr-4">
                        <input type="text" placeholder="Search" class="w-64 py-2 pl-10 pr-3 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">
                            <button class="relative p-1 rounded-full text-gray-500 hover:bg-gray-100 mr-3">
                                <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                                <i class="fas fa-bell"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Admin" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-sm font-medium">Admin User</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="px-6 flex space-x-8 border-b">
                <a href="#" class="px-1 py-4 border-b-2 border-teal-500 text-teal-600 font-medium">Overview</a>
                <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">User Management</a>
                <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">Content Moderation</a>
                <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">Reports</a>
                <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">Analytics</a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="container mx-auto px-6 py-6">
                <!-- Stats Overview Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Users Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Total Users</p>
                                <h3 class="text-2xl font-bold">8,243</h3>
                                <p class="text-green-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>12% from last month</span>
                                </p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Posts Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Total Posts</p>
                                <h3 class="text-2xl font-bold">12,584</h3>
                                <p class="text-green-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>8% from last month</span>
                                </p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-newspaper text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Flagged Content Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Flagged Content</p>
                                <h3 class="text-2xl font-bold">32</h3>
                                <p class="text-red-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>5 new today</span>
                                </p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <i class="fas fa-flag text-red-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Active Users Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Active Now</p>
                                <h3 class="text-2xl font-bold">1,247</h3>
                                <p class="text-green-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>18% from yesterday</span>
                                </p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-user-check text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- User Growth Chart -->
                    <div class="bg-white rounded-lg shadow-sm p-6 lg:col-span-2">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-gray-700">User Growth</h2>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50">Week</button>
                                <button class="px-3 py-1 text-sm border border-teal-500 text-white bg-teal-500 rounded-md">Month</button>
                                <button class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50">Year</button>
                            </div>
                        </div>
                        <div style="height: 300px;">
                            <canvas id="userGrowthChart"></canvas>
                        </div>
                    </div>

                    <!-- Content Distribution Chart -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Content Distribution</h2>
                        <div style="height: 300px;">
                            <canvas id="contentDistributionChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Content Moderation & User Management Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Content Moderation Table -->
                    <div class="bg-white rounded-lg shadow-sm p-6 lg:col-span-2">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-gray-700">Content Moderation Queue</h2>
                            <a href="#" class="text-teal-500 text-sm hover:underline">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <th class="px-4 py-3">Content</th>
                                    <th class="px-4 py-3">User</th>
                                    <th class="px-4 py-3">Type</th>
                                    <th class="px-4 py-3">Reported</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <!-- Reported content row -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 bg-gray-300 rounded overflow-hidden mr-3">
                                                <svg width="100%" height="100%" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" fill="#E5E7EB"/>
                                                    <path d="M0,30 L15,10 L25,20 L40,5 L40,40 L0,40 Z" fill="#9CA3AF"/>
                                                </svg>
                                            </div>
                                            <div class="truncate w-40">
                                                <p class="font-medium text-sm">Potentially offensive content...</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">jamesdoe123</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Post</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">10 min ago</td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-2">
                                            <button class="text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Repeat for more rows -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 bg-gray-300 rounded overflow-hidden mr-3">
                                                <svg width="100%" height="100%" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" fill="#E5E7EB"/>
                                                    <path d="M10,10 L30,10 L30,30 L10,30 Z" fill="#9CA3AF"/>
                                                </svg>
                                            </div>
                                            <div class="truncate w-40">
                                                <p class="font-medium text-sm">Spam promotion link suspected...</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">marketinguser55</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Comment</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">25 min ago</td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-2">
                                            <button class="text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 bg-gray-300 rounded overflow-hidden mr-3">
                                                <svg width="100%" height="100%" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" fill="#E5E7EB"/>
                                                    <circle cx="20" cy="20" r="10" fill="#9CA3AF"/>
                                                </svg>
                                            </div>
                                            <div class="truncate w-40">
                                                <p class="font-medium text-sm">Harassment report in comments...</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">angryguy99</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Thread</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">1 hour ago</td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-2">
                                            <button class="text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-gray-700">Admin Activity</h2>
                            <a href="#" class="text-teal-500 text-sm hover:underline">View All</a>
                        </div>
                        <div class="space-y-4">
                            <!-- Activity Item -->
                            <div class="flex">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-trash text-red-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">You deleted a post</p>
                                    <p class="text-xs text-gray-500">Content violated community guidelines</p>
                                    <p class="text-xs text-gray-500">10 minutes ago</p>
                                </div>
                            </div>
                            <!-- Activity Item -->
                            <div class="flex">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-user-slash text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">You suspended a user</p>
                                    <p class="text-xs text-gray-500">User: spammer123</p>
                                    <p class="text-xs text-gray-500">25 minutes ago</p>
                                </div>
                            </div>
                            <!-- Activity Item -->
                            <div class="flex">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-check text-green-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">You approved flagged content</p>
                                    <p class="text-xs text-gray-500">Found to be within guidelines</p>
                                    <p class="text-xs text-gray-500">1 hour ago</p>
                                </div>
                            </div>
                            <!-- Activity Item -->
                            <div class="flex">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-user-shield text-purple-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">You unbanned a user</p>
                                    <p class="text-xs text-gray-500">User: reformeduser42</p>
                                    <p class="text-xs text-gray-500">3 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Management Section -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">User Management</h2>
                        <div class="flex items-center">
                            <div class="relative mr-4">
                                <input type="text" placeholder="Search users" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                <span>Add User</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Joined</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <!-- User row -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                            <img src="/api/placeholder/40/40" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">David Johnson</p>
                                            <p class="text-xs text-gray-500">@davidj</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">david.j@example.com</td>
                                <td class="px-4 py-3 text-sm">User</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                                <td class="px-4 py-3 text-sm">Mar 14, 2025</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- More user rows -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                            <img src="/api/placeholder/40/40" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Sarah Miller</p>
                                            <p class="text-xs text-gray-500">@sarahm</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">sarah.m@example.com</td>
                                <td class="px-4 py-3 text-sm">Moderator</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                                <td class="px-4 py-3 text-sm">Feb 28, 2025</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                            <img src="/api/placeholder/40/40" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Mike Roberts</p>
                                            <p class="text-xs text-gray-500">@miker</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">mike.r@example.com</td>
                                <td class="px-4 py-3 text-sm">User</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Suspended</span>
                                </td>
                                <td class="px-4 py-3 text-sm">Jan 12, 2025</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-500 hover:text-green-700">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                            <img src="/api/placeholder/40/40" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Jennifer Chen</p>
                                            <p class="text-xs text-gray-500">@jenniferc</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">jennifer.c@example.com</td>
                                <td class="px-4 py-3 text-sm">Admin</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                                <td class="px-4 py-3 text-sm">Mar 5, 2025</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                            <img src="/api/placeholder/40/40" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Carlos Rodriguez</p>
                                            <p class="text-xs text-gray-500">@carlosr</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">carlos.r@example.com</td>
                                <td class="px-4 py-3 text-sm">User</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Banned</span>
                                </td>
                                <td class="px-4 py-3 text-sm">Dec 18, 2024</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-500 hover:text-green-700">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <div class="text-sm text-gray-500">
                            Showing 1-5 of 243 users
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1 border border-teal-500 bg-teal-500 text-white rounded-md">1</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50">2</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50">3</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50">...</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50">25</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="px-6 py-4 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    &copy; 2025 Admin Portal. All rights reserved.
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Chart.js for the charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // User Growth Chart
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(userGrowthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Users',
                data: [650, 590, 800, 810, 960, 1050, 1100, 1150, 1250, 1350, 1500, 1600],
                borderColor: '#0d9488',
                backgroundColor: 'rgba(13, 148, 136, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Content Distribution Chart
    const contentDistributionCtx = document.getElementById('contentDistributionChart').getContext('2d');
    const contentDistributionChart = new Chart(contentDistributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Posts', 'Comments', 'Media', 'Pages', 'Other'],
            datasets: [{
                data: [45, 25, 15, 10, 5],
                backgroundColor: [
                    '#0d9488',
                    '#6366f1',
                    '#f59e0b',
                    '#ec4899',
                    '#8b5cf6'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '70%'
        }
    });
</script>
</body>
</html>
