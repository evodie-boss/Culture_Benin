{{-- resources/views/components/content/content-card.blade.php --}}
<a href="{{ route('contenus.show', $contenu) }}" 
   class="group block focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-2xl transition-all duration-300 hover:scale-[1.02]">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-green-100 hover:shadow-2xl hover:border-green-300 transition-all duration-300 h-full flex flex-col">
        {{-- Image avec overlay et badge --}}
        <div class="relative h-48 overflow-hidden">
            @if($contenu->medias->count() > 0)
                @php
                    $imageMedia = $contenu->medias->where('typeMedia.nom_media', 'image')->first();
                    $imageUrl = $imageMedia ? asset('storage/' . $imageMedia->chemin) : 
                        'https://placehold.co/600x400/8b7355/ffffff?text=' . urlencode(substr($contenu->titre, 0, 20));
                @endphp
                <img src="{{ $imageUrl }}" 
                     alt="{{ $contenu->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                    <i class="fas fa-book-open text-white text-4xl"></i>
                </div>
            @endif
            
            {{-- Overlay gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            
            {{-- Badge type de contenu --}}
            <div class="absolute top-4 left-4">
                @php
                    $typeColor = match($contenu->typeContenu->nom_contenu ?? '') {
                        'Histoire' => 'bg-green-500',
                        'Musique' => 'bg-teal-500',
                        'Danse' => 'bg-purple-500',
                        'Art' => 'bg-amber-500',
                        'Cuisine' => 'bg-red-500',
                        'Cérémonie' => 'bg-indigo-500',
                        default => 'bg-green-500'
                    };
                    $typeIcon = match($contenu->typeContenu->nom_contenu ?? '') {
                        'Histoire' => 'fas fa-book-open',
                        'Musique' => 'fas fa-music',
                        'Danse' => 'fas fa-user-friends',
                        'Art' => 'fas fa-palette',
                        'Cuisine' => 'fas fa-utensils',
                        'Cérémonie' => 'fas fa-mask',
                        default => 'fas fa-file-alt'
                    };
                @endphp
                <span class="{{ $typeColor }} text-white px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg">
                    <i class="{{ $typeIcon }} text-xs"></i>
                    {{ $contenu->typeContenu->nom_contenu ?? 'Contenu' }}
                </span>
            </div>
            
            {{-- Badge premium si applicable --}}
            @if($contenu->est_premium && $contenu->type_acces === 'payant')
                <div class="absolute top-4 right-4">
                    <span class="bg-gradient-to-r from-amber-500 to-orange-500 text-white px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg animate-pulse">
                        <i class="fas fa-crown text-xs"></i>
                        Premium
                    </span>
                </div>
            @endif
            
            {{-- Badge statut --}}
            @if($contenu->statut !== 'validé')
                <div class="absolute bottom-4 left-4">
                    <span class="bg-gray-500 text-white px-3 py-1.5 rounded-full text-xs font-bold">
                        {{ ucfirst($contenu->statut) }}
                    </span>
                </div>
            @endif
        </div>
        
        {{-- Contenu textuel --}}
        <div class="p-6 flex-1 flex flex-col">
            {{-- Région et langue --}}
            <div class="flex items-center justify-between mb-3">
                @if($contenu->region)
                    <span class="inline-flex items-center text-green-600 text-sm font-medium">
                        <i class="fas fa-map-marker-alt mr-1.5 text-xs"></i>
                        {{ $contenu->region->nom_region }}
                    </span>
                @endif
                
                @if($contenu->langue)
                    <span class="inline-flex items-center text-teal-600 text-sm font-medium">
                        <i class="fas fa-language mr-1.5 text-xs"></i>
                        {{ $contenu->langue->nom_langue }}
                    </span>
                @endif
            </div>
            
            {{-- Titre --}}
            <h3 class="text-xl font-bold text-secondary-900 mb-3 group-hover:text-green-700 transition-colors line-clamp-2 leading-tight">
                {{ $contenu->titre }}
            </h3>
            
            {{-- Description/Extrait --}}
            <p class="text-secondary-600 text-sm mb-4 line-clamp-3 flex-1">
                @if($contenu->est_premium && $contenu->type_acces === 'payant')
                    {{ $contenu->apercu ?? Str::limit(strip_tags($contenu->texte), 120) }}
                @else
                    {{ Str::limit(strip_tags($contenu->texte), 120) }}
                @endif
            </p>
            
            {{-- Métadonnées --}}
            <div class="flex items-center justify-between text-sm text-secondary-500 pt-4 border-t border-secondary-100">
                <div class="flex items-center space-x-4">
                    {{-- Auteur --}}
                    @if($contenu->auteur)
                        <span class="flex items-center">
                            <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">
                                {{ strtoupper(substr($contenu->auteur->name, 0, 1)) }}
                            </div>
                            <span class="truncate max-w-24">{{ $contenu->auteur->name }}</span>
                        </span>
                    @endif
                    
                    {{-- Date --}}
                    <span class="flex items-center">
                        <i class="far fa-calendar-alt mr-1.5"></i>
                        {{ $contenu->date_creation->format('d/m/Y') }}
                    </span>
                </div>
                
                {{-- Interactions --}}
                <div class="flex items-center space-x-3">
                    {{-- Commentaires --}}
                    @if($contenu->commentaires_count > 0)
                        <span class="flex items-center">
                            <i class="far fa-comment mr-1"></i>
                            {{ $contenu->commentaires_count }}
                        </span>
                    @endif
                    
                    {{-- Prix si premium --}}
                    @if($contenu->est_premium && $contenu->prix > 0)
                        <span class="font-bold text-amber-600">
                            {{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }}
                        </span>
                    @endif
                </div>
            </div>
            
            {{-- Indicateur de lecture --}}
            <div class="mt-4">
                <div class="w-full bg-green-100 rounded-full h-1.5">
                    <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ min(100, (str_word_count(strip_tags($contenu->texte)) / 10)) }}%"></div>
                </div>
                <div class="text-xs text-secondary-500 mt-1 text-right">
                    {{ ceil(str_word_count(strip_tags($contenu->texte)) / 200) }} min de lecture
                </div>
            </div>
        </div>
        
        {{-- Effet de surbrillance au survol --}}
        <div class="absolute inset-0 border-2 border-transparent group-hover:border-green-400 rounded-2xl transition-all duration-300 pointer-events-none"></div>
    </div>
</a>
