<div class="space-y-8" wire:poll.5s>
    {{-- Voting Form --}}
    @if(!$hasVoted)
        <div class="glass-card rounded-2xl p-6 md:p-8 animate-fade-in-up">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-coral-500 to-amber-400 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-white font-[Syne]">Stimme abgeben</h2>
                </div>
            </div>
            <p class="text-slate-400 mb-8 ml-13">Alle passenden Optionen auswählen.</p>

            <form wire:submit="submitVote" class="space-y-8">
                {{-- Name Input --}}
                <div class="animate-fade-in-up delay-100">
                    <label for="name" class="block text-sm font-semibold text-slate-300 mb-3 uppercase tracking-wider">Dein Name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="expedition-input max-w-sm"
                        placeholder="Name eingeben"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-coral-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Trip Type Selection --}}
                <div class="animate-fade-in-up delay-200">
                    <label class="block text-sm font-semibold text-slate-300 mb-4 uppercase tracking-wider">Art der Reise</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($tripTypeOptions as $key => $label)
                            <label class="vote-option">
                                <input
                                    type="checkbox"
                                    wire:model="tripTypes"
                                    value="{{ $key }}"
                                >
                                <div class="option-card">{{ $label }}</div>
                            </label>
                        @endforeach
                    </div>
                    @error('tripTypes')
                        <p class="mt-2 text-sm text-coral-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Period Selection --}}
                <div class="animate-fade-in-up delay-300">
                    <label class="block text-sm font-semibold text-slate-300 mb-4 uppercase tracking-wider">Zeitraum</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($periodOptions as $key => $label)
                            <label class="vote-option">
                                <input
                                    type="checkbox"
                                    wire:model="periods"
                                    value="{{ $key }}"
                                >
                                <div class="option-card">{{ $label }}</div>
                            </label>
                        @endforeach
                    </div>
                    @error('periods')
                        <p class="mt-2 text-sm text-coral-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="pt-4 animate-fade-in-up delay-400">
                    <button type="submit" class="btn-primary">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Abstimmen
                        </span>
                    </button>
                </div>
            </form>
        </div>
    @else
        {{-- Vote Confirmation --}}
        <div class="glass-card rounded-2xl p-6 md:p-8 animate-fade-in-up border-l-4 border-coral-500">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-coral-500 to-amber-400 flex items-center justify-center animate-pulse-glow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white font-[Syne]">Danke, {{ $name }}!</h2>
                        <p class="text-slate-400 mt-1">Deine Stimme wurde gespeichert.</p>
                    </div>
                </div>
                <button
                    wire:click="editVote"
                    class="text-coral-400 hover:text-coral-300 text-sm font-medium hover:underline transition-colors"
                >
                    Bearbeiten
                </button>
            </div>
        </div>
    @endif

    {{-- Live Results --}}
    <div class="glass-card rounded-2xl p-6 md:p-8 animate-fade-in-up delay-200">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-white font-[Syne]">Ergebnisse</h2>
            </div>
        </div>
        <p class="text-slate-400 mb-8 ml-13">
            <span class="text-coral-400 font-semibold">{{ $results['total'] }}</span>
            {{ $results['total'] === 1 ? 'Stimme' : 'Stimmen' }} bisher
        </p>

        @if($results['total'] > 0)
            <div class="space-y-10">
                {{-- Trip Type Results --}}
                <div>
                    <h3 class="text-sm font-semibold text-slate-300 mb-5 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-4 h-4 text-coral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Art der Reise
                    </h3>
                    <div class="space-y-5">
                        @foreach($results['tripTypes'] as $key => $data)
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-slate-200 font-medium">{{ $data['label'] }}</span>
                                    <span class="text-slate-400">
                                        <span class="text-coral-400 font-semibold">{{ $data['count'] }}</span>
                                        <span class="text-slate-500">({{ $data['percentage'] }}%)</span>
                                    </span>
                                </div>
                                <div class="result-bar">
                                    <div
                                        class="result-bar-fill"
                                        style="width: {{ $data['percentage'] }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Period Results --}}
                <div>
                    <h3 class="text-sm font-semibold text-slate-300 mb-5 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Zeitraum
                    </h3>
                    <div class="space-y-5">
                        @foreach($results['periods'] as $key => $data)
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-slate-200 font-medium">{{ $data['label'] }}</span>
                                    <span class="text-slate-400">
                                        <span class="text-amber-400 font-semibold">{{ $data['count'] }}</span>
                                        <span class="text-slate-500">({{ $data['percentage'] }}%)</span>
                                    </span>
                                </div>
                                <div class="result-bar">
                                    <div
                                        class="result-bar-fill"
                                        style="width: {{ $data['percentage'] }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Individual Votes --}}
                <div>
                    <h3 class="text-sm font-semibold text-slate-300 mb-5 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Alle Stimmen
                    </h3>
                    <div class="overflow-x-auto -mx-6 md:-mx-8 px-6 md:px-8">
                        <table class="expedition-table">
                            <thead>
                                <tr>
                                    <th class="min-w-[120px]">Name</th>
                                    <th class="min-w-[160px]">Art der Reise</th>
                                    <th class="min-w-[180px]">Zeitraum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['votes'] as $vote)
                                    <tr>
                                        <td class="align-top">
                                            <button
                                                wire:click="loadVote({{ $vote->id }})"
                                                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                                                class="text-white font-medium hover:text-coral-400 transition-colors"
                                            >
                                                {{ $vote->name }}
                                            </button>
                                        </td>
                                        <td class="text-slate-400">
                                            {{ collect($vote->trip_types)->map(fn($t) => $tripTypeOptions[$t] ?? $t)->join(', ') }}
                                        </td>
                                        <td class="text-slate-400">
                                            {{ collect($vote->periods)->map(fn($p) => $periodOptions[$p] ?? $p)->join(', ') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-midnight-700 to-midnight-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <p class="text-slate-500">Noch keine Stimmen. Sei der Erste!</p>
            </div>
        @endif
    </div>
</div>
