@extends('layouts.layout')

@section('title', 'Saved Items')

@section('content')
    <!-- Saved Items Page Content -->
    <div class="mt-4">
        <!-- Saved Items Header -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <h1 class="text-xl font-semibold mb-2 md:mb-0">Saved Items</h1>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search saved items" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>

            <div class="flex space-x-2 overflow-x-auto pb-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium whitespace-nowrap">All Items</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Posts</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Photos</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Videos</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Articles</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Links</button>
            </div>
        </div>

        <!-- Create Collection Section -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold">Your Collections</h2>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium">
                    <i class="fas fa-plus mr-1"></i> Create New
                </button>
            </div>

            <!-- Collections List -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
                <!-- Collection Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-500 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-bookmark text-white text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium">Travel Ideas</div>
                        <div class="text-xs text-gray-500 mt-1">12 items • Last updated 2 days ago</div>
                    </div>
                </div>

                <!-- Collection Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-32 bg-gradient-to-r from-green-400 to-teal-500 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-utensils text-white text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium">Recipes to Try</div>
                        <div class="text-xs text-gray-500 mt-1">8 items • Last updated 1 week ago</div>
                    </div>
                </div>

                <!-- Collection Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-32 bg-gradient-to-r from-yellow-400 to-orange-500 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-book text-white text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium">Reading List</div>
                        <div class="text-xs text-gray-500 mt-1">15 items • Last updated 3 days ago</div>
                    </div>
                </div>
            </div>

            <!-- View All Collections Link -->
            <div class="text-center mt-3">
                <a href="#" class="text-blue-500 text-sm hover:underline">View all collections</a>
            </div>
        </div>

        <!-- Recently Saved Items -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Recently Saved</h2>

            <div class="space-y-4">
                <!-- Saved Post Item -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('storage/profile/user3.jpg') }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
                            <div>
                                <div class="font-medium">Jason Williams</div>
                                <div class="text-xs text-gray-500">March 15, 2025</div>
                            </div>
                        </div>
                        <p class="text-sm mb-3">Just finished this amazing hike at Mount Rainier! The views were absolutely breathtaking. Definitely recommend for anyone visiting Washington.</p>
                        <img src="{{ asset('storage/posts/mountain-hike.jpg') }}" alt="Mountain Hike" class="w-full h-64 object-cover rounded-lg mb-3">
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-3 text-sm text-gray-500">
                                <span><i class="far fa-heart mr-1"></i> 132</span>
                                <span><i class="far fa-comment mr-1"></i> 28</span>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-folder-plus mr-1"></i> Add to collection
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-bookmark text-blue-500"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saved Article Item -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <img src="{{ asset('storage/articles/tech-article.jpg') }}" alt="Article Thumbnail" class="w-24 h-24 object-cover rounded-lg mr-3">
                            <div class="flex-1">
                                <div class="font-medium text-lg mb-1">10 Tech Trends to Watch in 2025</div>
                                <div class="text-sm text-gray-600 mb-2 line-clamp-2">AI, quantum computing, and sustainable tech are reshaping our digital landscape. Here's what you need to know about the most important developments.</div>
                                <div class="text-xs text-gray-500 mb-2">techinsider.com • 10 min read</div>
                                <div class="flex justify-between items-center">
                                    <div class="text-xs text-gray-500">Saved 1 day ago</div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-folder-plus mr-1"></i> Add to collection
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-bookmark text-blue-500"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saved Video Item -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="p-4">
                        <div class="mb-3 font-medium">How to Make Perfect Sourdough Bread</div>
                        <div class="relative">
                            <img src="{{ asset('storage/videos/sourdough-thumbnail.jpg') }}" alt="Video Thumbnail" class="w-full h-56 object-cover rounded-lg">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 bg-black bg-opacity-50 rounded-full flex items-center justify-center">
                                    <i class="fas fa-play text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                18:24
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-3">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/chef-channel.jpg') }}" alt="Channel" class="w-8 h-8 rounded-full mr-2">
                                <div class="text-sm">Baking with Sarah</div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-folder-plus mr-1"></i> Add to collection
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-bookmark text-blue-500"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- From Friends -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h2 class="text-lg font-semibold mb-3">From Friends</h2>

            <div class="space-y-4">
                <!-- Saved Link -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-2">
                            Shared by <span class="font-medium">Sarah Johnson</span> • 2 days ago
                        </div>
                        <div class="flex items-start">
                            <div class="flex-1">
                                <div class="font-medium mb-1">The Ultimate Guide to Urban Gardening</div>
                                <div class="text-sm text-gray-600 mb-2">Transform your apartment balcony into a thriving garden oasis with these space-saving techniques.</div>
                                <div class="text-xs text-gray-500">urbangardener.com</div>
                            </div>
                            <img src="{{ asset('storage/links/garden-thumbnail.jpg') }}" alt="Link Thumbnail" class="w-20 h-20 object-cover rounded ml-3">
                        </div>
                        <div class="flex justify-end mt-2">
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-folder-plus mr-1"></i> Add to collection
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-bookmark text-blue-500"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saved Event -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-2">
                            Shared by <span class="font-medium">David Chen</span> • 3 days ago
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-red-100 text-red-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-day text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium mb-1">Downtown Arts Festival</div>
                                <div class="text-sm text-gray-600 mb-1">March 22-24, 2025 • Downtown Arts District</div>
                                <div class="text-xs text-gray-500">250 people interested • 120 going</div>
                                <div class="mt-2">
                                    <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm font-medium mr-2">
                                        Interested
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-2">
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-folder-plus mr-1"></i> Add to collection
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-bookmark text-blue-500"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-6">
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                    Load More
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Saved items page specific JavaScript
        console.log('Saved items page loaded');

        // Example: Collection management
        document.addEventListener('DOMContentLoaded', function() {
            const createCollectionBtn = document.querySelector('button:contains("Create New")');
            const addToCollectionBtns = document.querySelectorAll('button:contains("Add to collection")');

            // Add event listeners for collection actions
            // This is just placeholder functionality
        });
    </script>
@endpush
