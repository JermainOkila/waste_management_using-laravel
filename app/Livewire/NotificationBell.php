<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public function getNotificationsProperty()
    {
        return auth()->user()->notifications()->latest()->take(10)->get();
    }

    public function getUnreadCountProperty()
    {
        return auth()->user()->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        auth()->user()->notifications()->where('id', $notificationId)->first()?->markAsRead();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
