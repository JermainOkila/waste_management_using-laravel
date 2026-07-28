<div>
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="save">
        <div class="mb-4">
            <x-input-label for="pickup_address" value="Pickup Address" />
            <x-text-input
                id="pickup_address"
                type="text"
                class="mt-1 block w-full"
                wire:model="pickup_address"
            />
            <x-input-error :messages="$errors->get('pickup_address')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="notes" value="Notes (optional)" />
            <textarea
                id="notes"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                wire:model="notes"
            ></textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
        </div>

        <x-primary-button type="submit">
            Request Pickup
        </x-primary-button>
    </form>
</div>