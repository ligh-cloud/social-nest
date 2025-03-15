<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNest - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .active-tab {
            color: #1877F2;
            border-bottom: 3px solid #1877F2;
        }
        .nav-item:hover {
            background-color: #F0F2F5;
            border-radius: 8px;
        }
        .post-input:focus {
            outline: none;
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
</head>
<body class="bg-gray-100">

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
                <img src="profile/profile.jpg" alt="SocialNest Logo" class="w-12 h-12">
            </div>

            <!-- User Profile -->
            <div class="mb-8 flex items-center">
                <img src="/profile/profile.jpg" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                <div class="text-gray-700 text-lg font-medium">John Doe</div>
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
                        <a href="#" class="nav-item flex items-center p-2 text-gray-900 font-medium rounded-lg">
                            <i class="fas fa-home text-blue-500 mr-3 text-xl"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-user-friends text-blue-400 mr-3 text-xl"></i>
                            <span>Friends</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-play text-blue-400 mr-3 text-xl"></i>
                            <span>Watch</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-clock text-blue-400 mr-3 text-xl"></i>
                            <span>Memories</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-bookmark text-blue-400 mr-3 text-xl"></i>
                            <span>Saved</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-flag text-blue-400 mr-3 text-xl"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-calendar text-blue-400 mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Settings & Logout -->
            <div class="mt-auto">
                <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg mb-1">
                    <i class="fas fa-cog text-gray-600 mr-3 text-xl"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                    <i class="fas fa-sign-out-alt text-gray-600 mr-3 text-xl"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar (off-canvas) -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-4/5 h-screen bg-white z-50 p-4 lg:hidden shadow-xl overflow-y-auto">
        <div class="flex flex-col h-full">
            <!-- Logo and Close Button -->
            <div class="flex justify-between items-center mb-6">
                <img src="/api/placeholder/48/48" alt="SocialNest Logo" class="w-10 h-10">
                <button id="close-menu-button" class="text-gray-500 hover:text-gray-800">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- User Profile -->
            <div class="mb-6 flex items-center">
                <img src="/api/placeholder/40/40" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                <div class="text-gray-700 text-lg font-medium">John Doe</div>
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
                        <a href="#" class="nav-item flex items-center p-2 text-gray-900 font-medium rounded-lg">
                            <i class="fas fa-home text-blue-500 mr-3 text-xl"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-user-friends text-blue-400 mr-3 text-xl"></i>
                            <span>Friends</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-play text-blue-400 mr-3 text-xl"></i>
                            <span>Watch</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-clock text-blue-400 mr-3 text-xl"></i>
                            <span>Memories</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-bookmark text-blue-400 mr-3 text-xl"></i>
                            <span>Saved</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-flag text-blue-400 mr-3 text-xl"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                            <i class="fas fa-calendar text-blue-400 mr-3 text-xl"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Settings & Logout -->
            <div class="mt-auto pb-4">
                <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg mb-2">
                    <i class="fas fa-cog text-gray-600 mr-3 text-xl"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="nav-item flex items-center p-2 text-gray-700 font-medium rounded-lg">
                    <i class="fas fa-sign-out-alt text-gray-600 mr-3 text-xl"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full lg:w-3/5 lg:ml-[20%] p-4">
        <!-- Top Navigation Tabs -->
        <div class="bg-white rounded-t-lg shadow-sm">
            <div class="flex justify-center border-b">
                <div class="flex space-x-12">
                    <button class="py-3 px-6 flex items-center justify-center active-tab">
                        <i class="fas fa-home text-xl"></i>
                    </button>
                    <button class="py-3 px-6 flex items-center justify-center text-gray-500">
                        <i class="fas fa-user-friends text-xl"></i>
                    </button>
                    <button class="py-3 px-6 flex items-center justify-center text-gray-500">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Create Post Section -->
            <div class="p-4">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/40/40" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                    <div class="bg-gray-100 rounded-full flex-grow">
                        <input type="text" placeholder="Ask a question or start a post" class="post-input w-full py-2 px-4 bg-transparent rounded-full">
                    </div>
                </div>
                <div class="flex flex-wrap justify-between">
                    <button class="flex items-center p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition mb-2 sm:mb-0">
                        <i class="fas fa-image mr-2"></i>
                        <span>Add media</span>
                    </button>
                    <div class="flex items-center">
                        <button class="flex items-center p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <span>Add Category</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feed Content -->
        <div class="mt-4">
            <!-- Sample Post 1 -->
            <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center mb-3">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                        <div>
                            <div class="font-medium">Sarah Johnson</div>
                            <div class="text-xs text-gray-500">2 hours ago</div>
                        </div>
                    </div>
                    <p class="mb-4">Just finished hiking at Mount Rainier! The views were absolutely breathtaking. Has anyone else been there recently?</p>

                    <!-- SVG Fake Photo (Mountain Landscape) -->
                    <div class="w-full h-64 rounded-lg mb-3 overflow-hidden">
                        <svg width="100%" height="100%" viewBox="0 0 600 400" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                            <!-- Sky -->
                            <rect x="0" y="0" width="600" height="280" fill="#87CEEB" />

                            <!-- Sun -->
                            <circle cx="500" cy="80" r="40" fill="#FFD700" />

                            <!-- Mountains -->
                            <polygon points="0,280 150,100 300,200 450,80 600,250 600,280" fill="#6B8E23" />
                            <polygon points="0,280 200,180 400,250 600,200 600,280" fill="#556B2F" />

                            <!-- Snow caps -->
                            <polygon points="150,100 170,120 130,120" fill="white" />
                            <polygon points="450,80 470,100 430,100" fill="white" />

                            <!-- Lake -->
                            <rect x="0" y="280" width="600" height="120" fill="#4682B4" />

                            <!-- Lake reflections -->
                            <path d="M50,300 C100,310 150,290 200,305 S250,280 300,300 S350,320 400,300 S450,290 500,310 S550,300 600,290"
                                  stroke="white" stroke-width="1" fill="none" />

                            <!-- Trees -->
                            <g transform="translate(100, 230)">
                                <rect x="-5" y="0" width="10" height="20" fill="#8B4513" />
                                <polygon points="0,-30 15,0 -15,0" fill="#2E8B57" />
                                <polygon points="0,-40 12,-15 -12,-15" fill="#2E8B57" />
                                <polygon points="0,-50 10,-30 -10,-30" fill="#2E8B57" />
                            </g>
                            <g transform="translate(160, 250)">
                                <rect x="-4" y="0" width="8" height="15" fill="#8B4513" />
                                <polygon points="0,-25 12,0 -12,0" fill="#2E8B57" />
                                <polygon points="0,-35 10,-15 -10,-15" fill="#2E8B57" />
                            </g>
                            <g transform="translate(500, 240)">
                                <rect x="-5" y="0" width="10" height="20" fill="#8B4513" />
                                <polygon points="0,-30 15,0 -15,0" fill="#2E8B57" />
                                <polygon points="0,-40 12,-15 -12,-15" fill="#2E8B57" />
                            </g>
                        </svg>
                    </div>

                    <div class="flex justify-between text-gray-500 text-sm pt-2 border-t">
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-thumbs-up mr-1"></i>
                            <span>Like (24)</span>
                        </button>
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-comment mr-1"></i>
                            <span>Comment (8)</span>
                        </button>
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-share-square mr-1"></i>
                            <span>Share</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sample Post 2 -->
            <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center mb-3">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                        <div>
                            <div class="font-medium">Michael Chen</div>
                            <div class="text-xs text-gray-500">Yesterday at 7:30 PM</div>
                        </div>
                    </div>
                    <p class="mb-4">Looking for recommendations on good programming books for beginners. Any suggestions?</p>
                    <div class="flex justify-between text-gray-500 text-sm pt-2 border-t">
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-thumbs-up mr-1"></i>
                            <span>Like (15)</span>
                        </button>
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-comment mr-1"></i>
                            <span>Comment (12)</span>
                        </button>
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-share-square mr-1"></i>
                            <span>Share</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sample Post 3 -->
            <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center mb-3">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                        <div>
                            <div class="font-medium">Emily Garcia</div>
                            <div class="text-xs text-gray-500">3 days ago</div>
                        </div>
                    </div>
                    <p class="mb-4">Just adopted this little guy from the shelter! Meet Max! 🐶</p>

                    <!-- SVG Fake Photo (Dog) -->
                    <div class="w-full h-64 rounded-lg mb-3 overflow-hidden bg-gray-100">
                        <svg width="100%" height="100%" viewBox="0 0 600 400" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                            <!-- Background -->
                            <rect x="0" y="0" width="600" height="400" fill="#F5F5F5" />

                            <!-- Floor/Ground -->
                            <rect x="0" y="300" width="600" height="100" fill="#E0E0E0" />

                            <!-- Dog Body -->
                            <ellipse cx="300" cy="280" rx="100" ry="70" fill="#D2B48C" />

                            <!-- Head -->
                            <circle cx="390" cy="250" r="55" fill="#D2B48C" />

                            <!-- Ears -->
                            <ellipse cx="365" cy="200" rx="20" ry="30" fill="#BF9E7D" transform="rotate(-20 365 200)" />
                            <ellipse cx="415" cy="200" rx="20" ry="30" fill="#BF9E7D" transform="rotate(20 415 200)" />

                            <!-- Tail -->
                            <path d="M200,280 C180,250 160,260 150,240" stroke="#D2B48C" stroke-width="18" fill="none" stroke-linecap="round" />

                            <!-- Legs -->
                            <rect x="250" y="320" width="20" height="50" rx="10" fill="#BF9E7D" />
                            <rect x="330" y="320" width="20" height="50" rx="10" fill="#BF9E7D" />
                            <rect x="270" y="310" width="20" height="60" rx="10" fill="#BF9E7D" />
                            <rect x="310" y="310" width="20" height="60" rx="10" fill="#BF9E7D" />

                            <!-- Face -->
                            <ellipse cx="410" cy="260" rx="15" ry="10" fill="#8B4513" /> <!-- Nose -->
                            <circle cx="375" cy="235" r="8" fill="#000000" /> <!-- Left Eye -->
                            <circle cx="405" cy="235" r="8" fill="#000000" /> <!-- Right Eye -->
                            <path d="M390,270 C400,280 420,280 430,270" stroke="#8B4513" stroke-width="3" fill="none" /> <!-- Mouth -->

                            <!-- Collar -->
                            <path d="M350,260 C360,280 380,290 410,285" stroke="#FF6347" stroke-width="8" fill="none" />
                            <circle cx="380" cy="285" r="5" fill="#FFD700" /> <!-- Tag -->

                            <!-- Toys -->
                            <circle cx="200" cy="340" r="15" fill="#4682B4" /> <!-- Ball -->
                            <rect x="450" y="350" width="60" height="15" rx="5" fill="#8B4513" /> <!-- Bone -->
                            <rect x="450" y="350" width="60" height="15" rx="5" fill="#8B4513" transform="rotate(90 480 350)" />
                        </svg>
                    </div>

                    <div class="flex justify-between text-gray-500 text-sm pt-2 border-t">
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-thumbs-up mr-1"></i>
                            <span>Like (87)</span>
                        </button>
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-comment mr-1"></i>
                            <span>Comment (32)</span>
                        </button>
                        <button class="flex items-center hover:text-blue-500">
                            <i class="far fa-share-square mr-1"></i>
                            <span>Share</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="hidden lg:block w-1/5 fixed right-0 h-screen p-4 border-l border-gray-200 overflow-y-auto">
        <div class="mb-6">
            <h3 class="text-gray-500 font-medium mb-3">Sponsored</h3>
            <div class="bg-white p-3 rounded-lg shadow-sm mb-3">
                <!-- SVG Fake Photo (Headphones Advertisement) -->
                <div class="w-full h-32 rounded mb-2 overflow-hidden">
                    <svg width="100%" height="100%" viewBox="0 0 300 150" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background -->
                        <rect x="0" y="0" width="300" height="150" fill="#2C3E50" />

                        <!-- Headphones -->
                        <g transform="translate(150, 75)">
                            <!-- Left earpiece -->
                            <path d="M-60,0 L-40,0 A10,20 0 0 0 -40,-40 L-60,-40 A10,20 0 0 0 -60,0 Z" fill="#E74C3C" />
                            <ellipse cx="-50" cy="-20" rx="8" ry="15" fill="#C0392B" />

                            <!-- Right earpiece -->
                            <path d="M60,0 L40,0 A10,20 0 0 1 40,-40 L60,-40 A10,20 0 0 1 60,0 Z" fill="#E74C3C" />
                            <ellipse cx="50" cy="-20" rx="8" ry="15" fill="#C0392B" />

                            <!-- Headband -->
                            <path d="M-40,-35 Q0,-60 40,-35" stroke="#E74C3C" stroke-width="8" fill="none" />

                            <!-- Text -->
                            <text x="-90" y="50" font-family="Arial" font-size="14" font-weight="bold" fill="white">PREMIUM SOUND</text>
                            <text x="-65" y="70" font-family="Arial" font-size="12" fill="#ECF0F1">25% OFF TODAY!</text>
                        </g>
                    </svg>
                </div>
                <h4 class="font-medium text-sm">Premium Headphones - 25% off!</h4>
                <p class="text-xs text-gray-500">soundgear.com</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-gray-500 font-medium mb-3">Friend Requests</h3>
            <div class="bg-white p-3 rounded-lg shadow-sm mb-3">
                <div class="flex items-center mb-2">
                    <img src="/api/placeholder/40/40" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                    <div>
                        <div class="font-medium text-sm">Alex Thompson</div>
                        <div class="text-xs text-gray-500">2 mutual friends</div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm font-medium flex-grow">Accept</button>
                    <button class="bg-gray-200 text-gray-800 px-3 py-1 rounded-md text-sm font-medium flex-grow">Decline</button>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-gray-500 font-medium mb-3">Contacts</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <div class="relative">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">Jessica Miller</div>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">David Wilson</div>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">Sophia Lee</div>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <img src="/api/placeholder/40/40" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-gray-300 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">James Taylor</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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

        // Navigation item click handler
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                // For mobile: close the menu when a navigation item is clicked
                if (window.innerWidth < 1024) {
                    closeMobileMenu();
                }

                // You could add active state handling here
                navItems.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Tab navigation functionality
        const tabButtons = document.querySelectorAll('.flex.space-x-12 button');
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                tabButtons.forEach(btn => {
                    btn.classList.remove('active-tab');
                    btn.classList.add('text-gray-500');
                });
                this.classList.add('active-tab');
                this.classList.remove('text-gray-500');
            });
        });

        // Like, comment, share button interactions
        const actionButtons = document.querySelectorAll('.flex.justify-between.text-gray-500 button');
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Toggle active state
                this.classList.toggle('text-blue-500');

                // If this is a like button, you could increment/decrement the count
                if (this.querySelector('.fa-thumbs-up')) {
                    const likeText = this.querySelector('span');
                    const currentText = likeText.textContent;
                    const match = currentText.match(/Like \((\d+)\)/);

                    if (match) {
                        const currentCount = parseInt(match[1]);
                        const isLiked = this.classList.contains('text-blue-500');
                        const newCount = isLiked ? currentCount + 1 : currentCount - 1;
                        likeText.textContent = `Like (${newCount})`;
                    }
                }
            });
        });

        // Post input focus effect
        const postInput = document.querySelector('.post-input');
        postInput.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-300');
        });

        postInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-300');
        });

        // Window resize handler for mobile menu
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    });
</script>
