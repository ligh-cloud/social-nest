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
            <a href="{{ route('users.show', auth()->id()) }}">
            <div class="mb-8 flex items-center">
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">

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
                        <a href="{{ route('events') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('events') ? 'text-blue-500' : '' }}">
                            <i class="fas fa-calendar {{ request()->routeIs('events') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    @if($user->role_id == 1 )
                        <li class="mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg {{ request()->routeIs('events') ? 'text-blue-500' : '' }}">
                                <i class="fas fa-tachometer-alt {{ request()->routeIs('admin.dashboard') ? 'text-blue-500' : 'text-blue-400' }} mr-3 text-xl"></i>

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

<!-- Enhanced Alert Container -->
<div id="alert-container" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; width: 90%; max-width: 450px; display: none;">
    <div id="alert-box" class="alert-box" style="padding: 16px 20px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.18); display: flex; align-items: center; justify-content: space-between; animation: bounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2);">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div id="alert-icon-container" style="width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i id="alert-icon" style="font-size: 1.4em;"></i>
            </div>
            <div>
                <div id="alert-title" style="font-weight: 600; font-size: 1.05rem; margin-bottom: 2px;"></div>
                <div id="alert-message" style="font-size: 0.95rem; opacity: 0.9;"></div>
            </div>
        </div>
        <button onclick="hideAlert()" style="background: none; border: none; color: inherit; cursor: pointer; font-size: 1.1em; opacity: 0.7; transition: opacity 0.2s; padding: 8px; margin: -8px; border-radius: 50%;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div id="alert-progress" style="width: 100%; height: 4px; margin-top: 4px; border-radius: 2px; overflow: hidden; background: rgba(255,255,255,0.2); display: none;">
        <div id="alert-progress-bar" style="height: 100%; width: 100%; background: rgba(255,255,255,0.4);"></div>
    </div>
</div>

<!-- Add these styles to your head or stylesheet -->
<style>
    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.8); }
        70% { transform: scale(1.05); }
        100% { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeOutUp {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(-20px); }
    }

    @keyframes progressShrink {
        from { width: 100%; }
        to { width: 0%; }
    }

    .alert-success {
        background: linear-gradient(145deg, rgba(52, 211, 153, 0.95), rgba(16, 185, 129, 0.95));
        color: white;
    }

    .alert-error {
        background: linear-gradient(145deg, rgba(248, 113, 113, 0.95), rgba(239, 68, 68, 0.95));
        color: white;
    }

    .alert-warning {
        background: linear-gradient(145deg, rgba(251, 191, 36, 0.95), rgba(245, 158, 11, 0.95));
        color: white;
    }

    .alert-info {
        background: linear-gradient(145deg, rgba(96, 165, 250, 0.95), rgba(59, 130, 246, 0.95));
        color: white;
    }

    .icon-container-success {
        background-color: rgba(255, 255, 255, 0.25);
    }

    .icon-container-error {
        background-color: rgba(255, 255, 255, 0.25);
    }

    .icon-container-warning {
        background-color: rgba(255, 255, 255, 0.25);
    }

    .icon-container-info {
        background-color: rgba(255, 255, 255, 0.25);
    }
