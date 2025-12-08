{{-- resources/views/components/ui/card.blade.php --}}
<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-lg border border-green-100 overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2']) }}>
    {{-- Image en haut (optionnelle) --}}
    @if(isset($image))
        <div class="relative overflow-hidden">
            <img src="{{ $image }}" alt="{{ $imageAlt ?? '' }}"
                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
            
            {{-- Overlay gradient sur l'image --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            {{-- Badge --}}
            @if(isset($badge))
                <div class="absolute top-4 left-4">
                    {{ $badge }}
                </div>
            @endif
            
            {{-- Bouton d'action optionnel sur l'image --}}
            @if(isset($imageAction))
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    {{ $imageAction }}
                </div>
            @endif
        </div>
    @endif

    {{-- Contenu principal --}}
    <div class="p-6">
        {{ $slot }}
    </div>

    {{-- Footer optionnel --}}
    @if(isset($footer))
        <div class="px-6 py-4 bg-gradient-to-b from-transparent to-green-50/30 border-t border-green-100">
            {{ $footer }}
        </div>
    @endif

    {{-- Élément décoratif optionnel --}}
    @if(!isset($noDecoration))
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 via-teal-500 to-amber-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    @endif
</div>

{{-- 
    Exemples d'utilisation :
    
    1. Carte simple avec image :
    <x-ui.card image="url.jpg" imageAlt="Description">
        <h3 class="font-bold text-lg text-secondary-900 mb-2">Titre</h3>
        <p class="text-secondary-600 text-sm">Description</p>
    </x-ui.card>

    2. Carte avec badge :
    <x-ui.card image="url.jpg" imageAlt="Description">
        @slot('badge')
            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">Nouveau</span>
        @endslot
        <h3 class="font-bold text-lg text-secondary-900 mb-2">Titre</h3>
        <p class="text-secondary-600 text-sm">Description</p>
    </x-ui.card>

    3. Carte avec footer :
    <x-ui.card>
        <h3 class="font-bold text-lg text-secondary-900 mb-2">Titre</h3>
        <p class="text-secondary-600 text-sm mb-4">Description</p>
        @slot('footer')
            <a href="#" class="text-green-600 hover:text-green-700 font-medium text-sm">En savoir plus →</a>
        @endslot
    </x-ui.card>

    4. Carte avec action sur image :
    <x-ui.card image="url.jpg" imageAlt="Description">
        @slot('imageAction')
            <button class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white">
                <i class="fas fa-heart text-green-600"></i>
            </button>
        @endslot
        <h3 class="font-bold text-lg text-secondary-900 mb-2">Titre</h3>
        <p class="text-secondary-600 text-sm">Description</p>
    </x-ui.card>
--}}