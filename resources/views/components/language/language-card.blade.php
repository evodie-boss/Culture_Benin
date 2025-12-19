{{-- resources/views/components/language/language-card.blade.php --}}
<a href="{{ route('langues.show', $langue) }}" 
   class="group block focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-2xl transition-all duration-300 hover:scale-[1.02]">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-green-100 hover:shadow-2xl hover:border-green-300 transition-all duration-300 h-full flex flex-col">
        {{-- Image/Illustration de la langue --}}
        <div class="relative h-48 overflow-hidden">
            @php
                // CHARGEMENT PAR NOM DE LA LANGUE
                // Crée un slug à partir du nom de la langue
                $nomFichier = strtolower(str_replace([' ', "'", '"', 'é', 'è', 'ê', 'ë', 'à', 'â', 'î', 'ï', 'ô', 'û', 'ù'], 
                                                     ['-', '', '', 'e', 'e', 'e', 'e', 'a', 'a', 'i', 'i', 'o', 'u', 'u'], 
                                                     $langue->nom_langue));
                
                // Liste des extensions possibles
                $extensions = ['.jpg', '.jpeg', '.png', '.webp'];
                
                // Cherche l'image par nom
                $imageTrouvee = false;
                $imagePath = '';
                
                foreach ($extensions as $extension) {
                    $cheminTest = 'adminlte/img/langues/' . $nomFichier . $extension;
                    if (file_exists(public_path($cheminTest))) {
                        $imagePath = $cheminTest;
                        $imageTrouvee = true;
                        break;
                    }
                }
                
                // Si pas trouvée, essaie avec code langue
                if (!$imageTrouvee && $langue->code_langue) {
                    $codeFichier = strtolower($langue->code_langue);
                    foreach ($extensions as $extension) {
                        $cheminTest = 'adminlte/img/langues/' . $codeFichier . $extension;
                        if (file_exists(public_path($cheminTest))) {
                            $imagePath = $cheminTest;
                            $imageTrouvee = true;
                            break;
                        }
                    }
                }
                
                // Si pas trouvée, essaie avec ID
                if (!$imageTrouvee) {
                    foreach ($extensions as $extension) {
                        $cheminTest = 'adminlte/img/langues/' . $langue->id . $extension;
                        if (file_exists(public_path($cheminTest))) {
                            $imagePath = $cheminTest;
                            $imageTrouvee = true;
                            break;
                        }
                    }
                }
                
                // Si toujours pas trouvée, utilise une image par défaut
                if (!$imageTrouvee) {
                    $imagePath = 'adminlte/img/default/langue.jpg';
                }
                
                $imageUrl = asset($imagePath);
            @endphp
            
            <img src="{{ $imageUrl }}" 
                 alt="{{ $langue->nom_langue }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.onerror=null; this.src='https://placehold.co/600x400/0d9488/ffffff?text='+encodeURIComponent('{{ $langue->nom_langue }}');">
            
            {{-- Overlay gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            
            {{-- Badge type de langue --}}
            <div class="absolute top-4 left-4">
                @php
                    $typeColor = match($langue->type ?? '') {
                        'nationale' => 'bg-green-500',
                        'regionale' => 'bg-teal-500',
                        'locale' => 'bg-amber-500',
                        default => 'bg-green-500'
                    };
                    $typeText = match($langue->type ?? '') {
                        'nationale' => 'Nationale',
                        'regionale' => 'Régionale',
                        'locale' => 'Locale',
                        default => 'Langue'
                    };
                @endphp
                <span class="{{ $typeColor }} text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                    {{ $typeText }}
                </span>
            </div>
            
            {{-- Code langue si disponible --}}
            @if($langue->code_langue)
                <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1.5">
                    <span class="text-sm font-bold text-secondary-900">
                        {{ $langue->code_langue }}
                    </span>
                </div>
            @endif
        </div>
        
        {{-- Contenu textuel --}}
        <div class="p-6 flex-1 flex flex-col">
            {{-- Nom de la langue --}}
            <h3 class="text-xl font-bold text-secondary-900 mb-2 group-hover:text-green-700 transition-colors">
                {{ $langue->nom_langue }}
            </h3>
            
            {{-- Famille linguistique --}}
            @if($langue->famille_linguistique)
                <div class="flex items-center text-sm text-teal-600 mb-3">
                    <i class="fas fa-sitemap mr-2 text-xs"></i>
                    <span>{{ $langue->famille_linguistique }}</span>
                </div>
            @endif
            
            {{-- Description courte --}}
            @if($langue->description)
                <p class="text-secondary-600 text-sm mb-4 line-clamp-2 flex-1">
                    {{ Str::limit(strip_tags($langue->description), 100) }}
                </p>
            @endif
            
            {{-- Statistiques --}}
            <div class="grid grid-cols-3 gap-3 mb-4">
                <div class="text-center p-2 bg-green-50 rounded-lg">
                    <div class="text-lg font-bold text-green-600">
                        @if($langue->nombre_locuteurs)
                            @if($langue->nombre_locuteurs >= 1000000)
                                {{ number_format($langue->nombre_locuteurs / 1000000, 1) }}M
                            @elseif($langue->nombre_locuteurs >= 1000)
                                {{ number_format($langue->nombre_locuteurs / 1000, 1) }}K
                            @else
                                {{ $langue->nombre_locuteurs }}
                            @endif
                        @else
                            —
                        @endif
                    </div>
                    <div class="text-xs text-green-700 mt-1">Locuteurs</div>
                </div>
                
                <div class="text-center p-2 bg-teal-50 rounded-lg">
                    <div class="text-lg font-bold text-teal-600">
                        {{ $langue->regions->count() ?? 0 }}
                    </div>
                    <div class="text-xs text-teal-700 mt-1">Régions</div>
                </div>
                
                <div class="text-center p-2 bg-amber-50 rounded-lg">
                    <div class="text-lg font-bold text-amber-600">
                        {{ $langue->contenus_count ?? '0' }}
                    </div>
                    <div class="text-xs text-amber-700 mt-1">Contenus</div>
                </div>
            </div>
            
            {{-- Régions principales --}}
            @if($langue->regions && $langue->regions->count() > 0)
                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-green-600 mr-2 text-sm"></i>
                        <span class="text-sm font-medium text-secondary-900">Parlée dans</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($langue->regions->take(3) as $region)
                            <span class="inline-block px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-full hover:bg-green-200 transition-colors">
                                {{ $region->nom_region }}
                            </span>
                        @endforeach
                        @if($langue->regions->count() > 3)
                            <span class="inline-block px-3 py-1.5 bg-secondary-100 text-secondary-700 text-xs font-medium rounded-full">
                                +{{ $langue->regions->count() - 3 }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
            
            {{-- Métadonnées --}}
            <div class="flex items-center justify-between text-sm text-secondary-500 pt-4 border-t border-secondary-100 mt-auto">
                @if($langue->statut_officiel)
                    <span class="inline-flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-award mr-1.5 text-xs"></i>
                        {{ $langue->statut_officiel }}
                    </span>
                @endif
                
                {{-- Bouton action (secondaire) --}}
                <span class="inline-flex items-center text-green-600 font-medium text-sm group-hover:text-green-700">
                    Explorer
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </div>
        
        {{-- Effet de surbrillance au survol --}}
        <div class="absolute inset-0 border-2 border-transparent group-hover:border-green-400 rounded-2xl transition-all duration-300 pointer-events-none"></div>
    </div>
</a>