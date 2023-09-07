<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="antialiased h-screen w-screen grid place-items-center">
        <main class="flex flex-col gap-4">
            <h1 class="p-2 text-2xl font-bold">Bell Notification</h1>
            <a class="p-2 hover:bg-black hover:bg-opacity-10">Polling (Javascript)</a>
            <a class="p-2 hover:bg-black hover:bg-opacity-10">Polling (Livewire)</a>
            <a class="p-2 hover:bg-black hover:bg-opacity-10">Server Sent Events</a>
            <a class="p-2 hover:bg-black hover:bg-opacity-10">Websockets (Soketi)</a>
        </main>
    </body>
</html>