</style>

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

                // Parse the notification data
                let data;
                try {
                    data = typeof notification.data === 'string' ? JSON.parse(notification.data) : notification.data;
                } catch (e) {
                    console.error('Error parsing notification data:', e);
                    data = {};
                }

                // Determine icon and action link based on notification type
                let icon = 'fas fa-bell'; // default icon
                let actionLink = '#';

                if (data.type === 'friend_post') {
                    icon = 'fas fa-newspaper';
                    actionLink = `/posts/${data.post_id || ''}`;
                } else if (data.type === 'friend_request') {
                    icon = 'fas fa-user-friends';
                    actionLink = `/friends/requests`;
                } else if (data.type === 'post_like') {
                    icon = 'fas fa-heart';
                    actionLink = `/posts/${data.post_id || ''}`;
                } else if (data.type === 'post_comment') {
                    icon = 'fas fa-comment';
                    actionLink = `/posts/${data.post_id || ''}#comment-${data.comment_id || ''}`;
                } else if (data.type === 'new_message') {
                    icon = 'fas fa-envelope';
                    actionLink = `/messages/${data.conversation_id || ''}`;
                }

                notifElement.innerHTML = `
                <div class="flex-shrink-0 mr-3">
                    <i class="${icon} text-blue-500 text-xl w-6 text-center"></i>
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">${data.message || 'New notification'}</p>
                    <p class="text-xs text-gray-500 mt-1">${formatTimeAgo(new Date(notification.created_at))}</p>
                </div>`;

                // Add click event to mark as read and navigate
                notifElement.addEventListener('click', () => {
                    markNotificationAsRead(notification.id);
                    if (actionLink !== '#') {
                        window.location.href = actionLink;
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

        // Enhanced Sweet Alert functionality
        function showAlert(message, type, title = '', duration = 5000) {
            const alertContainer = document.getElementById('alert-container');
            const alertBox = document.getElementById('alert-box');
            const alertIcon = document.getElementById('alert-icon');
            const alertIconContainer = document.getElementById('alert-icon-container');
            const alertMessage = document.getElementById('alert-message');
            const alertTitle = document.getElementById('alert-title');
            const alertProgress = document.getElementById('alert-progress');
            const alertProgressBar = document.getElementById('alert-progress-bar');

            // Reset any previous animations
            alertBox.style.animation = 'bounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards';

            // Set message and title
            alertMessage.textContent = message;
            alertTitle.textContent = title || getDefaultTitle(type);

            // Remove previous classes
            alertBox.className = 'alert-box';
            alertIconContainer.className = '';

            // Set style based on type
            if (type === 'success') {
                alertBox.classList.add('alert-success');
                alertIconContainer.classList.add('icon-container-success');
                alertIcon.className = 'fas fa-check';
            } else if (type === 'error') {
                alertBox.classList.add('alert-error');
                alertIconContainer.classList.add('icon-container-error');
                alertIcon.className = 'fas fa-exclamation';
            } else if (type === 'warning') {
                alertBox.classList.add('alert-warning');
                alertIconContainer.classList.add('icon-container-warning');
                alertIcon.className = 'fas fa-exclamation-triangle';
            } else if (type === 'info') {
                alertBox.classList.add('alert-info');
                alertIconContainer.classList.add('icon-container-info');
                alertIcon.className = 'fas fa-info';
            }

            // Show alert and progress bar
            alertContainer.style.display = 'block';
            alertProgress.style.display = 'block';

            // Animate progress bar
            alertProgressBar.style.animation = `progressShrink ${duration}ms linear forwards`;

            // Auto hide after duration
            setTimeout(hideAlert, duration);

            return alertBox; // Return the alert element for potential further manipulation
        }

        function getDefaultTitle(type) {
            switch(type) {
                case 'success': return 'Success!';
                case 'error': return 'Error!';
                case 'warning': return 'Warning!';
                case 'info': return 'Information';
                default: return '';
            }
        }

        function hideAlert() {
            const alertContainer = document.getElementById('alert-container');
            const alertBox = document.getElementById('alert-box');

            alertBox.style.animation = 'fadeOutUp 0.3s forwards';

            setTimeout(() => {
                alertContainer.style.display = 'none';
                alertBox.style.animation = '';
            }, 300);
        }

        // Process Laravel flash messages
        @if(session('success'))
        showAlert("{{ session('success') }}", 'success');
        @endif

        @if(session('error'))
        showAlert("{{ session('error') }}", 'error');
        @endif

        @if(session('warning'))
        showAlert("{{ session('warning') }}", 'warning');
        @endif

        @if(session('info'))
        showAlert("{{ session('info') }}", 'info');
        @endif

        // Process validation errors
        @if($errors->any())
        showAlert("{{ $errors->first() }}", 'error', 'Validation Error');
        @endif

        // Check for hidden input fields with flash messages
        const sessionMessage = document.getElementById('session-message');
        const sessionError = document.getElementById('session-error');

        if (sessionMessage && sessionMessage.value) {
            showAlert(sessionMessage.value, 'success');
        }

        if (sessionError && sessionError.value) {
            showAlert(sessionError.value, 'error');
        }
    });
</script>
