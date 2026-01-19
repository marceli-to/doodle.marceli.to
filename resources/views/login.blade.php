<x-layouts.app>
    <div class="max-w-md mx-auto">
        <div class="text-center mb-10 animate-fade-in">
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-coral-500 to-amber-400 flex items-center justify-center animate-float">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 font-[Syne]">Willkommen</h2>
            <p class="text-slate-400">Gib das Passwort ein, um zur Reiseplanung zu gelangen.</p>
        </div>

        <div class="glass-card rounded-2xl p-6 md:p-8 animate-fade-in-up delay-200">
            <livewire:login-form />
        </div>
    </div>
</x-layouts.app>
