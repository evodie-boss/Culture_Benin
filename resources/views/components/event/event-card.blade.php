{{-- resources/views/components/event/event-card.blade.php --}}
<x-ui.card 
    image="{{ $event->image ?? 'https://placehold.co/600x400/e7e5e4/57534e?text=' . urlencode($event->titre) }}"
    {{ $attributes }}
>
    <div class="flex items-start justify-between mb-3">
        <div class="flex flex-wrap gap-2">
            {{-- Badge type d'événement --}}
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white
                {{ $event->type === 'fete' ? 'bg-orange-500' : 
                   ($event->type === 'festival' ? 'bg-purple-500' : 
                   ($event->type === 'concert' ? 'bg-pink-500' : 
                   ($event->type === 'exposition' ? 'bg-indigo-500' : 'bg-green-500'))) }}">
                {{ ucfirst($event->type) }}
            </span>

            {{-- Région si présente --}}
            @if($event->region)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-stone-100 text-stone-700">
                    {{ $event->region->nom_region }}
                </span>
            @endif
        </div>
    </div>

    <h3 class="text-xl font-bold text-stone-800 mb-2 line-clamp-2">
        {{ $event->titre }}
    </h3>

    <p class="text-stone-600 text-sm mb-4 line-clamp-2">
        {{ Str::limit(strip_tags($event->description), 100) }}
    </p>

    <div class="flex items-center justify-between text-sm">
        <div>
            <div class="font-semibold text-stone-800">{{ $event->date_formatee }}</div>
            <div class="text-stone-500">{{ $event->lieu }}</div>
        </div>
        <div class="text-right">
            <div class="text-lg font-bold text-taupe-600">
                {{ $event->prix_formate }}
            </div>
        </div>
    </div>
</x-ui.card>