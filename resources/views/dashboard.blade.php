<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg">{{ session('error') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (!$activeRequest)
    {{-- STATE 1: No active request --}}
    <h3 class="text-lg font-bold mb-4">Request a Pickup</h3>
    @livewire('pickup-request-form')
    @elseif ($activeRequest->status === 'pending_payment')
    {{-- STATE 2: Awaiting payment --}}
    <h3 class="text-lg font-bold mb-2">Complete Payment</h3>
    <p class="text-gray-600 mb-4">Pay KES {{ $activeRequest->amount }} to send your request to the admin.</p>
    @livewire('payment-button', ['pickupRequest' => $activeRequest])
    <form method="POST" action="{{ route('pickup.cancel', $activeRequest) }}" class="inline">
        @csrf
        <button class="ml-2 text-red-600 underline">Cancel Request</button>
    </form>


                @elseif ($activeRequest->status === 'paid')
                    {{-- STATE 3: Waiting for admin dispatch --}}
                    <h3 class="text-lg font-bold mb-2">Request Received</h3>
                    <p class="text-gray-600">Payment confirmed. Waiting for the admin to dispatch a truck to {{ $activeRequest->pickup_address }}.</p>

                @elseif (in_array($activeRequest->status, ['dispatched', 'in_transit']))
                    {{-- STATE 4: Live tracking placeholder --}}
                    <h3 class="text-lg font-bold mb-2">Truck On The Way 🚛</h3>
                    <p class="text-gray-600">A truck has been dispatched to {{ $activeRequest->pickup_address }}.</p>
                    <div class="mt-4 bg-gray-100 h-64 flex items-center justify-center rounded-lg text-gray-500">
                        [Live map will go here]
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>