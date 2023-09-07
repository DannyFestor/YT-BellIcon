<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Notification extends Component
{
    public array $publicNotifications = [];
    public array $privateNotifications = [];

    public function render()
    {
        $this->publicNotifications = \App\Models\Notification::query()
            ->whereNull('user_id')
            ->whereNull('seen_at')
            ->get()->toArray();

        $this->privateNotifications = \App\Models\Notification::query()
            ->where('user_id', 1)
            ->whereNull('seen_at')
            ->get()->toArray();

        return view('livewire.notification');
    }

    public function markRead(string $attribute): void
    {
        \App\Models\Notification::query()
            ->whereIn('id', $this->$attribute)
            ->update([
                'seen_at' => now(),
            ]);
    }

    #[Computed]
    public function publicNotificationCount(): int
    {
        return count($this->publicNotifications);
    }

    #[Computed]
    public function privateNotificationCount(): int
    {
        return count($this->privateNotifications);
    }

    #[Computed]
    public function publicNotificationIds(): array
    {
        return array_map(fn($item) => $item['id'], $this->publicNotifications);
    }

    #[Computed]
    public function privateNotificationIds(): array
    {
        return array_map(fn($item) => $item['id'], $this->privateNotifications);
    }
}
