<div class="space-y-6">
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4">Submit Feedback</h3>

        <form wire:submit="submit" class="space-y-4">
            <div>
                <x-input-label for="type" value="Type" />
                <select id="type" wire:model="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="feedback">Feedback</option>
                    <option value="complaint">Complaint</option>
                    <option value="suggestion">Suggestion</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="message" value="Message" />
                <textarea id="message" wire:model="message" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>

            <x-primary-button type="submit">Submit</x-primary-button>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4">Your Feedback History</h3>

        @if ($this->myFeedback->isEmpty())
            <p class="text-gray-500">You haven't submitted any feedback yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($this->myFeedback as $item)
                    <div class="border-b pb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold capitalize">{{ $item->type }}</span>
                            <span class="text-xs px-2 py-1 rounded {{ $item->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $item->status }}
                            </span>
                        </div>
                        <p class="text-gray-700 mt-1">{{ $item->message }}</p>
                        @if ($item->admin_reply)
                            <div class="mt-2 bg-gray-50 p-3 rounded text-sm">
                                <span class="font-semibold">Admin reply:</span> {{ $item->admin_reply }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
