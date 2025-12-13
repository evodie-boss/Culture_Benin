{{-- resources/views/components/region/region-card.blade.php --}}
<a href="{{ route('regions.show', $region) }}" 
   class="group block focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-2xl transition-all duration-300 hover:scale-[1.02]">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-green-100 hover:shadow-2xl hover:border-green-300 transition-all duration-300 h-full flex flex-col">
        {{-- Image de la région --}}
        <div class="relative h-48 overflow-hidden">
            @if($region->image || $region->photo)
                @php
                    // Gestion des chemins d'images
                    $imagePath = $region->image ?? $region->photo;
                    
                    if (Str::startsWith($imagePath, ['adminlte/img/', 'public/adminlte/img/', '/adminlte/img/'])) {
                        $cleanPath = ltrim($imagePath, '/');
                        if (Str::startsWith($cleanPath, 'public/')) {
                            $cleanPath = Str::after($cleanPath, 'public/');
                        }
                        $imageUrl = asset($cleanPath);
                    } elseif (Str::startsWith($imagePath, 'storage/')) {
                        $imageUrl = asset($imagePath);
                    } elseif (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                        $imageUrl = $imagePath;
                    } else {
                        $imageUrl = 'https://placehold.co/600x400/8b7355/ffffff?text=' . urlencode(substr($region->nom_region, 0, 15));
                    }
                @endphp
                
                <img src="{{ $imageUrl }}" 
                     alt="{{ $region->nom_region }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center\'><i class=\'fas fa-map text-white text-4xl\'></i></div>'">
            @else
                <div class="w-full h-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                    <i class="fas fa-map text-white text-4xl"></i>
                </div>
            @endif
            
            {{-- Overlay gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            
            {{-- Nom de la région en surimpression --}}
            <div class="absolute bottom-4 left-4 right-4">
                <h3 class="text-xl font-bold text-white drop-shadow-lg">
                    {{ $region->nom_region ?? $region->nom }}
                </h3>
                @if($region->capitale)
                    <p class="text-sm text-white/90 mt-1 drop-shadow">
                        <i class="fas fa-city mr-1.5"></i>
                        {{ $region->capitale }}
                    </p>
                @endif
            </div>
            
            {{-- Badge patrimoine UNESCO --}}
            @if($region->patrimoine_unesco)
                <div class="absolute top-4 left-4">
                    <span class="bg-gradient-to-r from-amber-500 to-orange-500 text-white px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg">
                        <i class="fas fa-landmark text-xs"></i>
                        UNESCO
                    </span>
                </div>
            @endif
            
            {{-- Badge nombre de langues --}}
            @if($region->langues && $region->langues->count() > 0)
                <div class="absolute top-4 right-4">
                    <span class="bg-white/90 backdrop-blur-sm text-secondary-900 px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                        <i class="fas fa-language mr-1.5"></i>
                        {{ $region->langues->count() }} {{ Str::plural('langue', $region->langues->count()) }}
                    </span>
                </div>
            @endif
        </div>
        
        {{-- Contenu textuel --}}
        <div class="p-6 flex-1 flex flex-col">
            {{-- Localisation --}}
            @if($region->localisation)
                <div class="flex items-center text-sm text-teal-600 mb-3">
                    <i class="fas fa-map-marker-alt mr-2 text-xs"></i>
                    <span>{{ $region->localisation }}</span>
                </div>
            @endif
            
            {{-- Description courte --}}
            @if($region->description)
                <p class="text-secondary-600 text-sm mb-4 line-clamp-2 flex-1">
                    {{ Str::limit(strip_tags($region->description), 100) }}
                </p>
            @endif
            
            {{-- Statistiques --}}
            <div class="grid grid-cols-3 gap-3 mb-4">
                @if($region->population)
                    <div class="text-center p-2 bg-green-50 rounded-lg">
                        <div class="text-lg font-bold text-green-600">
                            @if($region->population >= 1000000)
                                {{ number_format($region->population / 1000000, 1) }}M
                            @elseif($region->population >= 1000)
                                {{ number_format($region->population / 1000, 1) }}K
                            @else
                                {{ number_format($region->population) }}
                            @endif
                        </div>
                        <div class="text-xs text-green-700 mt-1">Habitants</div>
                    </div>
                @else
                    <div class="text-center p-2 bg-green-50 rounded-lg">
                        <div class="text-lg font-bold text-green-600">—</div>
                        <div class="text-xs text-green-700 mt-1">Population</div>
                    </div>
                @endif
                
                @if($region->superficie)
                    <div class="text-center p-2 bg-teal-50 rounded-lg">
                        <div class="text-lg font-bold text-teal-600">
                            {{ number_format($region->superficie) }}
                        </div>
                        <div class="text-xs text-teal-700 mt-1">km²</div>
                    </div>
                @else
                    <div class="text-center p-2 bg-teal-50 rounded-lg">
                        <div class="text-lg font-bold text-teal-600">—</div>
                        <div class="text-xs text-teal-700 mt-1">Superficie</div>
                    </div>
                @endif
                
                <div class="text-center p-2 bg-amber-50 rounded-lg">
                    <div class="text-lg font-bold text-amber-600">
                        {{ $region->contenus_count ?? '0' }}
                    </div>
                    <div class="text-xs text-amber-700 mt-1">Contenus</div>
                </div>
            </div>
            
            {{-- Langues principales --}}
            @if($region->langues && $region->langues->count() > 0)
                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-language text-green-600 mr-2 text-sm"></i>
                        <span class="text-sm font-medium text-secondary-900">Langues parlées</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($region->langues->take(3) as $langue)
                            <span class="inline-block px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-full hover:bg-green-200 transition-colors">
                                {{ $langue->nom_langue }}
                            </span>
                        @endforeach
                        @if($region->langues->count() > 3)
                            <span class="inline-block px-3 py-1.5 bg-secondary-100 text-secondary-700 text-xs font-medium rounded-full">
                                +{{ $region->langues->count() - 3 }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
            
            {{-- Fête principale --}}
            @if($region->fete_principale)
                <div class="mb-4 p-3 bg-purple-50 rounded-lg border border-purple-100">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt text-purple-600 mr-3"></i>
                        <div>
                            <div class="text-sm font-medium text-secondary-900">Fête traditionnelle</div>
                            <div class="text-sm text-purple-700">{{ $region->fete_principale }}</div>
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- Métadonnées --}}
            <div class="flex items-center justify-between text-sm text-secondary-500 pt-4 border-t border-secondary-100 mt-auto">
                {{-- Patrimoine culturel --}}
                @if($region->patrimoine_culturel)
                    <span class="inline-flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-landmark mr-1.5 text-xs"></i>
                        Patrimoine
                    </span>
                @endif
                
                {{-- Bouton action (secondaire) --}}
                <span class="inline-flex items-center text-green-600 font-medium text-sm group-hover:text-green-700">
                    Explorer la région
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </div>
        
        {{-- Effet de surbrillance au survol --}}
        <div class="absolute inset-0 border-2 border-transparent group-hover:border-green-400 rounded-2xl transition-all duration-300 pointer-events-none"></div>
    </div>
</a>