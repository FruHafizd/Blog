<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Pastikan baris ini ada -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    
    <title>{{ $title ?? 'Blog' }}</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('vendor/mckenziearts/laravel-notify/css/notify.css') }}">
</head>
<body>
    @livewire('partials.navigation')
    <main>
        {{ $slot }} 
    </main>
    
    @livewire('partials.footer')
    
    @livewireScripts
    
    <x-notify::notify />
    @notifyJs
</body>
</html>
