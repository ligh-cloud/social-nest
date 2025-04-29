@extends('layouts.admin')

@section('content')
    <!-- Main Content Area -->
    <div class="container mx-auto px-6 py-6">
        <!-- Overview Tab Content -->
        <div id="overview" class="tab-content">
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

            <!-- Chart Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">User Analytics</h2>
                <div class="h-80">
                    <canvas id="userChart"></canvas>
                </div>
            </div>

            <!-- Activity Section -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <i class="fas fa-user-plus text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">New user registered</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-red-100 p-2 rounded-full mr-3">
                            <i class="fas fa-user-slash text-red-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">User banned for policy violation</p>
                            <p class="text-xs text-gray-500">4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <i class="fas fa-newspaper text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">New post trending</p>
                            <p class="text-xs text-gray-500">6 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Tab Content -->
        <div id="users" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-sm p-6">
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
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User" class="h-full w-full object-cover"/>
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
                                        <a href="{{route('users.show', ['id' => $user->id])}}">
                                            <button class="text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
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
                        {{ $users->appends(['users_page' => $users->currentPage(), 'posts_page' => request('posts_page')])->setPageName('users_page')->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Moderation Tab Content -->
        <div id="content" class="tab-content hidden">
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
                                    <div class="max-w-xs">
                                        <p class="text-sm text-gray-800 mb-2">{{ $post->text ?? 'No text content' }}</p>
                                        @if($post->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                     alt="Post image"
                                                     class="w-32 h-32 object-cover rounded-lg">
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-2">
                                            <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : '/api/placeholder/32/32' }}"
                                                 alt="User"
                                                 class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium">{{ $post->user->name ?? 'Unknown User' }}</span>
                                            <p class="text-xs text-gray-500">{{ $post->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $post->likes->count() }}</td>
                                <td class="px-4 py-3 text-sm">{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="deletePost({{ $post->id }})" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $posts->appends(['posts_page' => $posts->currentPage(), 'users_page' => request('users_page')])->setPageName('posts_page')->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Tab Content -->
        <div id="reports" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Reports</h2>
                <p class="text-gray-500">Reports section coming soon...</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show overview tab by default
            showTab('overview');

            // Initialize Chart.js chart
            const ctx = document.getElementById('userChart').getContext('2d');
            const userChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Users', 'Active Users', 'Banned Users', 'Suspended Users'],
                    datasets: [{
                        label: 'User Statistics',
                        data: [
                            {{ $stats['total_users'] }},
                            {{ $stats['active_users'] }},
                            {{ $stats['banned_users'] }},
                            {{ $stats['suspended_users'] }}
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 205, 86, 0.5)'
                        ],
                        borderColor: [
                            'rgb(54, 162, 235)',
                            'rgb(75, 192, 192)',
                            'rgb(255, 99, 132)',
                            'rgb(255, 205, 86)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Line chart for user growth over time
            const userGrowthCtx = document.createElement('canvas');
            userGrowthCtx.id = 'userGrowthChart';
            document.querySelector('.h-80').appendChild(userGrowthCtx);

            const userGrowthChart = new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'User Growth',
                        data: [
                            {{ $stats['total_users'] - 120 }},
                            {{ $stats['total_users'] - 100 }},
                            {{ $stats['total_users'] - 80 }},
                            {{ $stats['total_users'] - 50 }},
                            {{ $stats['total_users'] - 20 }},
                            {{ $stats['total_users'] }}
                        ],
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'User Growth Over Time',
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
