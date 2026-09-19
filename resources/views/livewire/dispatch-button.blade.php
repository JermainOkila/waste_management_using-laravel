<div class="flex items-center gap-2">
    <select wire:model="selectedTruckId" class="border-gray-300 rounded-md text-sm">
        <option value="">Select truck...</option>
        @foreach ($this->availableTrucks as $truck)
            <option value="{{ $truck->id }}">{{ $truck->plate_number }} ({{ $truck->driver_name }})</option>
        @endforeach
    </select>

    <button
        wire:click="assignTruck"
        wire:loading.attr="disabled"
        class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 disabled:opacity-50"
    >
        Dispatch
    </button>

    @error('selectedTruckId')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>