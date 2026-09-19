<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @php $allFeedback = \App\Models\Feedback::with('user')->latest()->get(); @endphp

                @if ($allFeedback->isEmpty())
                    <p class="text-gray-500">No feedback submitted yet.</p>
                @else
                    @foreach ($allFeedback as $item)
                        @livewire('admin.feedback-reply', ['feedback' => $item], key('feedback-'.$item->id))
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>