@extends('layouts.layout')

@section('title', 'Watch')

@section('content')
    <!-- Watch Page Content -->
    <div class="mt-4">
        <!-- Watch Header -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <h1 class="text-xl font-semibold mb-2 md:mb-0">Watch</h1>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search videos" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-100 text-sm">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>

            <div class="flex space-x-2 overflow-x-auto pb-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium whitespace-nowrap">For You</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Live</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Gaming</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Music</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Sports</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Cooking</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap">Travel</button>
            </div>
        </div>

        <!-- Featured Video -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Featured</h2>

            <div class="border rounded-lg overflow-hidden mb-3">
                <div class="relative">
                    <img src="{{ asset('storage/videos/featured-thumbnail.jpg') }}" alt="Featured Video" class="w-full h-64 md:h-96 object-cover">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 bg-black bg-opacity-50 rounded-full flex items-center justify-center">
                            <i class="fas fa-play text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                        24:15
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-start">
                        <img src="{{ asset('storage/profile/creator1.jpg') }}" alt="Creator" class="w-10 h-10 rounded-full mr-3">
                        <div class="flex-1">
                            <div class="font-medium text-lg">Ultimate Guide to National Parks 2025</div>
                            <div class="text-sm text-gray-600 mt-1">Travel with Alex</div>
                            <div class="text-xs text-gray-500 mt-1">142K views • 3 days ago</div>
                            <div class="text-sm text-gray-600 mt-2">Explore the most breathtaking national parks across the country with insider tips on best hiking trails, camping spots, and hidden gems.</div>
                        </div>
                    </div>
                    <div class="flex mt-4 space-x-3">
                        <button class="flex items-center text-gray-600 hover:text-gray-800">
                            <i class="far fa-thumbs-up mr-1"></i> 15K
                        </button>
                        <button class="flex items-center text-gray-600 hover:text-gray-800">
                            <i class="far fa-comment mr-1"></i> 873
                        </button>
                        <button class="flex items-center text-gray-600 hover:text-gray-800">
                            <i class="far fa-share-square mr-1"></i> Share
                        </button>
                        <button class="flex items-center text-gray-600 hover:text-gray-800 ml-auto">
                            <i class="far fa-bookmark mr-1"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Now Section -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg font-semibold">Live Now</h2>
                <a href="#" class="text-blue-500 text-sm hover:underline">See All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Live Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/live1.jpg') }}" alt="Live Stream" class="w-full h-40 object-cover">
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full flex items-center">
                            <span class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></span> LIVE
                        </div>
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            2.4K watching
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium truncate">Morning Yoga Routine for Beginners</div>
                        <div class="flex items-center mt-2">
                            <img src="{{ asset('storage/profile/creator2.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                            <div class="text-xs text-gray-500">Wellness with Jamie</div>
                        </div>
                    </div>
                </div>

                <!-- Live Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/live2.jpg') }}" alt="Live Stream" class="w-full h-40 object-cover">
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full flex items-center">
                            <span class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></span> LIVE
                        </div>
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            1.8K watching
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium truncate">Tech News Roundup - Latest Gadgets</div>
                        <div class="flex items-center mt-2">
                            <img src="{{ asset('storage/profile/creator3.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                            <div class="text-xs text-gray-500">TechTalk Daily</div>
                        </div>
                    </div>
                </div>

                <!-- Live Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/live3.jpg') }}" alt="Live Stream" class="w-full h-40 object-cover">
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full flex items-center">
                            <span class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></span> LIVE
                        </div>
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            5.7K watching
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium truncate">Championship Finals: Tigers vs Eagles</div>
                        <div class="flex items-center mt-2">
                            <img src="{{ asset('storage/profile/creator4.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                            <div class="text-xs text-gray-500">Sports Central</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Videos -->
        <div class="bg-white rounded-lg shadow-sm mb-4 p-4">
            <h2 class="text-lg font-semibold mb-3">Recommended for You</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/video1.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            12:34
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">How to Make the Perfect Sourdough Bread at Home</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/creator5.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Home Baking</div>
                            </div>
                            <div class="text-xs text-gray-500">254K views</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/video2.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            18:45
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">10 Productivity Hacks to Transform Your Workday</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/creator6.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Productivity Pro</div>
                            </div>
                            <div class="text-xs text-gray-500">186K views</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/video3.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            22:08
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">Beginner's Guide to Landscape Photography</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/creator7.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Photo Masters</div>
                            </div>
                            <div class="text-xs text-gray-500">329K views</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/video4.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            15:22
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">Full-Body Home Workout - No Equipment Needed</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/creator8.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">FitLife</div>
                            </div>
                            <div class="text-xs text-gray-500">1.2M views</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/video5.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            8:15
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">5 Easy Dinner Recipes Ready in Under 30 Minutes</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/creator9.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Quick Meals</div>
                            </div>
                            <div class="text-xs text-gray-500">876K views</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/video6.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            27:36
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">The History of Space Exploration: From Apollo to Mars</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/creator10.jpg') }}" alt="Creator" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Space Chronicles</div>
                            </div>
                            <div class="text-xs text-gray-500">435K views</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- From Channels You Follow -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-lg font-semibold">From Channels You Follow</h2>
                <a href="#" class="text-blue-500 text-sm hover:underline">See All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/channel1.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            19:48
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">I Tried Living Off-Grid for 30 Days - Here's What Happened</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/channel1.jpg') }}" alt="Channel" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Outdoor Adventures</div>
                            </div>
                            <div class="text-xs text-gray-500">New</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/channel2.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            14:27
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">How AI is Revolutionizing Healthcare in 2025</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/channel2.jpg') }}" alt="Channel" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Future Tech Today</div>
                            </div>
                            <div class="text-xs text-gray-500">3 hours ago</div>
                        </div>
                    </div>
                </div>

                <!-- Video Item -->
                <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/videos/channel3.jpg') }}" alt="Video Thumbnail" class="w-full h-40 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                            32:15
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium line-clamp-2 h-12">Behind the Scenes: Making of the Latest Blockbuster Movie</div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profile/channel3.jpg') }}" alt="Channel" class="w-6 h-6 rounded-full mr-2">
                                <div class="text-xs text-gray-500">Film Insider</div>
                            </div>
                            <div class="text-xs text-gray-500">Yesterday</div>
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
        // Watch page specific JavaScript
        console.log('Watch page loaded');

        // Example: Video player functionality
        document.addEventListener('DOMContentLoaded', function() {
            const videoThumbnails = document.querySelectorAll('.relative img');
            const playButtons = document.querySelectorAll('.fa-play');

            // Add event listeners for video playback
            // This is just placeholder functionality
        });
    </script>
@endpush
