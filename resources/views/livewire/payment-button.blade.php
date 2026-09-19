<div>
    <button
        wire:click="pay"
        wire:loading.attr="disabled"
        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 disabled:opacity-50"
    >
        <span wire:loading.remove wire:target="pay">Pay with M-Pesa</span>
        <span wire:loading wire:target="pay">Processing...</span>
    </button>
</div>