@if(count($friendRequests) > 0)
    @foreach($friendRequests as $request)
        <div class="flex items-start md:items-center flex-col md:flex-row justify-between py-3 border-b">
            <div class="flex items-center mb-2 md:mb-0">
                <img src="{{ asset('storage/' . ($request->sender->profile_photo_path ?? 'profile/default.jpg')) }}"
                     class="w-12 h-12 rounded-full mr-3" alt="User">
                <div>
                    <div class="font-medium">{{ $request->sender->name }}</div>
                    <div class="text-xs text-gray-500">Friend Request</div>
                </div>
            </div>
            <div class="flex space-x-2 w-full md:w-auto">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium accept-request"
                        data-id="{{ $request->id }}">Accept</button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium decline-request"
                        data-id="{{ $request->id }}">Decline</button>
            </div>
        </div>
    @endforeach
@else
    <div class="text-sm text-gray-500">No new friend requests</div>
@endif
