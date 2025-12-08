{{-- resources/views/components/region/region-card.blade.php --}}
<x-ui.card 
    image="{{ $region->image ?? 'https://placehold.co/600x400/e7e5e4/57534e?text=' . urlencode($region->nom) }}"
    imageAlt="{{ $region->nom }}"
    {{ $attributes }}
>
    <div class="flex items-start justify-between mb-3">
        <h3 class="text-2xl font-bold text-stone-800">
            {{ $region->nom }}
        </h3>
        @if($region->capitale)
            <span class="text-sm text-stone-500 font-medium">
                {{ $region->capitale }}
            </span>
        @endif
    </div>

    <div class="space-y-2 text-sm text-stone-600 mb-4">
        @if($region->population)
            <p><strong>Population :</strong> {{ number_format($region->population) }} hab.</p>
        @endif
        @if($region->superficie)
            <p><strong>Superficie :</strong> {{ number_format($region->superficie) }} km²</p>
        @endif
        <p><strong>Langues principales :</strong>
            {{ $region->langues->count() > 0 
                ? $region->langues->take(3)->pluck('nom')->implode(', ') . ($region->langues->count() > 3 ? '…' : '')
                : 'Diverses' }}
        </p>
    </div>

    <div class="flex items-center justify-between">
        <div class="flex space-x-2">
            @if($region->patrimoine_unesco)
                <x-ui.badge class="bg-taupe-600">UNESCO</x-ui.badge>
            @endif
            @if($region->fete_principale)
                <x-ui.badge class="bg-green-600">Fête traditionnelle</x-ui.badge>
            @endif
        </div>

        <a href="/regions/{{ $region->id }}" class="inline-flex items-center text-taupe-600 font-semibold hover:text-taupe-700 transition">
            Explorer
            <i data-lucide="arrow-right" class="w-5 h-5 ml-1"></i>
        </a>
    </div>
</x-ui.card>