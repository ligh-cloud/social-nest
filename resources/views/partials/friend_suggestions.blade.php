@if ($suggestedUsers->isEmpty())
    <div class="text-sm text-gray-500">No suggestions found.</div>
@else
    @foreach ($suggestedUsers as $user)
        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center">
                <img src="{{ asset('storage/profile/' . ($user->profile_picture ?? 'default.jpg')) }}" class="w-12 h-12 rounded-full mr-3">
                <div>
                    <div class="font-medium">{{ $user->name }}</div>
                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                </div>
            </div>
            <button data-id="{{ $user->id }}" class="send-request px-3 py-1 text-sm bg-blue-500 text-white rounded">Add Friend</button>
        </div>
    @endforeach
@endif
