<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="relative p-2 text-gray-500 hover:text-gray-700">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if ($this->unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                {{ $this->unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" x-cloak
         class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 max-h-96 overflow-y-auto">
        <div class="p-2">
            @forelse ($this->notifications as $notification)
                <div wire:click="markAsRead('{{ $notification->id }}')"
                     class="p-3 text-sm border-b cursor-pointer hover:bg-gray-50 {{ $notification->read_at ? 'text-gray-400' : 'text-gray-800 font-medium' }}">
                    {{ $notification->data['message'] }}
                </div>
            @empty
                <div class="p-3 text-sm text-gray-500">No notifications yet.</div>
            @endforelse
        </div>
    </div>
</div>