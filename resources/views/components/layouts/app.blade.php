<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Syne:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-midnight-950 min-h-screen antialiased text-slate-200 overflow-x-hidden">
    {{-- Atmospheric Background --}}
    <div class="fixed inset-0 sunset-gradient opacity-90"></div>

    {{-- Decorative Elements --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        {{-- Sun glow --}}
        <div class="sun-decoration animate-float" style="bottom: 5%; right: 10%;"></div>
        <div class="sun-decoration animate-float delay-200" style="bottom: -5%; left: 20%; width: 200px; height: 200px;"></div>

        {{-- Geometric sun rays --}}
        <svg class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] opacity-20 animate-sun-rays" viewBox="0 0 800 400" fill="none">
            <defs>
                <linearGradient id="rayGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#ffd93d;stop-opacity:0.6" />
                    <stop offset="100%" style="stop-color:#ff6b6b;stop-opacity:0" />
                </linearGradient>
            </defs>
            @for($i = 0; $i < 12; $i++)
                <line
                    x1="400" y1="400"
                    x2="{{ 400 + 350 * cos(deg2rad($i * 15 - 82.5)) }}"
                    y2="{{ 400 + 350 * sin(deg2rad($i * 15 - 82.5)) }}"
                    stroke="url(#rayGradient)"
                    stroke-width="2"
                />
            @endfor
        </svg>

        {{-- Mountain silhouettes --}}
        <svg class="absolute bottom-0 left-0 w-full h-48 md:h-64" viewBox="0 0 1440 256" preserveAspectRatio="none" fill="none">
            <path d="M0 256L120 220L240 180L360 200L480 140L600 180L720 120L840 160L960 100L1080 140L1200 80L1320 120L1440 60V256H0Z" fill="rgba(10,11,26,0.7)"/>
            <path d="M0 256L180 200L360 240L540 180L720 220L900 160L1080 200L1260 140L1440 180V256H0Z" fill="rgba(10,11,26,0.9)"/>
        </svg>

        {{-- Stars --}}
        <div class="absolute inset-0">
            @for($i = 0; $i < 30; $i++)
                <div
                    class="absolute w-1 h-1 bg-white rounded-full animate-pulse"
                    style="
                        top: {{ rand(5, 40) }}%;
                        left: {{ rand(5, 95) }}%;
                        opacity: {{ rand(20, 60) / 100 }};
                        animation-delay: {{ rand(0, 3000) }}ms;
                    "
                ></div>
            @endfor
        </div>
    </div>

    {{-- Content --}}
    <div class="relative min-h-screen flex flex-col z-10">
        <header class="animate-fade-in">
            <div class="max-w-4xl mx-auto px-6 pt-8 pb-4 md:pt-12 md:pb-6 text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight font-[Syne]">
                    <span class="gradient-text">Horde</span>
                    <span class="text-white"> 2026</span>
                </h1>
                <p class="mt-3 text-slate-400 text-sm md:text-base tracking-wide uppercase">Expedition Planer</p>
            </div>
        </header>

        <main class="flex-1 py-6 md:py-10">
            <div class="max-w-4xl mx-auto px-4 md:px-6">
                {{ $slot }}
            </div>
        </main>

        <footer class="relative z-10">
            <div class="flex items-center justify-center font-mono py-6 text-xs text-slate-500">
                <span>made with <span class="text-coral-500">&#9829;</span> by <a href="https://claude.ai" target="_blank" class="hover:text-coral-400 transition-colors">claude</a></span>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>
</html>
