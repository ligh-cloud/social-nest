<div class="lg:hidden fixed top-4 left-4 z-30">
    <button id="mobile-menu-button" class="text-gray-700 p-2 rounded-full bg-white shadow-md">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>
<div id="menu-overlay" class="menu-overlay fixed inset-0 z-40 lg:hidden hidden bg-black bg-opacity-50"></div>
<div class="flex">
    <!-- Desktop Sidebar -->
    <div class="hidden lg:block w-1/5 h-screen bg-white p-4 fixed border-r border-gray-200">
        <div class="flex flex-col h-full">
            <div class="mb-6">
                <img src="{{ asset('image/logo.png') }}" alt="SocialNest Logo" class="w-12 h-12">
            </div>
            <div class="mb-8 flex items-center">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                <div class="text-gray-700 text-lg font-medium">{{ auth()->user()->name ?? 'John Doe' }}</div>
            </div>
            <div class="relative mb-6">
                <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
            <nav class="flex-grow">
                <ul>
                    <li class="mb-1">
                        <a href="{{ route('home') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('home') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-home {{ request()->routeIs('home') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('friends') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('friends*') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-user-friends {{ request()->routeIs('friends*') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Friends</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('watch') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('watch') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-play {{ request()->routeIs('watch') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Watch</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('messages') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('messages') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-comments {{ request()->routeIs('messages') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('saved') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('saved') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-bookmark {{ request()->routeIs('saved') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Saved</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('pages') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('pages') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-flag {{ request()->routeIs('pages') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('events') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('events') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-calendar {{ request()->routeIs('events') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    @if($user->role_id == 1 )
                        <li class="mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('events') ? 'text-blue-500' : '' }}">
                                <i class="fas fa-calendar {{ request()->routeIs('events') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                                <span>Admin Dashboard</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="mt-auto">
                <a href="{{ route('settings') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg mb-1">
                    <i class="fas fa-cog text-gray-600 mr-3 text-xl"></i>
                    <span>Settings</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                    <i class="fas fa-sign-out-alt text-gray-600 mr-3 text-xl"></i>
                    <span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-4/5 h-screen bg-white z-50 p-4 lg:hidden shadow-xl overflow-y-auto transform -translate-x-full transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center mb-6">
                <img src="{{ asset('image/logo.png') }}" alt="SocialNest Logo" class="w-10 h-10">
                <button id="close-menu-button" class="text-gray-500 hover:text-gray-800">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="mb-6 flex items-center">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                <div class="text-gray-700 text-lg font-medium">{{ auth()->user()->name ?? 'John Doe' }}</div>
            </div>
            <div class="relative mb-6">
                <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
            <nav class="flex-grow">
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('home') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-home {{ request()->routeIs('home') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('friends') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('friends*') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-user-friends {{ request()->routeIs('friends*') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Friends</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('watch') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('watch') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-play {{ request()->routeIs('watch') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Watch</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('messages') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('messages') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-comments {{ request()->routeIs('messages') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('saved') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('saved') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-bookmark {{ request()->routeIs('saved') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Saved</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('pages') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('pages') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-flag {{ request()->routeIs('pages') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('events') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('events') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-calendar {{ request()->routeIs('events') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-auto pb-4">
                <a href="{{ route('settings') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg mb-2">
                    <i class="fas fa-cog text-gray-600 mr-3 text-xl"></i>
                    <span>Settings</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                    <i class="fas fa-sign-out-alt text-gray-600 mr-3 text-xl"></i>
                    <span>Log Out</span>
                </a>
                <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Top Navigation -->
    <div class="bg-white rounded-t-lg shadow-sm w-full lg:w-3/5 lg:ml-[20%]">
        <div class="flex justify-center border-b">
            <div class="flex justify-between w-full max-w-md px-4">  <!-- Changed this line -->
                <a href="{{ route('home') }}" class="py-3 px-4 flex items-center justify-center flex-1 {{ request()->routeIs('home') ? 'text-blue-500 border-b-2 border-blue-500' : 'text-gray-500 hover:text-blue-500' }}">
                    <i class="fas fa-home text-xl"></i>
                </a>
                <a href="{{ route('friends.suggestions') }}" class="py-3 px-4 flex items-center justify-center flex-1 {{ request()->routeIs('friends*') ? 'text-blue-500 border-b-2 border-blue-500' : 'text-gray-500 hover:text-blue-500' }}">
                    <i class="fas fa-user-friends text-xl"></i>
                </a>
                <!-- Notification Button -->
                <button id="notification-toggle" class="relative py-3 px-4 flex items-center justify-center flex-1 text-gray-600 hover:text-blue-500 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span id="notification-counter" class="absolute top-6 right-14 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full {{ Auth::user()->unreadNotifications->count() > 0 ? '' : 'hidden' }}">
                    {{ Auth::user()->unreadNotifications->count() }}
                </span>
                </button>
                <div id="notification-dropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg overflow-hidden z-50 hidden">
                    <div class="py-2 px-3 bg-gray-100 border-b">
                        <h3 class="text-sm font-medium text-gray-700">Notifications</h3>
                    </div>
                    <div id="notification-list" class="max-h-64 overflow-y-auto"></div>
                    <div class="p-2 bg-gray-50 border-t text-center">
                        <a href="{{ route('notifications.index') }}" class="text-sm text-blue-500 hover:underline">View all notifications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMenuButton = document.getElementById('close-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOverlay = document.getElementById('menu-overlay');

        // Toggle mobile menu
        if(mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.remove('-translate-x-full');
                menuOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
        }

        // Close mobile menu
        [closeMenuButton, menuOverlay].forEach(el => {
            if(el) el.addEventListener('click', () => {
                mobileMenu.classList.add('-translate-x-full');
                menuOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
        });

        // Notification system
        const notificationToggle = document.getElementById('notification-toggle');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationCounter = document.getElementById('notification-counter');
        const notificationList = document.getElementById('notification-list');

        // Toggle notification dropdown
        if (notificationToggle && notificationDropdown) {
            // Load initial notifications
            loadNotifications();

            notificationToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('hidden');
                if (!notificationDropdown.classList.contains('hidden')) markNotificationsAsSeen();
            });

            // Close when clicking outside
            document.addEventListener('click', function(event) {
                if (!notificationToggle.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });

            // Check for new notifications every 30 seconds
            setInterval(loadNotifications, 30000);
        }

        // Load notifications via AJAX
        function loadNotifications() {
            fetch('/notifications/get-unread')
                .then(response => response.ok ? response.json() : Promise.reject('Network error'))
                .then(data => {
                    if (notificationList) updateNotificationList(data.notifications);
                    if (notificationCounter) updateCounter(data.notifications.length);
                })
                .catch(error => console.error('Error loading notifications:', error));
        }

        // Update the notification list
        function updateNotificationList(notifications) {
            notificationList.innerHTML = notifications.length === 0 ?
                '<div class="p-4 text-center text-gray-500 text-sm">No notifications yet</div>' : '';

            notifications.forEach(notification => {
                const notifElement = document.createElement('div');
                notifElement.className = `flex items-center p-3 border-b hover:bg-gray-50 transition ${notification.read_at ? '' : 'bg-blue-50'}`;

                // Parse notification data
                const data = typeof notification.data === 'string' ? JSON.parse(notification.data) : notification.data;

                // Create message and get image
                let message = data.message || 'New notification';
                let userImagePath = data.user_image ? `/storage/${data.user_image}` : '/images/default-avatar.png';

                notifElement.innerHTML = `
                <div class="flex-shrink-0 mr-3">
                    <img src="${userImagePath}" alt="" class="w-10 h-10 rounded-full">
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">${message}</p>
                    <p class="text-xs text-gray-500 mt-1">${formatTimeAgo(new Date(notification.created_at))}</p>
                </div>`;

                notifElement.addEventListener('click', () => {
                    markNotificationAsRead(notification.id);
                    // Handle click based on notification type
                    if (notification.type && notification.type.includes('FriendPosted') && data.post_id) {
                        window.location.href = `/posts/${data.post_id}`;
                    }
                });

                notificationList.appendChild(notifElement);
            });
        }

        // Update counter
        function updateCounter(count) {
            if (count > 0) {
                notificationCounter.textContent = count;
                notificationCounter.classList.remove('hidden');
            } else {
                notificationCounter.classList.add('hidden');
            }
        }

        // Mark notifications as seen
        function markNotificationsAsSeen() {
            fetch('/notifications/mark-as-seen', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
        }

        // Mark single notification as read
        function markNotificationAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/mark-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
        }

        // Format time as "x minutes ago"
        function formatTimeAgo(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            let interval = seconds / 31536000;
            if (interval > 1) return Math.floor(interval) + " years ago";
            interval = seconds / 2592000;
            if (interval > 1) return Math.floor(interval) + " months ago";
            interval = seconds / 86400;
            if (interval > 1) return Math.floor(interval) + " days ago";
            interval = seconds / 3600;
            if (interval > 1) return Math.floor(interval) + " hours ago";
            interval = seconds / 60;
            if (interval > 1) return Math.floor(interval) + " minutes ago";
            return "just now";
        }
    });
</script>
