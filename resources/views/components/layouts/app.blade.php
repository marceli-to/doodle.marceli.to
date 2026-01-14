<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-stone-50 min-h-screen antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="">
            <div class="max-w-4xl mx-auto px-6 py-6 text-center">
                <h1 class="text-2xl md:text-4xl font-semibold text-terracotta-800 tracking-tight font-serif">Horde 2026</h1>
            </div>
        </header>

        <main class="flex-1 py-6 md:py-12">
            <div class="max-w-4xl mx-auto px-4 md:px-6">
                {{ $slot }}
            </div>
        </main>

        <footer>
          <div class="flex items-center justify-center font-mono py-3 text-[.65rem] text-stone-400">
            <span>made with <span class="text-red-500">❤️</span> by <a href="https://claude.ai" target="_blank" class="hover:text-terracotta-800 hover:underline">claude</a></span>
          </div>
        </footer>

    </div>
    @livewireScripts
</body>
</html>
