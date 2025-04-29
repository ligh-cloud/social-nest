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
    <!-- Sidebar Navigation with expanded content -->
    <div class="w-64 bg-teal-600 flex flex-col py-6 shadow-lg">
        <div class="px-6 mb-8 flex items-center">
            <div class="w-10 h-10 bg-white rounded flex items-center justify-center mr-3">
                <i class="fas fa-share-alt text-teal-600 text-lg"></i>
            </div>
            <h1 class="text-xl font-semibold text-white">Admin Dashboard</h1>
        </div>

        <!-- User Profile in Sidebar -->
        <div class="px-6 mb-6 py-3 border-b border-teal-500">
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
        <div class="px-6 mb-6">
            <div class="relative">
                <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 border border-teal-500 rounded-lg bg-teal-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 placeholder-teal-300">
                <i class="fas fa-search absolute left-3 top-3 text-teal-300"></i>
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

            <button onclick="showTab('reports')" class="w-full mb-2 flex items-center px-4 py-3 rounded-lg hover:bg-teal-700 text-white">
                <i class="fas fa-chart-line w-6"></i>
                <span class="ml-3">Reports</span>
            </button>
        </div>

        <!-- Notifications -->
        <div class="mt-auto px-6 py-4 border-t border-teal-500">
            <div class="flex items-center text-white">
                <div class="relative mr-3">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute -top-1 -right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                </div>
                <span class="text-sm">Notifications</span>
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
    // Base JavaScript functions
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

    // Initialize Chart.js if the view needs it
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($stats) && request()->is('admin*'))
        // Chart.js implementation for admin dashboard
        const ctx = document.getElementById('userChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
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
        }
        @endif
    });

    // Base admin functions
    function banUser(userId) {
        if (confirm('Are you sure you want to ban this user?')) {
            fetch(`/admin/users/${userId}/ban`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
                .then(handleResponse)
                .catch(handleError);
        }
    }

    function handleResponse(response) {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    }

    function handleError(error) {
        console.error('Error:', error);
        alert('Operation failed: ' + error.message);
    }
</script>
@yield('scripts')
</body>
</html>
