<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <script src="./node_modules/preline/dist/preline.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        <title>{{ $title ?? 'Blog' }}</title>
        @livewireStyles
    </head>
    <body>
        @livewire('partials.navigation')
        <main>
            {{ $slot }} 
        </main>

        @livewire('partials.footer')
    </body>
</html>
