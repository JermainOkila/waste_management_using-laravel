<?php

namespace App\Livewire\Admin;

use App\Models\Feedback;
use Livewire\Component;

class FeedbackReply extends Component
{
    public Feedback $feedback;

    public string $adminReply = '';

    public function mount()
    {
        $this->adminReply = $this->feedback->admin_reply ?? '';
    }

    public function reply()
    {
        $this->validate([
            'adminReply' => 'required|string|max:1000',
        ]);

        $this->feedback->update([
            'admin_reply' => $this->adminReply,
            'status' => 'resolved',
        ]);

        session()->flash('success', 'Reply sent.');
    }

    public function render()
    {
        return view('livewire.admin.feedback-reply');
    }
}