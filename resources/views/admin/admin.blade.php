@extends('layouts.admin')

@section('title', 'admin')

@section('content')



<!-- Main Content -->
<main class="flex-grow">
    <div class="container mx-auto px-4 py-6">
        <!-- Admin Dashboard Header -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
                <div class="flex items-center mt-3 md:mt-0">
                    <div class="relative mr-4">
                        <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-download mr-2"></i>
                        <span>Export</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <!-- Users Card -->
            <div class="bg-white rounded-lg shadow-sm p-4">
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
            <div class="bg-white rounded-lg shadow-sm p-4">
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
                        <i class="fas fa-file-alt text-purple-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Engagement Card -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Engagement Rate</p>
                        <h3 class="text-2xl font-bold">67%</h3>
                        <p class="text-red-500 text-xs flex items-center mt-1">
                            <i class="fas fa-arrow-down mr-1"></i>
                            <span>3% from last month</span>
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-chart-line text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- New Registrations Card -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">New Registrations</p>
                        <h3 class="text-2xl font-bold">354</h3>
                        <p class="text-green-500 text-xs flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>18% from last month</span>
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-user-plus text-yellow-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <!-- User Growth Chart -->
            <div class="bg-white rounded-lg shadow-sm p-4 lg:col-span-2">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">User Growth</h2>
                <div style="height: 300px;">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>

            <!-- Engagement Distribution Chart -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Engagement</h2>
                <div style="height: 300px;">
                    <canvas id="engagementChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Content Overview & Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <!-- Content Overview Table -->
            <div class="bg-white rounded-lg shadow-sm p-4 lg:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Recent Posts</h2>
                    <a href="#" class="text-blue-500 text-sm">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="text-left text-xs text-gray-500">
                            <th class="px-4 py-2">POST</th>
                            <th class="px-4 py-2">AUTHOR</th>
                            <th class="px-4 py-2">LIKES</th>
                            <th class="px-4 py-2">COMMENTS</th>
                            <th class="px-4 py-2">DATE</th>
                            <th class="px-4 py-2">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        <!-- Sample post row -->
                        <tr class="text-sm">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-200 rounded overflow-hidden mr-3">
                                        <svg width="100%" height="100%" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="40" height="40" fill="#EAEAEA"/>
                                            <path d="M0,30 L15,10 L25,20 L40,5 L40,40 L0,40 Z" fill="#A0AEC0"/>
                                        </svg>
                                    </div>
                                    <div class="truncate w-32">
                                        <p class="font-medium">Mount Rainier Hiking</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">Sarah Johnson</td>
                            <td class="px-4 py-3">24</td>
                            <td class="px-4 py-3">8</td>
                            <td class="px-4 py-3">Mar 14, 2025</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Repeat for more rows -->
                        <tr class="text-sm">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-200 rounded overflow-hidden mr-3">
                                        <svg width="100%" height="100%" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="40" height="40" fill="#EAEAEA"/>
                                            <path d="M10,10 L30,10 L30,30 L10,30 Z" fill="#A0AEC0"/>
                                        </svg>
                                    </div>
                                    <div class="truncate w-32">
                                        <p class="font-medium">Programming Books for Beginners</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">Michael Chen</td>
                            <td class="px-4 py-3">15</td>
                            <td class="px-4 py-3">12</td>
                            <td class="px-4 py-3">Mar 13, 2025</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-sm">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-200 rounded overflow-hidden mr-3">
                                        <svg width="100%" height="100%" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="40" height="40" fill="#EAEAEA"/>
                                            <circle cx="20" cy="20" r="10" fill="#A0AEC0"/>
                                        </svg>
                                    </div>
                                    <div class="truncate w-32">
                                        <p class="font-medium">Meet Max, My New Dog!</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">Emily Garcia</td>
                            <td class="px-4 py-3">87</td>
                            <td class="px-4 py-3">32</td>
                            <td class="px-4 py-3">Mar 11, 2025</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
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
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Recent Activity</h2>
                    <a href="#" class="text-blue-500 text-sm">View All</a>
                </div>
                <div class="space-y-4">
                    <!-- Activity Item -->
                    <div class="flex">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                            <i class="fas fa-user-plus text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">New user registered</p>
                            <p class="text-xs text-gray-500">10 minutes ago</p>
                        </div>
                    </div>
                    <!-- Activity Item -->
                    <div class="flex">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                            <i class="fas fa-comment text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">New comment on "Mount Rainier Hiking"</p>
                            <p class="text-xs text-gray-500">25 minutes ago</p>
                        </div>
                    </div>
                    <!-- Activity Item -->
                    <div class="flex">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                            <i class="fas fa-flag text-yellow-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Post reported: "Inappropriate Content"</p>
                            <p class="text-xs text-gray-500">1 hour ago</p>
                        </div>
                    </div>
                    <!-- Activity Item -->
                    <div class="flex">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                            <i class="fas fa-trash text-red-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Admin deleted a post</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <!-- Activity Item -->
                    <div class="flex">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                            <i class="fas fa-user-shield text-purple-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">User role updated to Moderator</p>
                            <p class="text-xs text-gray-500">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traffic Analytics Chart -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Traffic Analytics</h2>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-md bg-white hover:bg-gray-50">Day</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-md bg-white hover:bg-gray-50">Week</button>
                    <button class="px-3 py-1 text-sm border border-blue-500 text-white bg-blue-500 rounded-md">Month</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-md bg-white hover:bg-gray-50">Year</button>
                </div>
            </div>
            <div style="height: 300px;">
                <canvas id="trafficAnalyticsChart"></canvas>
            </div>
        </div>
    </div>
</main>

@endsection

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Growth Chart
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        const userGrowthChart = new Chart(userGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'New Users',
                        data: [120, 150, 180, 270, 310, 350, 410, 520, 560, 650, 720, 800],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Active Users',
                        data: [320, 350, 380, 470, 510, 550, 610, 720, 760, 850, 920, 1000],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
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

        // Engagement Chart
        const engagementCtx = document.getElementById('engagementChart').getContext('2d');
        const engagementChart = new Chart(engagementCtx, {
            type: 'doughnut',
            data: {
                labels: ['Likes', 'Comments', 'Shares', 'Saved'],
                datasets: [{
                    data: [45, 25, 15, 15],
                    backgroundColor: [
                        '#3B82F6', // blue
                        '#10B981', // green
                        '#F59E0B', // yellow
                        '#6366F1'  // indigo
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

        // Traffic Analytics Chart
        const trafficCtx = document.getElementById('trafficAnalyticsChart').getContext('2d');
        const trafficChart = new Chart(trafficCtx, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
                    '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                datasets: [{
                    label: 'Page Views',
                    data: [1200, 1900, 2100, 2500, 2000, 2200, 2400, 3000, 2900, 3100, 3300, 3500, 3200, 3400, 3600,
                        2700, 2800, 3200, 3600, 3800, 4000, 3900, 3700, 3500, 3800, 4200, 4500, 4300, 4100, 4600],
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: '#3B82F6',
                    borderWidth: 1
                },
                    {
                        label: 'Unique Visitors',
                        data: [900, 1200, 1400, 1600, 1500, 1700, 1800, 2100, 2000, 2200, 2300, 2400, 2200, 2300, 2500,
                            2000, 2100, 2300, 2600, 2700, 2800, 2700, 2600, 2500, 2700, 2900, 3100, 3000, 2800, 3200],
                        backgroundColor: 'rgba(16, 185, 129, 0.5)',
                        borderColor: '#10B981',
                        borderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
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

        console.log('Admin dashboard loaded');
    });
</script>
</body>
</html>
