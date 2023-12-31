<x-app-layout>
    <main class="flex flex-col gap-4">
        <h1 class="p-2 text-2xl font-bold">Bell Notification</h1>
        <a href="{{ route('polling.js.index') }}" class="p-2 hover:bg-black hover:bg-opacity-10">Polling (Javascript)</a>
        <a href="{{ route('polling.alpine.index') }}" class="p-2 hover:bg-black hover:bg-opacity-10">Polling (Alpine)</a>
        <a href="{{ route('polling.livewire') }}" class="p-2 hover:bg-black hover:bg-opacity-10">Polling (Livewire)</a>
        <a href="{{ route('sse.alpine.index') }}" class="p-2 hover:bg-black hover:bg-opacity-10">Server Sent Events</a>
        <a href="{{ route('ws.alpine.index') }}" class="p-2 hover:bg-black hover:bg-opacity-10">Websockets (Soketi)</a>
    </main>
</x-app-layout>
