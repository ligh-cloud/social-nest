@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <!-- Feed Content -->
    <div class="mt-4">
        <!-- Sample Post 1 -->
        <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="{{ asset('profile/profile.jpg') }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
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

        <!-- More posts would go here -->
        @foreach($posts ?? [] as $post)
            <!-- Dynamic posts from database -->
        @endforeach
    </div>
@endsection

@push('scripts')
    <!-- Add any page-specific scripts here -->
    <script>
        // Example of page-specific JavaScript
        console.log('Home page loaded');
    </script>
@endpush
