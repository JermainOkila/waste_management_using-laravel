<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;

class FeedbackForm extends Component
{
    public string $type = 'feedback';
    public string $message = '';

    protected function rules()
    {
        return [
            'type' => 'required|in:complaint,feedback,suggestion',
            'message' => 'required|string|max:1000',
        ];
    }

    public function submit()
    {
        $validated = $this->validate();

        auth()->user()->feedbacks()->create([
            'type' => $validated['type'],
            'message' => $validated['message'],
            'status' => 'open',
        ]);

        $this->reset(['type', 'message']);
        $this->type = 'feedback';

        session()->flash('success', 'Feedback submitted.');
    }

    public function getMyFeedbackProperty()
    {
        return auth()->user()->feedbacks()->latest()->get();
    }

    public function render()
    {
        return view('livewire.feedback-form');
    }
}