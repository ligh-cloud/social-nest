<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNest</title>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<!-- Navigation Bar -->
<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-blue-600 text-2xl font-bold">SocialNest</a>
            </div>

            <!-- Search Bar -->
            <div class="hidden md:flex items-center flex-1 max-w-md mx-4">
                <input type="text" placeholder="Search SocialNest"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-600 focus:outline-none">
            </div>

            <!-- Navigation Icons -->
            <div class="flex items-center space-x-4">
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </button>
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
                        <span class="text-sm font-medium">JD</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="container mx-auto pt-20 px-4 flex">
    <!-- Left Sidebar -->
    <aside class="hidden md:block w-1/4 fixed left-0 top-20 p-4 h-screen overflow-y-auto">
        <div class="space-y-2">
            <a href="#" class="flex items-center p-2 hover:bg-gray-100 rounded-lg">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center mr-2">
                    <span class="text-sm">JD</span>
                </div>
                <span class="text-gray-800">John Doe</span>
            </a>
            <a href="#" class="flex items-center p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="ml-2 text-gray-800">Friends</span>
            </a>
            <!-- Add more sidebar items as needed -->
        </div>
    </aside>

    <!-- Main Feed -->
    <div class="md:w-1/2 md:ml-[25%] md:mr-[25%]">
        <!-- Create Post -->
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
                    <span class="text-sm">JD</span>
                </div>
                <input type="text" placeholder="What's on your mind?"
                       class="flex-1 px-4 py-2 rounded-full border border-gray-300 focus:border-blue-600 focus:outline-none">
            </div>
            <div class="flex justify-between mt-4 pt-4 border-t">
                <button class="flex items-center text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg">
                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Photo/Video
                </button>
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Post</button>
            </div>
        </div>

        <!-- Sample Post -->
        <div class="bg-white rounded-lg shadow mb-4">
            <div class="p-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
                        <span class="text-sm">JD</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">John Doe</h4>
                        <p class="text-gray-500 text-sm">2 hours ago</p>
                    </div>
                </div>
                <p class="mt-4">This is a sample post on SocialNest! 🚀</p>
            </div>
            <div class="border-t px-4 py-2">
                <div class="flex space-x-4">
                    <button class="flex items-center text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                        </svg>
                        Like
                    </button>
                    <button class="flex items-center text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Comment
                    </button>
                    <button class="flex items-center text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        Share
                    </button>
                </div>
            </div>
        </div>

        <!-- Additional Sample Post -->
        <div class="bg-white rounded-lg shadow mb-4">
            <div class="p-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
                        <span class="text-sm">JS</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Jane Smith</h4>
                        <p class="text-gray-500 text-sm">1 hour ago</p>
                    </div>
                </div>
                <p class="mt-4">Had a great time at the park today! 🌳</p>
            </div>
            <div class="border-t px-4 py-2">
                <div class="flex space-x-4">
                    <button class="flex items-center text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                        </svg>
                        Like
                    </button>
                    <button class="flex items-center text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Comment
                    </button>
                    <button class="flex items-center text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        Share
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <aside class="hidden lg:block w-1/4 fixed right-0 top-20 p-4 h-screen overflow-y-auto">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-4">Contacts</h3>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center">
                        <span class="text-sm">JS</span>
                    </div>
                    <span>Jane Smith</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center">
                        <span class="text-sm">MB</span>
                    </div>
                    <span>Mike Brown</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-yellow-500 text-white flex items-center justify-center">
                        <span class="text-sm">CW</span>
                    </div>
                    <span>Chris Walker</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-purple-600 text-white flex items-center justify-center">
                        <span class="text-sm">AB</span>
                    </div>
                    <span>Alice Brown</span>
                </div>
                <!-- Add more contacts as needed -->
            </div>
        </div>
    </aside>
</main>

<script>
    // Add your JavaScript functionality here
    document.addEventListener('DOMContentLoaded', function() {
        // Handle post creation
        const postButton = document.querySelector('button:contains("Post")');
        const postInput = document.querySelector('input[placeholder="What\'s on your mind?"]');

        if (postButton && postInput) {
            postButton.addEventListener('click', function() {
                const postContent = postInput.value.trim();
                if (postContent) {
                    // Here you would typically send this to your backend
                    console.log('Creating post:', postContent);
                    postInput.value = '';
                }
            });
        }

        // Handle like button interactions
        document.querySelectorAll('button:contains("Like")').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('text-blue-600');
            });
        });
    });
</script>
</body>
</html>
```` ▋