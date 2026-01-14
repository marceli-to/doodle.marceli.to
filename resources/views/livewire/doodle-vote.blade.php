<div class="space-y-12" wire:poll.5s>
    {{-- Voting Form --}}
    @if(!$hasVoted)
        <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
            <h2 class="text-2xl font-semibold text-stone-900 mb-2 font-serif">Stimme abgeben</h2>
            <p class="text-stone-600 mb-8">Alle passenden Optionen auswählen.</p>

            <form wire:submit="submitVote" class="space-y-8">
                {{-- Name Input --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-2">Dein Name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="w-full max-w-sm px-4 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-colors"
                        placeholder="Name eingeben"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Trip Type Selection --}}
                <div>
                    <label class="block text-base font-medium text-stone-700 mb-4 font-serif">Art der Reise</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($tripTypeOptions as $key => $label)
                            <label class="relative cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:model="tripTypes"
                                    value="{{ $key }}"
                                    class="peer sr-only"
                                >
                                <div class="px-5 py-3 rounded-lg border-2 border-stone-200 bg-white peer-checked:border-terracotta-500 peer-checked:bg-terracotta-50 transition-all hover:border-stone-300">
                                    <span class="text-stone-700 peer-checked:text-terracotta-700 font-medium">{{ $label }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('tripTypes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Period Selection --}}
                <div>
                    <label class="block text-base font-medium text-stone-700 mb-4 font-serif">Zeitraum</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($periodOptions as $key => $label)
                            <label class="relative cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:model="periods"
                                    value="{{ $key }}"
                                    class="peer sr-only"
                                >
                                <div class="px-5 py-3 rounded-lg border-2 border-stone-200 bg-white peer-checked:border-terracotta-500 peer-checked:bg-terracotta-50 transition-all hover:border-stone-300">
                                    <span class="text-stone-700 peer-checked:text-terracotta-700 font-medium">{{ $label }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('periods')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button
                        type="submit"
                        class="bg-terracotta-600 hover:bg-terracotta-700 text-white font-medium py-3 px-8 rounded-lg transition-colors"
                    >
                        Abstimmen
                    </button>
                </div>
            </form>
        </div>
    @else
        {{-- Vote Confirmation --}}
        <div class="bg-terracotta-50 border border-terracotta-200 rounded-2xl p-6 md:p-8">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-terracotta-900 mb-2 font-serif">Danke, {{ $name }}!</h2>
                    <p class="text-terracotta-700">Deine Stimme wurde gespeichert.</p>
                </div>
                <button
                    wire:click="editVote"
                    class="text-terracotta-600 hover:text-terracotta-800 text-sm font-medium underline"
                >
                    Bearbeiten
                </button>
            </div>
        </div>
    @endif

    {{-- Live Results --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <h2 class="text-2xl font-semibold text-stone-900 mb-2 font-serif">Ergebnisse</h2>
        <p class="text-stone-600 mb-8">{{ $results['total'] }} {{ $results['total'] === 1 ? 'Stimme' : 'Stimmen' }} bisher</p>

        @if($results['total'] > 0)
            <div class="space-y-10">
                {{-- Trip Type Results --}}
                <div>
                    <h3 class="text-lg font-medium text-stone-800 mb-4 font-serif">Art der Reise</h3>
                    <div class="space-y-5">
                        @foreach($results['tripTypes'] as $key => $data)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-stone-700">{{ $data['label'] }}</span>
                                    <span class="text-stone-500">{{ $data['count'] }} ({{ $data['percentage'] }}%)</span>
                                </div>
                                <div class="h-3 bg-stone-100 rounded-full overflow-hidden">
                                    <div
                                        class="h-full bg-terracotta-500 rounded-full transition-all duration-500"
                                        style="width: {{ $data['percentage'] }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Period Results --}}
                <div>
                    <h3 class="text-lg font-medium text-stone-800 mb-4 font-serif">Zeitraum</h3>
                    <div class="space-y-5">
                        @foreach($results['periods'] as $key => $data)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-stone-700">{{ $data['label'] }}</span>
                                    <span class="text-stone-500">{{ $data['count'] }} ({{ $data['percentage'] }}%)</span>
                                </div>
                                <div class="h-3 bg-stone-100 rounded-full overflow-hidden">
                                    <div
                                        class="h-full bg-terracotta-500 rounded-full transition-all duration-500"
                                        style="width: {{ $data['percentage'] }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Individual Votes --}}
                <div>
                    <h3 class="text-lg font-medium text-stone-800 mb-4 font-serif">Alle Stimmen</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-xs md:text-sm">
                            <thead>
                                <tr class="border-b border-stone-200">
                                    <th class="text-left py-3 pr-3 md:pr-5 font-medium text-stone-600 font-serif">Name</th>
                                    <th class="text-left py-3 pr-3 md:pr-5 font-medium text-stone-600 font-serif">Art der Reise</th>
                                    <th class="text-left py-3 font-medium text-stone-600 font-serif">Zeitraum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['votes'] as $vote)
                                    <tr class="border-b border-stone-100">
                                        <td class="py-3 pr-3 md:pr-5 align-top">
                                            <button
                                                wire:click="loadVote({{ $vote->id }})"
                                                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                                                class="text-stone-900 font-medium hover:text-terracotta-600 hover:underline transition-colors"
                                            >
                                                {{ $vote->name }}
                                            </button>
                                        </td>
                                        <td class="py-3 pr-3 md:pr-5 text-stone-600">
                                            {{ collect($vote->trip_types)->map(fn($t) => $tripTypeOptions[$t] ?? $t)->join(', ') }}
                                        </td>
                                        <td class="py-3 text-stone-600">
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
            <p class="text-stone-500 italic">Noch keine Stimmen. Sei der Erste!</p>
        @endif
    </div>
</div>
