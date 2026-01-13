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
        <header class="border-b border-stone-200">
            <div class="max-w-4xl mx-auto px-6 py-6 text-center">
                <h1 class="text-3xl font-semibold text-terracotta-800 tracking-tight font-serif">Horde 2026</h1>
            </div>
        </header>

        <main class="flex-1 py-12">
            <div class="max-w-4xl mx-auto px-6">
                {{ $slot }}
            </div>
        </main>

        <footer class="border-t border-stone-200 bg-white">
            <div class="max-w-4xl mx-auto px-6 py-6 text-center">
                <p class="text-sm text-stone-500 font-serif">Let's plan something great together.</p>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>
</html>
