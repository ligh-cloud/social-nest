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
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body>
<!-- Main Layout -->
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Navigation with expanded content -->
    <div class="w-64 bg-teal-600 flex flex-col py-6 shadow-lg">
        <div class="px-6 mb-8 flex items-center">
            <div class="w-10 h-10 bg-white rounded flex items-center justify-center mr-3">
                <i class="fas fa-share-alt text-teal-600 text-lg"></i>
            </div>
            <h1 class="text-xl font-semibold text-white">Admin Dashboard</h1>
        </div>

        <!-- User Profile in Sidebar -->
        <div class="px-6 mb-6 py-3  maborder-b border-teal-500">
            <div class="flex items-center">
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Admin" class="w-10 h-10 rounded-full mr-3">
                <div>
                    <span class="text-sm font-medium text-white">{{ auth()->user()->name }}</span>
                    <div class="flex items-center mt-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-teal-200 hover:text-white">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search in Sidebar -->
        <div class="relative">
            <div class="relative">
                <input
                    type="text"
                    id="user-search-input"
                    placeholder="Search users"
                    class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>

            {{-- Search results dropdown --}}
            <div id="search-results" class="absolute z-10 mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-200 max-h-80 overflow-y-auto hidden">
                {{-- Results will be loaded here via AJAX --}}
            </div>
        </div>

        <!-- Navigation in Sidebar -->
        <div class="px-4">
            <button onclick="showTab('overview')" class="w-full mb-2 flex items-center px-4 py-3 rounded-lg bg-teal-700 text-white">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span class="ml-3">Overview</span>
            </button>

            <button onclick="showTab('users')" class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">
                <i class="fas fa-users w-6"></i>
                <span class="ml-3">User Management</span>
            </button>

            <button onclick="showTab('content')" class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">
                <i class="fas fa-newspaper w-6"></i>
                <span class="ml-3">Content Moderation</span>
            </button>

{{--            <button onclick="showTab('reports')" class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">--}}
{{--                <i class="fas fa-chart-line w-6"></i>--}}
{{--                <span class="ml-3">Reports</span>--}}
{{--            </button>--}}

            <a href="{{route('home')}}"><button class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">
                    <i class="fas fa-comment-alt w-6"></i>
                    <span class="ml-3">User Dashboard</span>
                </button>
            </a>

{{--            <button class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">--}}
{{--                <i class="fas fa-shield-alt w-6"></i>--}}
{{--                <span class="ml-3">Security</span>--}}
{{--            </button>--}}

{{--            <button class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">--}}
{{--                <i class="fas fa-cog w-6"></i>--}}
{{--                <span class="ml-3">Settings</span>--}}
{{--            </button>--}}
        </div>

        <!-- Notifications -->

        <div class="mt-auto px-6 py-4 border-t border-teal-500">
            <div class="mt-auto px-6 py-4 border-t border-teal-500">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </div>

    </div>


    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Breadcrumb -->
        <div class="bg-white shadow-sm px-6 py-4">
            <div class="flex items-center text-sm text-gray-500">
                <a href="#" class="hover:text-teal-600">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">Content Moderation</span>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="container mx-auto px-6 py-6">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script>
    function showTab(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Show selected tab content
        document.getElementById(tabId).classList.remove('hidden');

        // Update tab button styles
        document.querySelectorAll('button[onclick^="showTab"]').forEach(button => {
            button.classList.remove('bg-teal-700');
            button.classList.add('hover:bg-teal-700');
        });

        // Style the active tab button
        const activeButton = document.querySelector(`button[onclick="showTab('${tabId}')"]`);
        activeButton.classList.remove('hover:bg-teal-700');
        activeButton.classList.add('bg-teal-700');
    }

    // Chart.js implementation
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

    function deletePost(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            fetch(`/admin/posts/${postId}/delete`, {
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
                        alert('Failed to delete post: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete post: ' + error.message);
                });
        }
    }



    // Add this to your scripts section
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#user-search-input');
        const searchResults = document.querySelector('#search-results');
        let searchTimeout;

        if (searchInput && searchResults) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                // Clear previous timeout
                clearTimeout(searchTimeout);

                // Show loading indicator
                if (query.length >= 2) {
                    searchResults.innerHTML = '<div class="p-3 text-center"><i class="fas fa-spinner fa-spin"></i> Searching...</div>';
                    searchResults.classList.remove('hidden');
                } else {
                    searchResults.classList.add('hidden');
                }

                // Set a timeout to avoid too many requests
                searchTimeout = setTimeout(() => {
                    if (query.length < 2) {
                        searchResults.classList.add('hidden');
                        return;
                    }

                    // Make AJAX request
                    fetch(`/admin/users/search?query=${encodeURIComponent(query)}`)
                        .then(response => response.text())
                        .then(html => {
                            searchResults.innerHTML = html;
                            searchResults.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            searchResults.innerHTML = '<div class="p-3 text-center text-red-500">Error searching users</div>';
                        });
                }, 300);
            });

            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        }
    });
</script>
</body>
</html>
