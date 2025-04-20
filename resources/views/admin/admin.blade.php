<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <img src="{{ auth()->user()->profile_photo_path ?? '/api/placeholder/32/32' }}" alt="Admin" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-sign-out-alt mr-1"></i>Logout
                                </button>
                            </form>
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
                                <h3 class="text-2xl font-bold">{{ $stats['total_users'] }}</h3>
                                <p class="text-green-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>{{ $stats['active_users'] }} active now</span>
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
                                <h3 class="text-2xl font-bold">{{ $stats['total_posts'] }}</h3>
                                <p class="text-green-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>Latest posts</span>
                                </p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-newspaper text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Banned Users Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Banned Users</p>
                                <h3 class="text-2xl font-bold">{{ $stats['banned_users'] }}</h3>
                                <p class="text-red-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <span>Need attention</span>
                                </p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <i class="fas fa-user-slash text-red-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Suspended Users Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Suspended Users</p>
                                <h3 class="text-2xl font-bold">{{ $stats['suspended_users'] }}</h3>
                                <p class="text-yellow-500 text-xs flex items-center mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>Temporary suspensions</span>
                                </p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-clock text-yellow-500 text-xl"></i>
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
                            @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                            <img src="{{ $user->profile_photo_path ?? '/api/placeholder/40/40' }}" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">{{ $user->name ?? 'Unknown User' }}</p>
                                            <p class="text-xs text-gray-500">@{{ $user->username ?? 'No username' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $user->email ?? 'No email' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $user->role_id === 1 ? 'Admin' : 'User' }}</td>
                                <td class="px-4 py-3">
                                    @if($user->trashed())
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Banned</span>
                                    @elseif($user->suspended_until && $user->suspended_until > now())
                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Suspended</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if($user->trashed())
                                            <button onclick="unbanUser({{ $user->id }})" class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        @else
                                            <button onclick="banUser({{ $user->id }})" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @endif
                                        @if($user->suspended_until && $user->suspended_until > now())
                                            <button onclick="unsuspendUser({{ $user->id }})" class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        @else
                                            <button onclick="suspendUser({{ $user->id }})" class="text-yellow-500 hover:text-yellow-700">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>

                <!-- Posts Management Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">Recent Posts</h2>
                        <a href="#" class="text-teal-500 text-sm hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-4 py-3">Post</th>
                                <th class="px-4 py-3">Author</th>
                                <th class="px-4 py-3">Likes</th>
                                <th class="px-4 py-3">Created</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($posts as $post)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="max-w-xs truncate">
                                        {{ $post->text ?? 'No text content' }}
                                    </div>
                                    @if($post->image)
                                        <img src="{{ $post->image }}" alt="Post image" class="mt-2 w-20 h-20 object-cover rounded">
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-2">
                                            <img src="{{ $post->user->profile_photo_path ?? '/api/placeholder/32/32' }}" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <span class="text-sm">{{ $post->user->name ?? 'Unknown User' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $post->likes->count() }}</td>
                                <td class="px-4 py-3 text-sm">{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function banUser(userId) {
    if (confirm('Are you sure you want to ban this user?')) {
        fetch(`/admin/users/${userId}/ban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to ban user: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to ban user: ' + error.message);
        });
    }
}

function unbanUser(userId) {
    if (confirm('Are you sure you want to unban this user?')) {
        fetch(`/admin/users/${userId}/unban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to unban user');
            }
        });
    }
}

function suspendUser(userId) {
    const days = prompt('Enter number of days to suspend (default: 7):', '7');
    if (days !== null) {
        fetch(`/admin/users/${userId}/suspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ days: parseInt(days) || 7 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to suspend user');
            }
        });
    }
}

function unsuspendUser(userId) {
    if (confirm('Are you sure you want to unsuspend this user?')) {
        fetch(`/admin/users/${userId}/unsuspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to unsuspend user');
            }
        });
    }
}
</script>
</body>
</html>
