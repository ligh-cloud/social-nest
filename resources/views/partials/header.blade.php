<div class="lg:hidden fixed top-4 left-4 z-30">
    <button id="mobile-menu-button" class="text-gray-700 p-2 rounded-full bg-white shadow-md">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>

<!-- Mobile Menu Overlay -->
<div id="menu-overlay" class="menu-overlay fixed inset-0 z-40 lg:hidden"></div>

<!-- Main Content Wrapper -->
<div class="flex">
    <!-- Left Sidebar - Desktop view -->
    <div class="hidden lg:block w-1/5 h-screen bg-white p-4 fixed border-r border-gray-200">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('image/logo.png') }}" alt="SocialNest Logo" class="w-12 h-12">
            </div>

            <!-- User Profile -->
            <div class="mb-8 flex items-center">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                <div class="text-gray-700 text-lg font-medium">{{ auth()->user()->name ?? 'John Doe' }}</div>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-6">
                <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>

            <!-- Navigation -->
            <nav class="flex-grow">
                <ul>
                    <li class="mb-1">
                        <a href="{{ route('home') }}" class="nav-item flex items-center p-2 text-gray-900 font-medium rounded-lg">
                            <i class="fas fa-home text-blue-500 mr-3 text-xl"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('friends') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-user-friends text-blue-400 mr-3 text-xl"></i>
                            <span>Friends</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('watch') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-play text-blue-400 mr-3 text-xl"></i>
                            <span>Watch</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('memories') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-clock text-blue-400 mr-3 text-xl"></i>
                            <span>Memories</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('saved') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-bookmark text-blue-400 mr-3 text-xl"></i>
                            <span>Saved</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('pages') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-flag text-blue-400 mr-3 text-xl"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('events') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-calendar text-blue-400 mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Settings & Logout -->
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

    <!-- Mobile Sidebar (off-canvas) -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-4/5 h-screen bg-white z-50 p-4 lg:hidden shadow-xl overflow-y-auto">
        <div class="flex flex-col h-full">
            <!-- Logo and Close Button -->
            <div class="flex justify-between items-center mb-6">
                <img src="{{ asset('image/logo.png') }}" alt="SocialNest Logo" class="w-10 h-10">
                <button id="close-menu-button" class="text-gray-500 hover:text-gray-800">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>


            <div class="mb-6 flex items-center">
                <img src="{{ asset('storage,/' . $user->profile_photo_path) }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                <div class="text-gray-700 text-lg font-medium">{{ auth()->user()->name ?? 'John Doe' }}</div>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-6">
                <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>

            <!-- Navigation -->
            <nav class="flex-grow">
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="nav-item flex items-center p-2 text-gray-900 font-medium rounded-lg">
                            <i class="fas fa-home text-blue-500 mr-3 text-xl"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('friends') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-user-friends text-blue-400 mr-3 text-xl"></i>
                            <span>Friends</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('watch') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-play text-blue-400 mr-3 text-xl"></i>
                            <span>Watch</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('memories') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-clock text-blue-400 mr-3 text-xl"></i>
                            <span>Memories</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('saved') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-bookmark text-blue-400 mr-3 text-xl"></i>
                            <span>Saved</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('pages') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-flag text-blue-400 mr-3 text-xl"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('events') }}" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-calendar text-blue-400 mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Settings & Logout -->
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

    <!-- Top Navigation Tabs -->
    <div class="bg-white rounded-t-lg shadow-sm w-full lg:w-3/5 lg:ml-[20%]">
        <div class="flex justify-center border-b">
            <div class="flex space-x-12">
                <button class="py-3 px-6 flex items-center justify-center active-tab">
                    <i class="fas fa-home text-xl"></i>
                </button>
                <a href="{{ route('friends.suggestions') }}" class="py-3 px-6 flex items-center justify-center text-gray-500 hover:text-blue-500">
                    <i class="fas fa-user-friends text-xl"></i>
                </a>
                <button  class="py-3 px-6 flex items-center justify-center text-gray-500">
                    <i class="fas fa-bell text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Create Post Section -->


    </div>
</div>
