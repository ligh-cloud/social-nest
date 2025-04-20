@extends('layouts.admin')

@section('content')
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

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Activity Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-4">User Activity</h3>
            <canvas id="userActivityChart"></canvas>
        </div>

        <!-- Post Activity Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-4">Post Activity</h3>
            <canvas id="postActivityChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Activity Chart
    const userCtx = document.getElementById('userActivityChart').getContext('2d');
    new Chart(userCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Users',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });

    // Post Activity Chart
    const postCtx = document.getElementById('postActivityChart').getContext('2d');
    new Chart(postCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Posts Created',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
@endpush
@endsection 