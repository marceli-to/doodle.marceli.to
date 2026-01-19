<div>
    <form wire:submit="login" class="space-y-6">
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-300 mb-3 uppercase tracking-wider">Passwort</label>
            <input
                type="password"
                id="password"
                wire:model="password"
                class="expedition-input"
                placeholder="Passwort eingeben"
                autofocus
            >
            @if($error)
                <p class="mt-3 text-sm text-coral-400 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $error }}
                </p>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full">
            <span class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Weiter
            </span>
        </button>
    </form>
</div>
