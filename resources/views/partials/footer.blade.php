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
                <img src="{{ asset('profile/profile.jpg') }}" alt="User Profile" class="w-10 h-10 rounded-full mr-2">
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
            @foreach($contacts ?? [] as $contact)
                <div class="flex items-center">
                    <div class="relative">
                        <img src="{{ $contact->profile_image ?? asset('profile/profile.jpg') }}" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-{{ $contact->online ? 'green' : 'gray' }}-500 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">{{ $contact->name }}</div>
                </div>
            @endforeach

            {{-- Fallback data if no contacts are provided --}}
            @if(empty($contacts))
                <div class="flex items-center">
                    <div class="relative">
                        <img src="{{ asset('profile/profile.jpg') }}" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">Jessica Miller</div>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <img src="{{ asset('profile/profile.jpg') }}" alt="User Profile" class="w-9 h-9 rounded-full mr-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full absolute bottom-0 right-2 border-2 border-white"></div>
                    </div>
                    <div class="font-medium text-sm">David Wilson</div>
                </div>
            @endif
        </div>
    </div>
</div>
