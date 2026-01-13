<div>
    <form wire:submit="login" class="space-y-6">
        <div>
            <label for="password" class="block text-sm font-medium text-stone-700 mb-2">Password</label>
            <input
                type="password"
                id="password"
                wire:model="password"
                class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-colors"
                placeholder="Enter password"
                autofocus
            >
            @if($error)
                <p class="mt-2 text-sm text-red-600">{{ $error }}</p>
            @endif
        </div>

        <button
            type="submit"
            class="w-full bg-terracotta-600 hover:bg-terracotta-700 text-white font-medium py-3 px-6 rounded-lg transition-colors"
        >
            Enter
        </button>
    </form>
</div>
