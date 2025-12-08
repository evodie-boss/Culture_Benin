{{-- resources/views/components/language/language-card.blade.php --}}
<x-ui.card {{ $attributes->class(['group hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100 overflow-hidden']) }}>
    <div class="p-5">
        <!-- En-tête avec drapeau et nom -->
        <div class="flex items-start space-x-4 mb-4">
            <!-- Drapeau -->
            <div class="flex-shrink-0">
                @if($langue->drapeau ?? false)
                    @php
                        // Gestion des chemins d'images
                        $imagePath = $langue->drapeau;
                        $isLocalPath = Str::startsWith($imagePath, ['adminlte/img/', 'public/adminlte/img/', '/adminlte/img/']);
                        
                        if ($isLocalPath) {
                            $cleanPath = ltrim($imagePath, '/');
                            if (Str::startsWith($cleanPath, 'public/')) {
                                $cleanPath = Str::after($cleanPath, 'public/');
                            }
                            $imageUrl = asset($cleanPath);
                        } else {
                            $imageUrl = $imagePath;
                        }
                    @endphp
                    
                    <div class="w-16 h-16 rounded-xl overflow-hidden shadow-sm border border-gray-100">
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $langue->nom ?? 'Langue' }}" 
                             class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gray-100\'><i data-lucide=\'flag\' class=\'w-6 h-6 text-gray-400\'></i></div>'">
                    </div>
                @else
                    <div class="w-16 h-16 bg-gray-100 rounded-xl border border-gray-200 flex items-center justify-center">
                        <i data-lucide="languages" class="w-8 h-8 text-gray-400"></i>
                    </div>
                @endif
            </div>

            <!-- Nom et code -->
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600 transition-colors">
                    {{ $langue->nom ?? 'Langue sans nom' }}
                </h3>
                <div class="flex items-center mt-1 space-x-2">
                    @if($langue->code_langue ?? false)
                        <span class="text-sm text-gray-500 font-medium">
                            {{ $langue->code_langue }}
                        </span>
                    @endif
                    @if($langue->famille ?? false)
                        <span class="text-xs text-gray-400">
                            •
                        </span>
                        <span class="text-xs text-gray-600">
                            {{ Str::limit($langue->famille, 15) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistiques simples -->
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div class="text-center p-3 bg-gray-50 rounded-lg">
                <div class="text-lg font-bold text-gray-900">
                    {{ number_format($langue->nombre_locuteurs ?? 0) }}
                </div>
                <div class="text-xs text-gray-500 mt-1">Locuteurs</div>
            </div>
            
            <div class="text-center p-3 bg-gray-50 rounded-lg">
                <div class="text-lg font-bold text-gray-900">
                    {{ $langue->regions->count() ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 mt-1">Régions</div>
            </div>
        </div>

        <!-- Régions principales (seulement si existent) -->
        @if(($langue->regions ?? collect())->count() > 0)
            <div class="mb-4">
                <div class="flex items-center mb-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-gray-400 mr-2"></i>
                    <span class="text-sm text-gray-600">Régions principales</span>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach($langue->regions->take(2) as $region)
                        <span class="inline-block px-2.5 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">
                            {{ $region->nom ?? 'Région' }}
                        </span>
                    @endforeach
                    @if($langue->regions->count() > 2)
                        <span class="inline-block px-2.5 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                            +{{ $langue->regions->count() - 2 }}
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <!-- Bouton d'action -->
        <div class="pt-3 border-t border-gray-100">
            <a href="{{ url('/langues/' . ($langue->id ?? '')) }}" 
               class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-green-50 text-green-700 font-medium rounded-lg hover:bg-green-100 transition-colors duration-200 group/btn">
                <span>Voir les détails</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</x-ui.card>