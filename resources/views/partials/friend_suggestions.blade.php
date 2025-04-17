@if ($suggestedUsers->isEmpty())
    <div class="text-sm text-gray-500 p-4 text-center">No suggestions found.</div>
@else
    <div class="space-y-2">
        @foreach ($suggestedUsers as $user)
            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition relative">
                <div class="flex items-center space-x-3">
                    <img src="{{ $user->profile_picture
                            ? asset('storage/profile/'.$user->profile_picture)
                            : asset('images/default-profile.jpg') }}"
                         class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    <div>
                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ '@'.Str::before($user->email, '@') }}</div>
                    </div>
                </div>
                <button data-id="{{ $user->id }}"
                        class="send-request px-4 py-1.5 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-full transition disabled:opacity-50">
                    Add Friend
                </button>
            </div>
        @endforeach
    </div>
@endif
