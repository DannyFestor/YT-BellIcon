<main wire:poll.5s class="flex gap-16">
    <div>
        <div wire:click="markRead('publicNotificationIds')" class="relative w-6 h-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
            </svg>
            @if($this->publicNotificationCount())
                <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-600 text-white flex justify-center items-center">
                    {{ $this->publicNotificationCount() }}
                </div>
            @endif
        </div>
        <ol class="list-decimal">
            @foreach($publicNotifications as $notification)
                <li>{{ $notification['title'] }}</li>
            @endforeach
        </ol>
    </div>

    <div>
        <div wire:click="markRead('privateNotificationIds')" class="relative w-6 h-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
            </svg>
            @if($this->privateNotificationCount())
                <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-600 text-white flex justify-center items-center">
                    {{ $this->privateNotificationCount() }}
                </div>
            @endif
        </div>
        <ol class="list-decimal">
            @foreach($privateNotifications as $notification)
                <li>{{ $notification['title'] }}</li>
            @endforeach
        </ol>
    </div>
</main>

