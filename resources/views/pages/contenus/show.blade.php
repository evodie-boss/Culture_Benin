@extends('layouts.guest')
@section('title', $contenu->titre)

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond --}}
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-800/80"></div>
            
            @if($contenu->medias->count() > 0)
                <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ $contenu->medias->first()->chemin }}')"></div>
            @endif
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <div class="flex items-center space-x-2 text-sm mb-6 animate-fade-in">
                    <a href="{{ route('contenus.index') }}" class="text-green-300 hover:text-white transition-colors">
                        <i class="fas fa-book-open mr-1"></i> Contenus
                    </a>
                    <span class="text-green-400">/</span>
                    @if($contenu->typeContenu)
                    <a href="{{ route('contenus.index') }}?type={{ urlencode($contenu->typeContenu->nom_contenu) }}" 
                       class="text-green-300 hover:text-white transition-colors">
                        {{ $contenu->typeContenu->nom_contenu }}
                    </a>
                    <span class="text-green-400">/</span>
                    @endif
                    <span class="text-white/80">{{ Str::limit($contenu->titre, 40) }}</span>
                </div>
                
                {{-- Badge type de contenu + Badge premium si applicable --}}
                <div class="flex flex-wrap items-center gap-4 mb-6 animate-fade-in">
                    <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                        @php
                            $contentTypeIcon = match($contenu->typeContenu->nom_contenu ?? '') {
                                'Histoire' => 'fas fa-book-open',
                                'Musique' => 'fas fa-music',
                                'Danse' => 'fas fa-user-friends',
                                'Art' => 'fas fa-palette',
                                'Cuisine' => 'fas fa-utensils',
                                'Cérémonie' => 'fas fa-mask',
                                'Langue' => 'fas fa-language',
                                default => 'fas fa-file-alt'
                            };
                        @endphp
                        <i class="{{ $contentTypeIcon }} text-green-300"></i>
                        <span class="text-sm font-medium">{{ $contenu->typeContenu->nom_contenu ?? 'Contenu culturel' }}</span>
                    </div>
                    
                    {{-- BADGE PREMIUM AJOUTÉ ICI --}}
                    @if($contenu->est_premium && $contenu->type_acces === 'payant')
                        <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500/90 to-orange-500/90 backdrop-blur-sm rounded-full px-4 py-2 animate-pulse">
                            <i class="fas fa-crown text-white"></i>
                            <span class="text-sm font-medium text-white">Contenu Premium</span>
                        </div>
                    @elseif($contenu->type_acces === 'gratuit')
                        <div class="inline-flex items-center space-x-2 bg-green-500/90 backdrop-blur-sm rounded-full px-4 py-2">
                            <i class="fas fa-unlock text-white"></i>
                            <span class="text-sm font-medium text-white">Accès Gratuit</span>
                        </div>
                    @endif
                </div>
                
                {{-- Titre principal --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    {{ $contenu->titre }}
                </h1>
                
                {{-- Métadonnées --}}
                <div class="flex flex-wrap items-center gap-4 mb-8 animate-fade-in delay-100">
                    <div class="flex items-center text-white/90">
                        <i class="far fa-calendar text-green-300 mr-3"></i>
                        <span>{{ $contenu->date_creation->translatedFormat('d F Y') }}</span>
                    </div>
                    
                    @if($contenu->region)
                    <div class="flex items-center text-white/90">
                        <i class="fas fa-map-marker-alt text-green-300 mr-3"></i>
                        <a href="{{ route('regions.show', $contenu->region) }}" class="hover:text-white transition-colors">
                            {{ $contenu->region->nom_region }}
                        </a>
                    </div>
                    @endif
                    
                    @if($contenu->langue)
                    <div class="flex items-center text-white/90">
                        <i class="fas fa-language text-green-300 mr-3"></i>
                        <a href="{{ route('langues.show', $contenu->langue) }}" class="hover:text-white transition-colors">
                            {{ $contenu->langue->nom_langue }}
                        </a>
                    </div>
                    @endif
                    
                    @if($contenu->auteur)
                    <div class="flex items-center text-white/90">
                        <i class="fas fa-user-edit text-green-300 mr-3"></i>
                        <span>{{ $contenu->auteur->name }}</span>
                    </div>
                    @endif
                    
                    {{-- PRIX AJOUTÉ ICI --}}
                    @if($contenu->est_premium && $contenu->prix > 0)
                        <div class="flex items-center text-white/90">
                            <i class="fas fa-tag text-green-300 mr-3"></i>
                            <span class="font-bold">{{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }}</span>
                        </div>
                    @endif
                </div>
                
                {{-- Description courte --}}
                <p class="text-xl text-white/90 mb-8 leading-relaxed max-w-3xl animate-fade-in delay-200">
                    {{ $contenu->est_premium && $contenu->type_acces === 'payant' ? ($contenu->apercu ?? Str::limit(strip_tags($contenu->texte), 200)) : Str::limit(strip_tags($contenu->texte), 200) }}
                </p>
                
                {{-- Actions --}}
                <div class="flex flex-wrap gap-4 animate-fade-in delay-300">
                    {{-- BOUTON ACHETER POUR CONTENUS PREMIUM --}}
                    @if($contenu->est_premium && $contenu->type_acces === 'payant')
                        @auth
                            @if($contenu->utilisateurAAcces(auth()->user()))
                                {{-- Si l'utilisateur a déjà accès --}}
                                <a href="{{ route('contenus.premium', $contenu) }}"
                                   class="inline-flex items-center justify-center bg-gradient-to-r from-green-400 to-emerald-500 text-white px-6 py-3 rounded-full text-lg font-bold hover:from-green-500 hover:to-emerald-600 hover:scale-105 hover:shadow-xl transition-all duration-300 group">
                                    <i class="fas fa-unlock mr-2"></i>
                                    Accéder au contenu complet
                                </a>
                            @else
                                {{-- Si l'utilisateur n'a pas encore acheté --}}
                                <a href="{{ route('paiement.show', $contenu) }}"
                                   class="inline-flex items-center justify-center bg-gradient-to-r from-amber-500 to-orange-500 text-white px-6 py-3 rounded-full text-lg font-bold hover:from-amber-600 hover:to-orange-600 hover:scale-105 hover:shadow-xl transition-all duration-300 group animate-pulse">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Acheter maintenant ({{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }})
                                </a>
                            @endif
                        @else
                            {{-- Si utilisateur non connecté --}}
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center justify-center bg-gradient-to-r from-amber-500 to-orange-500 text-white px-6 py-3 rounded-full text-lg font-bold hover:from-amber-600 hover:to-orange-600 hover:scale-105 hover:shadow-xl transition-all duration-300 group">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Se connecter pour acheter
                            </a>
                        @endauth
                    @endif
                    
                    <button onclick="shareContent()"
                       class="inline-flex items-center justify-center bg-green-400 text-green-900 px-6 py-3 rounded-full text-lg font-bold hover:bg-green-300 hover:scale-105 hover:shadow-xl transition-all duration-300 group">
                        <i class="fas fa-share-alt mr-2"></i>
                        Partager
                    </button>
                    
                    <button id="favorite-btn" onclick="toggleFavorite()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="far fa-heart mr-2"></i>
                        Ajouter aux favoris
                    </button>
                    
                    <button onclick="scrollToComments()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-comment mr-2"></i>
                        Commenter
                    </button>
                </div>
            </div>
        </div>
        
        {{-- Vague décorative --}}
        <div class="absolute bottom-0 left-0 right-0 z-10">
            <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 100C120 80 240 40 360 30C480 20 600 40 720 50C840 60 960 60 1080 45C1200 30 1320 0 1380 0H1440V120H0Z" 
                      fill="white"/>
            </svg>
        </div>
    </section>

    {{-- CONTENU PRINCIPAL --}}
    <section class="py-16 bg-gradient-to-b from-white to-green-50/30">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Colonne latérale --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- CARTE PREMIUM AJOUTÉE ICI --}}
                    @if($contenu->est_premium && $contenu->type_acces === 'payant')
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl shadow-lg border border-amber-200 p-6 animate-slide-up">
                            <h3 class="text-lg font-bold text-amber-900 mb-4 flex items-center">
                                <i class="fas fa-crown mr-2 text-amber-600"></i>
                                Contenu Premium
                            </h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-amber-700">Prix</div>
                                    <div class="font-bold text-2xl text-amber-900">{{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }}</div>
                                </div>
                                
                                @if($contenu->duree_acces)
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-amber-600 mr-3"></i>
                                    <div>
                                        <div class="text-sm text-amber-700">Durée d'accès</div>
                                        <div class="font-medium text-amber-900">{{ $contenu->duree_acces === '24h' ? '24 heures' : ($contenu->duree_acces === '7j' ? '7 jours' : ($contenu->duree_acces === '30j' ? '30 jours' : 'Accès illimité')) }}</div>
                                    </div>
                                </div>
                                @endif
                                
                                @auth
                                    @if($contenu->utilisateurAAcces(auth()->user()))
                                        <div class="mt-4 p-3 bg-gradient-to-r from-green-100 to-emerald-100 rounded-lg border border-green-200">
                                            <div class="flex items-center">
                                                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                                <div>
                                                    <div class="font-medium text-green-800">Vous avez accès à ce contenu</div>
                                                    <a href="{{ route('contenus.premium', $contenu) }}" 
                                                       class="text-sm text-green-700 hover:text-green-900 inline-flex items-center mt-1">
                                                        Accéder au contenu complet <i class="fas fa-arrow-right ml-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-4">
                                            <a href="{{ route('paiement.show', $contenu) }}" 
                                               class="block w-full text-center bg-gradient-to-r from-amber-500 to-orange-500 text-white px-4 py-3 rounded-lg font-bold hover:from-amber-600 hover:to-orange-600 transition-all shadow-md">
                                                <div class="flex items-center justify-center">
                                                    <i class="fas fa-lock-open mr-2"></i>
                                                    Débloquer ce contenu
                                                </div>
                                            </a>
                                            <p class="text-xs text-amber-600 text-center mt-2">
                                                Paiement sécurisé via FedaPay
                                            </p>
                                        </div>
                                    @endif
                                @else
                                    <div class="mt-4 space-y-2">
                                        <a href="{{ route('login') }}" 
                                           class="block w-full text-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-3 rounded-lg font-bold hover:from-blue-600 hover:to-indigo-700 transition-all">
                                            <div class="flex items-center justify-center">
                                                <i class="fas fa-sign-in-alt mr-2"></i>
                                                Se connecter
                                            </div>
                                        </a>
                                        <p class="text-xs text-amber-600 text-center">
                                            Connectez-vous pour acheter ce contenu
                                        </p>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    @endif
                    
                    {{-- Statistiques --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6 animate-slide-up">
                        <h3 class="text-lg font-bold text-secondary-900 mb-4">À propos</h3>
                        <div class="space-y-4">
                            @if($contenu->auteur)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500">Auteur</div>
                                    <div class="font-medium text-secondary-900">{{ $contenu->auteur->name }}</div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500">Date de publication</div>
                                    <div class="font-medium text-secondary-900">{{ $contenu->date_creation->diffForHumans() }}</div>
                                </div>
                            </div>
                            
                            @if($contenu->date_validation)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500">Validé le</div>
                                    <div class="font-medium text-secondary-900">{{ $contenu->date_validation->format('d/m/Y') }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Médias associés --}}
                    @if($contenu->medias->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6 animate-slide-up delay-100">
                        <h3 class="text-lg font-bold text-secondary-900 mb-4">Médias</h3>
                        <div class="space-y-4">
                            @foreach($contenu->medias as $media)
                            <div class="group cursor-pointer" onclick="openMedia('{{ $media->chemin }}', '{{ $media->description }}')">
                                <div class="aspect-video bg-gradient-to-br from-green-100 to-green-200 rounded-lg overflow-hidden relative">
                                    @if(in_array($media->typeMedia->nom_media ?? '', ['image', 'photo']))
                                        <img src="{{ $media->chemin }}" alt="{{ $media->description }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @elseif(in_array($media->typeMedia->nom_media ?? '', ['audio', 'son']))
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-volume-up text-green-600 text-3xl"></i>
                                        </div>
                                    @elseif(in_array($media->typeMedia->nom_media ?? '', ['video', 'film']))
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-play-circle text-green-600 text-3xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                                </div>
                                <div class="text-sm text-secondary-600 mt-2 truncate">{{ $media->description }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Tags --}}
                    @if($contenu->tags && count($contenu->tags) > 0)
                    <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6 animate-slide-up delay-200">
                        <h3 class="text-lg font-bold text-secondary-900 mb-4">Mots-clés</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($contenu->tags as $tag)
                            <a href="{{ route('contenus.index') }}?search={{ urlencode($tag) }}"
                               class="px-3 py-1.5 bg-green-100 text-green-700 text-sm rounded-full hover:bg-green-200 transition-colors">
                                {{ $tag }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Contenus similaires --}}
                    @if($similarContents && $similarContents->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6 animate-slide-up delay-300">
                        <h3 class="text-lg font-bold text-secondary-900 mb-4">Contenus similaires</h3>
                        <div class="space-y-4">
                            @foreach($similarContents->take(3) as $similar)
                            <a href="{{ route('contenus.show', $similar) }}" 
                               class="group flex items-center p-3 hover:bg-green-50 rounded-xl transition-colors">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    @php
                                        $similarIcon = match($similar->typeContenu->nom_contenu ?? '') {
                                            'Histoire' => 'fas fa-book-open',
                                            'Musique' => 'fas fa-music',
                                            'Art' => 'fas fa-palette',
                                            default => 'fas fa-file-alt'
                                        };
                                    @endphp
                                    <i class="{{ $similarIcon }} text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-secondary-900 truncate group-hover:text-green-700">{{ $similar->titre }}</div>
                                    <div class="text-xs text-secondary-500 mt-1">
                                        {{ $similar->region->nom_region ?? 'Bénin' }}
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-secondary-300 ml-2 group-hover:text-green-500"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- Contenu principal --}}
                <div class="lg:col-span-2">
                    {{-- Aperçu pour contenus payants non achetés --}}
                    @if($contenu->est_premium && $contenu->type_acces === 'payant' && (!auth()->check() || !$contenu->utilisateurAAcces(auth()->user())))
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-200 rounded-2xl p-8 mb-8 animate-fade-in">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-lock text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-2xl font-bold text-amber-900 mb-3">Contenu Premium Verrouillé</h3>
                                    <p class="text-amber-800 mb-6 text-lg">
                                        {{ $contenu->apercu ?? Str::limit(strip_tags($contenu->texte), 300) }}
                                    </p>
                                    
                                    <div class="bg-white/80 rounded-xl p-6 border border-amber-300 mb-6">
                                        <h4 class="font-bold text-amber-900 mb-3">Ce que vous obtiendrez :</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                                <span class="text-amber-800">Accès au contenu complet</span>
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                                <span class="text-amber-800">Téléchargement en format PDF</span>
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                                <span class="text-amber-800">Contenus multimédias exclusifs</span>
                                            </li>
                                            @if($contenu->duree_acces)
                                            <li class="flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                                <span class="text-amber-800">Accès {{ $contenu->duree_acces === '24h' ? 'pendant 24 heures' : ($contenu->duree_acces === '7j' ? 'pendant 7 jours' : ($contenu->duree_acces === '30j' ? 'pendant 30 jours' : 'illimité')) }}</span>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        @auth
                                            <a href="{{ route('paiement.show', $contenu) }}" 
                                               class="inline-flex items-center justify-center flex-1 bg-gradient-to-r from-amber-500 to-orange-500 text-white px-6 py-4 rounded-xl text-lg font-bold hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-shopping-cart mr-3 text-xl"></i>
                                                    <div class="text-left">
                                                        <div class="text-lg">Acheter maintenant</div>
                                                        <div class="text-sm opacity-90">{{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" 
                                               class="inline-flex items-center justify-center flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-4 rounded-xl text-lg font-bold hover:from-blue-600 hover:to-indigo-700 transition-all">
                                                <i class="fas fa-sign-in-alt mr-3"></i>
                                                Se connecter pour acheter
                                            </a>
                                            <a href="{{ route('register') }}" 
                                               class="inline-flex items-center justify-center flex-1 border-2 border-blue-500 text-blue-600 px-6 py-4 rounded-xl text-lg font-bold hover:bg-blue-50 transition-all">
                                                <i class="fas fa-user-plus mr-3"></i>
                                                Créer un compte
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Article complet pour contenus gratuits ou premium achetés --}}
                        <article class="bg-white rounded-2xl shadow-xl border border-green-100 p-8 animate-fade-in">
                            <div class="prose prose-lg max-w-none">
                                {!! $contenu->texte !!}
                            </div>
                        </article>
                    @endif
                    
                    {{-- Galerie d'images --}}
                    @if($contenu->medias->where('typeMedia.nom_media', 'image')->count() > 0 && (!$contenu->est_premium || $contenu->type_acces !== 'payant' || (auth()->check() && $contenu->utilisateurAAcces(auth()->user()))))
                    <div class="mt-8 animate-fade-in delay-100">
                        <h3 class="text-xl font-bold text-secondary-900 mb-6 heading-font">Galerie d'images</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($contenu->medias->where('typeMedia.nom_media', 'image') as $image)
                            <a href="{{ $image->chemin }}" data-lightbox="content-gallery" 
                               class="block aspect-square rounded-xl overflow-hidden hover:opacity-90 transition-opacity group">
                                <img src="{{ $image->chemin }}" alt="{{ $image->description }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                                    <span class="text-white text-sm truncate">{{ $image->description }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Audio --}}
                    @if($contenu->medias->where('typeMedia.nom_media', 'audio')->count() > 0 && (!$contenu->est_premium || $contenu->type_acces !== 'payant' || (auth()->check() && $contenu->utilisateurAAcces(auth()->user()))))
                    <div class="mt-8 animate-fade-in delay-200">
                        <h3 class="text-xl font-bold text-secondary-900 mb-6 heading-font">Enregistrements audio</h3>
                        <div class="space-y-4">
                            @foreach($contenu->medias->where('typeMedia.nom_media', 'audio') as $audio)
                            <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-6 border border-green-200">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h4 class="font-bold text-secondary-900">{{ $audio->description }}</h4>
                                        <div class="text-sm text-secondary-500 mt-1">Enregistrement audio</div>
                                    </div>
                                    <i class="fas fa-volume-up text-green-600 text-2xl"></i>
                                </div>
                                <audio controls class="w-full">
                                    <source src="{{ $audio->chemin }}" type="audio/mpeg">
                                    Votre navigateur ne supporte pas l'élément audio.
                                </audio>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Commentaires --}}
                    <div id="comments" class="mt-12 pt-8 border-t border-secondary-100 animate-fade-in delay-300">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-secondary-900 heading-font">Commentaires</h3>
                            <button onclick="showCommentForm()" 
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full text-sm font-bold hover:from-green-600 hover:to-green-700 transition-all">
                                <i class="fas fa-plus mr-2"></i>
                                Ajouter un commentaire
                            </button>
                        </div>
                        
                        {{-- Formulaire de commentaire (caché par défaut) --}}
                        <div id="comment-form" class="hidden mb-8">
                            <div class="bg-gradient-to-b from-green-50 to-white rounded-xl p-6 border border-green-200">
                                <h4 class="font-bold text-secondary-900 mb-4">Laisser un commentaire</h4>
                                <form id="new-comment-form">
                                    <div class="mb-4">
                                        <textarea rows="4" 
                                                  placeholder="Partagez votre avis sur ce contenu..."
                                                  class="w-full px-4 py-3 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-green-500/30 focus:border-green-400 outline-none transition-all"
                                                  required></textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="text-sm text-secondary-600 mr-4">Note :</div>
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="text-2xl text-gray-300 hover:text-amber-400 focus:outline-none" 
                                                        data-rating="{{ $i }}" onclick="setRating(this)">
                                                    <i class="far fa-star"></i>
                                                </button>
                                                @endfor
                                            </div>
                                            <input type="hidden" name="rating" id="rating-value" value="0">
                                        </div>
                                        <button type="submit" 
                                                class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-bold hover:from-green-600 hover:to-green-700 transition-all">
                                            Publier
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        {{-- Liste des commentaires --}}
                        <div class="space-y-6">
                            @forelse($contenu->commentaires->sortByDesc('date') as $commentaire)
                            <div class="bg-white rounded-xl p-6 border border-secondary-100 hover:border-green-200 transition-colors">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                            {{ strtoupper(substr($commentaire->utilisateur->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-secondary-900">{{ $commentaire->utilisateur->name }}</div>
                                            <div class="text-sm text-secondary-500">{{ $commentaire->date->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    @if($commentaire->note)
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-{{ $i <= $commentaire->note ? 'amber' : 'gray' }}-400 text-sm"></i>
                                        @endfor
                                    </div>
                                    @endif
                                </div>
                                <p class="text-secondary-600">{{ $commentaire->texte }}</p>
                            </div>
                            @empty
                            <div class="text-center py-12">
                                <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-comment text-green-600"></i>
                                </div>
                                <h4 class="text-lg font-bold text-secondary-900 mb-2">Aucun commentaire</h4>
                                <p class="text-secondary-600 mb-4">Soyez le premier à commenter ce contenu !</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />
@endsection

@push('scripts')
<script>
    // Fonction de partage
    function shareContent() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $contenu->titre }} - Culture Bénin',
                text: '{{ Str::limit(strip_tags($contenu->texte), 100) }}',
                url: window.location.href
            })
            .then(() => console.log('Contenu partagé avec succès'))
            .catch((error) => console.log('Erreur de partage:', error));
        } else {
            copyContentLink();
        }
    }
    
    function copyContentLink() {
        navigator.clipboard.writeText(window.location.href);
        showToast('Lien copié dans le presse-papier !', 'success');
    }
    
    // Gestion des favoris
    function toggleFavorite() {
        const btn = document.getElementById('favorite-btn');
        const icon = btn.querySelector('i');
        
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas', 'text-red-500');
            btn.innerHTML = '<i class="fas fa-heart mr-2 text-red-500"></i> Retirer des favoris';
            showToast('Ajouté aux favoris !', 'success');
            
            // Ici, tu pourrais faire une requête AJAX pour enregistrer le favori
            // fetch('/favoris/{{ $contenu->id }}', { method: 'POST' })
        } else {
            icon.classList.remove('fas', 'text-red-500');
            icon.classList.add('far');
            btn.innerHTML = '<i class="far fa-heart mr-2"></i> Ajouter aux favoris';
            showToast('Retiré des favoris', 'info');
            
            // Ici, tu pourrais faire une requête AJAX pour supprimer le favori
            // fetch('/favoris/{{ $contenu->id }}', { method: 'DELETE' })
        }
    }
    
    // Scroll vers les commentaires
    function scrollToComments() {
        document.getElementById('comments').scrollIntoView({ behavior: 'smooth' });
        document.getElementById('comment-form').classList.remove('hidden');
        document.querySelector('#comment-form textarea').focus();
    }
    
    // Afficher le formulaire de commentaire
    function showCommentForm() {
        document.getElementById('comment-form').classList.toggle('hidden');
        if (!document.getElementById('comment-form').classList.contains('hidden')) {
            document.querySelector('#comment-form textarea').focus();
        }
    }
    
    // Gestion des étoiles de notation
    let currentRating = 0;
    
    function setRating(star) {
        const rating = parseInt(star.dataset.rating);
        currentRating = rating;
        document.getElementById('rating-value').value = rating;
        
        // Mettre à jour l'affichage des étoiles
        const stars = document.querySelectorAll('[data-rating]');
        stars.forEach((s, index) => {
            const icon = s.querySelector('i');
            if (index < rating) {
                icon.classList.remove('far', 'text-gray-300');
                icon.classList.add('fas', 'text-amber-400');
            } else {
                icon.classList.remove('fas', 'text-amber-400');
                icon.classList.add('far', 'text-gray-300');
            }
        });
    }
    
    // Gestion du formulaire de commentaire
    document.getElementById('new-comment-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const commentText = this.querySelector('textarea').value;
        const rating = document.getElementById('rating-value').value;
        
        if (!commentText.trim()) {
            showToast('Veuillez écrire un commentaire', 'info');
            return;
        }
        
        // Ici, tu pourrais faire une requête AJAX pour enregistrer le commentaire
        // fetch('/contenus/{{ $contenu->id }}/commentaires', {
        //     method: 'POST',
        //     headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        //     body: JSON.stringify({ texte: commentText, note: rating })
        // })
        
        console.log('Commentaire:', commentText, 'Note:', rating);
        showToast('Commentaire publié !', 'success');
        
        // Réinitialiser le formulaire
        this.reset();
        document.getElementById('comment-form').classList.add('hidden');
        currentRating = 0;
        
        // Réinitialiser les étoiles
        document.querySelectorAll('[data-rating]').forEach(star => {
            const icon = star.querySelector('i');
            icon.classList.remove('fas', 'text-amber-400');
            icon.classList.add('far', 'text-gray-300');
        });
    });
    
    // Ouvrir un média en plein écran
    function openMedia(url, description) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/90 flex items-center justify-center z-50 p-4 animate-fade-in';
        modal.innerHTML = `
            <div class="relative max-w-4xl w-full max-h-[90vh]">
                <button onclick="this.closest('.fixed').remove()" 
                        class="absolute -top-12 right-0 text-white hover:text-gray-300 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
                <div class="bg-black rounded-xl overflow-hidden">
                    ${url.match(/\.(mp3|wav|ogg)$/i) ? 
                        `<audio controls class="w-full">
                            <source src="${url}" type="audio/mpeg">
                        </audio>` :
                        url.match(/\.(mp4|webm|ogv)$/i) ?
                        `<video controls class="w-full max-h-[80vh]">
                            <source src="${url}" type="video/mp4">
                        </video>` :
                        `<img src="${url}" alt="${description}" class="w-full h-auto max-h-[80vh] object-contain">`
                    }
                </div>
                ${description ? `
                <div class="mt-4 text-center">
                    <p class="text-white text-lg">${description}</p>
                </div>` : ''}
            </div>
        `;
        document.body.appendChild(modal);
    }
    
    // Fonction pour afficher une notification toast
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-xl z-50 animate-fade-in-up ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-secondary-800 text-white'
        }`;
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Animation au scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);
        
        // Observer les sections
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    });
</script>

<style>
    /* Style pour la prose (contenu) */
    .prose {
        line-height: 1.8;
        color: #374151;
    }
    
    .prose h2 {
        color: #1e293b;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        border-bottom: 2px solid #dcfce7;
        padding-bottom: 0.5rem;
    }
    
    .prose h3 {
        color: #1e293b;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
    }
    
    .prose p {
        margin-bottom: 1.5rem;
    }
    
    .prose ul, .prose ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .prose li {
        margin-bottom: 0.5rem;
    }
    
    .prose blockquote {
        border-left: 4px solid #16a34a;
        padding-left: 1rem;
        font-style: italic;
        color: #475569;
        margin: 1.5rem 0;
    }
    
    .prose a {
        color: #16a34a;
        text-decoration: underline;
        transition: color 0.2s;
    }
    
    .prose a:hover {
        color: #15803d;
    }
    
    /* Style pour la galerie d'images */
    .gallery-grid {
        display: grid;
        gap: 1rem;
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        aspect-ratio: 1;
    }
    
    .gallery-item img {
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.05);
    }
    
    /* Style pour le lecteur audio personnalisé */
    audio {
        width: 100%;
        height: 40px;
        border-radius: 20px;
    }
    
    audio::-webkit-media-controls-panel {
        background-color: #f0fdf4;
    }
    
    /* Animation pour les cartes d'information */
    .info-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(22, 163, 74, 0.1);
    }
    
    /* Style pour les tags */
    .tag {
        transition: all 0.2s ease;
    }
    
    .tag:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(22, 163, 74, 0.2);
    }
</style>
@endpush