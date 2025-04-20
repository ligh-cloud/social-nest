<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .active-tab {
            color: #0D9488;
            border-bottom: 3px solid #0D9488;
        }
        .nav-item:hover {
            background-color: #F0F2F5;
            border-radius: 8px;
        }

        /* Mobile menu animation */
        .mobile-menu {
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Overlay for mobile menu */
        .menu-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }
        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 bg-teal-600 rounded-lg flex items-center justify-center hover:bg-teal-700 transition-colors">
                    <i class="fas fa-share-alt text-white text-xl"></i>
                </div>
                <h1 class="ml-3 text-xl font-bold text-gray-800">Admin Dashboard</h1>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-3">
                <!-- Action Buttons (Hidden on Mobile) -->
                <div class="hidden md:flex space-x-2">
                    <a href="#" class="bg-teal-600 text-white px-4 py-2 rounded-lg flex items-center hover:bg-teal-700 transition-colors">
                        <i class="fas fa-users mr-2"></i>
                        <span>Manage Users</span>
                    </a>
                    <a href="#" class="bg-teal-600 text-white px-4 py-2 rounded-lg flex items-center hover:bg-teal-700 transition-colors">
                        <i class="fas fa-clipboard-list mr-2"></i>
                        <span>Content Moderation</span>
                    </a>
                </div>

                <!-- Search (Hidden on Mobile) -->
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search dashboard..." class="w-64 py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-300 transition-all">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>

                <!-- Notifications with Dropdown -->
                <div class="relative">
                    <button class="p-2 rounded-full hover:bg-gray-100 relative transition-colors">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="relative hidden lg:block">
                    <button class="flex items-center hover:bg-gray-100 rounded-lg p-2 transition-colors">
                        <img src="/api/placeholder/40/40" alt="Admin" class="h-8 w-8 rounded-full mr-2 border-2 border-teal-200">
                        <div class="text-left mr-2">
                            <p class="text-sm font-medium text-gray-800">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>
                </div>

                <!-- Mobile Menu Button (visible on small screens) -->
                <button id="mobile-menu-button" class="lg:hidden p-2 rounded-md text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="container mx-auto px-4 border-b">
        <div class="flex space-x-8 overflow-x-auto">
            <a href="#" class="px-1 py-4 border-b-2 border-teal-500 text-teal-600 font-medium">Overview</a>
            <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">User Management</a>
            <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">Content Moderation</a>
            <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">Reports</a>
            <a href="#" class="px-1 py-4 text-gray-500 hover:text-gray-700">Analytics</a>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu fixed inset-y-0 left-0 w-64 bg-white shadow-lg z-20">
    <div class="p-4">
        <button id="close-menu-button" class="p-2 rounded-md text-gray-700 hover:bg-gray-100">
            <i class="fas fa-times text-xl"></i>
        </button>
        <ul class="mt-4 space-y-2">
            <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-100 rounded-lg">Dashboard</a></li>
            <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-100 rounded-lg">User Management</a></li>
            <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-100 rounded-lg">Content Moderation</a></li>
            <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-100 rounded-lg">Analytics</a></li>
            <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-100 rounded-lg">Settings</a></li>
        </ul>
    </div>
</div>

<!-- Menu Overlay -->
<div id="menu-overlay" class="menu-overlay fixed inset-0 z-10"></div>

<!-- Main Content -->
<main class="flex-grow">
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Company Info -->
            <div class="md:col-span-1">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 bg-teal-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-white text-sm"></i>
                    </div>
                    <h3 class="ml-2 text-lg font-semibold text-gray-800">SocialApp Admin</h3>
                </div>
                <p class="text-sm text-gray-600 mb-3">Powerful admin tools for your social media management.</p>
                <p class="text-sm text-gray-600">&copy; 2025 SocialApp Admin Dashboard. All rights reserved.</p>
            </div>

            <!-- Links (split into columns) -->
            <div>
                <h4 class="font-medium text-gray-800 mb-3">Resources</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Documentation</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Tutorials</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">API Reference</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Changelog</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-medium text-gray-800 mb-3">Company</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">About Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Careers</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Blog</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-medium text-gray-800 mb-3">Legal</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Security</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-teal-600 text-sm transition-colors">Compliance</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-200 mt-6 pt-6 flex flex-col md:flex-row justify-between items-center">
            <div class="flex space-x-4 mb-4 md:mb-0">
                <a href="#" class="text-gray-500 hover:text-teal-600 transition-colors">
                    <i class="fab fa-twitter text-lg"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-teal-600 transition-colors">
                    <i class="fab fa-facebook text-lg"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-teal-600 transition-colors">
                    <i class="fab fa-linkedin text-lg"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-teal-600 transition-colors">
                    <i class="fab fa-github text-lg"></i>
                </a>
            </div>
            <div class="text-sm text-gray-500">
                <select class="bg-gray-100 border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-teal-300">
                    <option>English (US)</option>
                    <option>Spanish</option>
                    <option>French</option>
                    <option>German</option>
                </select>
            </div>
        </div>
    </div>
</footer>

<script>
    // Global error handler
    window.addEventListener('error', function(event) {
        console.error('Global error:', event.error);
        alert('An error occurred: ' + event.error.message);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMenuButton = document.getElementById('close-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOverlay = document.getElementById('menu-overlay');

        function openMobileMenu() {
            mobileMenu.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Re-enable scrolling
        }

        mobileMenuButton.addEventListener('click', openMobileMenu);
        closeMenuButton.addEventListener('click', closeMobileMenu);
        menuOverlay.addEventListener('click', closeMobileMenu);

        // Close menu when a link is clicked
        const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Window resize handler for mobile menu
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
