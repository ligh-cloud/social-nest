@extends('layouts.admin')

@section('content')
    <!-- Main Content Area -->
    <div class="container mx-auto px-4 sm:px-6 py-8">
        <!-- Overview Tab Content -->
        <div id="overview" class="tab-content">
            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Users Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-all duration-200 hover:shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Users</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['total_users'] }}</h3>
                            <p class="text-emerald-500 text-xs flex items-center mt-2">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>{{ $stats['active_users'] }} active now</span>
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Posts Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-all duration-200 hover:shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Posts</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['total_posts'] }}</h3>
                            <p class="text-emerald-500 text-xs flex items-center mt-2">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>Latest posts</span>
                            </p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-newspaper text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Banned Users Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-all duration-200 hover:shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Banned Users</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['banned_users'] }}</h3>
                            <p class="text-red-500 text-xs flex items-center mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <span>Need attention</span>
                            </p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-user-slash text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Suspended Users Card -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-all duration-200 hover:shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Suspended Users</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['suspended_users'] }}</h3>
                            <p class="text-amber-500 text-xs flex items-center mt-2">
                                <i class="fas fa-clock mr-1"></i>
                                <span>Temporary suspensions</span>
                            </p>
                        </div>
                        <div class="bg-amber-100 p-3 rounded-full">
                            <i class="fas fa-clock text-amber-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">User Analytics</h2>
                <div class="h-80">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>

        <!-- User Management Tab Content -->
        <div id="users" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
                    <div class="w-full sm:w-auto">
                        <div class="relative">
                            <input type="text" placeholder="Search users" class="w-full py-2.5 pl-10 pr-4 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-200 overflow-hidden mr-3">
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User" class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm text-gray-900">{{ $user->name ?? 'Unknown User' }}</p>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email ?? 'No email' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @if($user->role_id === 1)
                                        <span class="px-2.5 py-1 text-xs font-medium bg-violet-100 text-violet-800 rounded-full">Admin</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">User</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->trashed())
                                        <span class="px-2.5 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Banned</span>
                                    @elseif($user->suspended_until && $user->suspended_until > now())
                                        <span class="px-2.5 py-1 text-xs font-medium bg-amber-100 text-amber-800 rounded-full">Suspended</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Active</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-3">
                                        <a href="{{route('users.show', ['id' => $user->id])}}" class="text-gray-500 hover:text-gray-700 transition-colors">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="text-blue-500 hover:text-blue-700 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if($user->trashed())
                                            <button onclick="unbanUser({{ $user->id }})" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        @else
                                            <button onclick="banUser({{ $user->id }})" class="text-red-500 hover:text-red-700 transition-colors">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @endif
                                        @if($user->suspended_until && $user->suspended_until > now())
                                            <button onclick="unsuspendUser({{ $user->id }})" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        @else
                                            <button onclick="suspendUser({{ $user->id }})" class="text-amber-500 hover:text-amber-700 transition-colors">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        {{ $users->appends(['users_page' => $users->currentPage(), 'posts_page' => request('posts_page')])->setPageName('users_page')->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Moderation Tab Content -->
        <div id="content" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Posts</h2>
                    <a href="#" class="text-teal-600 text-sm font-medium hover:text-teal-700 transition-colors">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Post</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Likes</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($posts as $post)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
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
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-9 w-9 flex-shrink-0 rounded-full bg-gray-200 overflow-hidden mr-3">
                                            <img src="{{ $post->user->profile_photo_path ? asset('storage/' . $post->user->profile_photo_path) : '/api/placeholder/32/32' }}"
                                                 alt="User"
                                                 class="h-full w-full object-cover"/>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">{{ $post->user->name ?? 'Unknown User' }}</span>
                                            <p class="text-xs text-gray-500">{{ $post->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $post->likes->count() }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-3">
                                        <button class="text-gray-500 hover:text-gray-700 transition-colors">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="deletePost({{ $post->id }})" class="text-red-500 hover:text-red-700 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        {{ $posts->appends(['posts_page' => $posts->currentPage(), 'users_page' => request('users_page')])->setPageName('posts_page')->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Tab Content -->
        <div id="reports" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Reports</h2>
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
                            'rgba(59, 130, 246, 0.6)',
                            'rgba(16, 185, 129, 0.6)',
                            'rgba(239, 68, 68, 0.6)',
                            'rgba(245, 158, 11, 0.6)'
                        ],
                        borderColor: [
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(239, 68, 68)',
                            'rgb(245, 158, 11)'
                        ],
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
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
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderColor: 'rgb(16, 185, 129)',
                        tension: 0.3,
                        pointBackgroundColor: 'rgb(16, 185, 129)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
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
                                size: 16,
                                weight: 'bold'
                            },
                            padding: {
                                bottom: 20
                            },
                            color: '#374151'
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
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
        });
    </script>
@endsection
