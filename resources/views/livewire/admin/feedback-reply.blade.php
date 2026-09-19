<div class="border-b pb-4 mb-4">
    <div class="flex justify-between items-center">
        <span class="font-semibold">{{ $feedback->user->name }}</span>
        <span class="text-xs px-2 py-1 rounded {{ $feedback->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
            {{ $feedback->status }}
        </span>
    </div>
    <p class="text-sm text-gray-500 capitalize">{{ $feedback->type }}</p>
    <p class="text-gray-700 mt-1">{{ $feedback->message }}</p>

    <form wire:submit="reply" class="mt-3">
        <textarea wire:model="adminReply" rows="2"
                  class="block w-full border-gray-300 rounded-md shadow-sm text-sm"
                  placeholder="Write a reply..."></textarea>
        @error('adminReply')
            <span class="text-red-600 text-xs">{{ $message }}</span>
        @enderror
        <button type="submit" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
            Send Reply
        </button>
    </form>

    @if (session('success'))
        <p class="text-green-600 text-sm mt-2">{{ session('success') }}</p>
    @endif
</div>