{{-- resources/views/components/content/content-card.blade.php --}}
<x-ui.card 
    image="{{ $contenu->medias->where('type', 'image')->first()->url ?? 'https://placehold.co/600x400/e7e5e4/78716c?text=' . urlencode($contenu->titre) }}"
    imageAlt="{{ $contenu->titre }}"
    badge="<x-ui.badge>{{ $contenu->type_contenu ?? 'Culture' }}</x-ui.badge>"
    {{ $attributes }}
>
    <div class="text-xs font-semibold text-stone-600 uppercase mb-1">
        {{ $contenu->region?->nom ?? 'Bénin' }}
    </div>
    <h3 class="text-xl font-bold text-stone-900 mb-2 group-hover:text-stone-700 transition-colors line-clamp-2">
        {{ $contenu->titre }}
    </h3>
    <p class="text-stone-600 text-sm mb-4 line-clamp-3">
        {{ Str::limit(strip_tags($contenu->contenu), 120) }}
    </p>
    <div class="flex justify-between items-center text-sm text-stone-500">
        <span class="flex items-center space-x-1">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>{{ $contenu->created_at->format('d M Y') }}</span>
        </span>
        <span class="font-semibold text-stone-700">
            {{ $contenu->langue?->nom ?? 'Français' }}
        </span>
    </div>
</x-ui.card>