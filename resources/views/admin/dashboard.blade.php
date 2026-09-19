<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Active Pickup Requests</h3>

                @if ($requests->isEmpty())
                    <p class="text-gray-500">No active pickup requests right now.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Resident</th>
                                <th class="py-2">Address</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Truck</th>
                                <th class="py-2">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr class="border-b">
                                    <td class="py-2">{{ $request->user->name }}</td>
                                    <td class="py-2">{{ $request->pickup_address }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                            {{ $request->status }}
                                        </span>
                                    </td>
                               <td class="py-2">
    @if ($request->status === 'paid')
        @livewire('dispatch-button', ['pickupRequest' => $request], key('dispatch-'.$request->id))
    @elseif (in_array($request->status, ['dispatched', 'in_transit']))
        <div class="flex items-center gap-2">
            <span>{{ $request->truck->plate_number ?? 'Unassigned' }}</span>
            @livewire('mark-picked-up-button', ['pickupRequest' => $request], key('pickup-'.$request->id))
        </div>
    @else
        {{ $request->truck->plate_number ?? 'Unassigned' }}
                            @endif
                                    </td>
                                    
                                    <td class="py-2">KES {{ number_format($request->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>