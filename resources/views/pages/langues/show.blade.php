@extends('layouts.guest')
@section('title', $langue->nom_langue . ' - Langue du Bénin')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond --}}
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-800/60"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-teal-400/10 rounded-full blur-3xl"></div>
            
            {{-- Texte de la langue en arrière-plan --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <div class="text-[20vw] font-black tracking-wider">{{ strtoupper($langue->code_langue ?? substr($langue->nom_langue, 0, 3)) }}</div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                {{-- Breadcrumb --}}
                <div class="flex justify-center items-center space-x-2 text-sm mb-6 animate-fade-in">
                    <a href="{{ route('langues.index') }}" class="text-green-300 hover:text-white transition-colors">
                        <i class="fas fa-language mr-1"></i> Langues
                    </a>
                    <span class="text-green-400">/</span>
                    <span class="text-white/80">{{ $langue->nom_langue }}</span>
                </div>
                
                {{-- Badge type de langue --}}
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    @php
                        $langueTypeIcon = match($langue->type ?? '') {
                            'nationale' => 'fas fa-star',
                            'regionale' => 'fas fa-map-marker-alt',
                            'locale' => 'fas fa-home',
                            default => 'fas fa-language'
                        };
                        $langueTypeText = match($langue->type ?? '') {
                            'nationale' => 'Langue nationale',
                            'regionale' => 'Langue régionale',
                            'locale' => 'Langue locale',
                            default => 'Langue béninoise'
                        };
                    @endphp
                    <i class="{{ $langueTypeIcon }} text-green-300"></i>
                    <span class="text-sm font-medium">{{ $langueTypeText }}</span>
                </div>
                
                {{-- Titre principal --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">{{ $langue->nom_langue }}</span>
                    @if($langue->code_langue)
                    <span class="block text-green-300 text-3xl md:text-4xl mt-4">
                        ({{ $langue->code_langue }})
                    </span>
                    @endif
                </h1>
                
                {{-- Description --}}
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    {{ $langue->description ?? 'Langue traditionnelle du Bénin, riche en histoire et culture.' }}
                </p>
                
                {{-- Actions rapides --}}
                <div class="flex flex-wrap justify-center gap-4 animate-fade-in delay-200">
                    <a href="#contenus" 
                       class="inline-flex items-center justify-center bg-green-400 text-green-900 px-6 py-3 rounded-full text-lg font-bold hover:bg-green-300 hover:scale-105 hover:shadow-xl transition-all duration-300 group">
                        <i class="fas fa-book-open mr-2"></i>
                        Voir les contenus
                    </a>
                    <a href="#regions" 
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-map mr-2"></i>
                        Régions parlées
                    </a>
                    <button onclick="shareLangue()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-share-alt mr-2"></i>
                        Partager
                    </button>
                    @auth
                    <button onclick="toggleFavoriteLangue()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="far fa-heart mr-2"></i>
                        Ajouter aux favoris
                    </button>
                    @endauth
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

    {{-- STATISTIQUES --}}
    <section class="py-12 bg-gradient-to-b from-white to-green-50/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-green-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up">
                    <div class="text-4xl font-bold text-green-600 mb-3">{{ $langue->contenus_count ?? '0' }}</div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Contenus</div>
                    <div class="text-sm text-secondary-600">Dans cette langue</div>
                    <div class="mt-3">
                        <i class="fas fa-book text-green-400 text-xl"></i>
                    </div>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-teal-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up delay-100">
                    <div class="text-4xl font-bold text-teal-600 mb-3">{{ $langue->regions->count() ?? '0' }}</div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Régions</div>
                    <div class="text-sm text-secondary-600">Où elle est parlée</div>
                    <div class="mt-3">
                        <i class="fas fa-map-marker-alt text-teal-400 text-xl"></i>
                    </div>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-amber-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up delay-200">
                    <div class="text-4xl font-bold text-amber-600 mb-3">
                        @if($langue->nombre_locuteurs)
                            {{ number_format($langue->nombre_locuteurs / 1000, 1) }}K+
                        @else
                            —
                        @endif
                    </div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Locuteurs</div>
                    <div class="text-sm text-secondary-600">Estimés</div>
                    <div class="mt-3">
                        <i class="fas fa-users text-amber-400 text-xl"></i>
                    </div>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-purple-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up delay-300">
                    <div class="text-4xl font-bold text-purple-600 mb-3">
                        {{ $langue->famille_linguistique ?? '—' }}
                    </div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Famille</div>
                    <div class="text-sm text-secondary-600">Linguistique</div>
                    <div class="mt-3">
                        <i class="fas fa-sitemap text-purple-400 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DESCRIPTION DÉTAILLÉE --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="animate-fade-in">
                    <h2 class="text-3xl font-bold text-secondary-900 mb-6 heading-font">À propos de cette langue</h2>
                    <div class="prose prose-lg max-w-none text-secondary-600">
                        @if($langue->description)
                            <p class="mb-6 text-lg leading-relaxed">{{ $langue->description }}</p>
                        @endif
                        
                        {{-- Informations complémentaires --}}
                        <div class="space-y-4 mt-8">
                            @if($langue->famille_linguistique)
                            <div class="flex items-start p-4 bg-green-50 rounded-xl">
                                <i class="fas fa-sitemap text-green-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-secondary-900 mb-1">Famille linguistique</h4>
                                    <p class="text-secondary-600">{{ $langue->famille_linguistique }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($langue->ecriture)
                            <div class="flex items-start p-4 bg-teal-50 rounded-xl">
                                <i class="fas fa-font text-teal-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-secondary-900 mb-1">Système d'écriture</h4>
                                    <p class="text-secondary-600">{{ $langue->ecriture }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($langue->statut_officiel)
                            <div class="flex items-start p-4 bg-amber-50 rounded-xl">
                                <i class="fas fa-award text-amber-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-secondary-900 mb-1">Statut officiel</h4>
                                    <p class="text-secondary-600">{{ $langue->statut_officiel }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($langue->dialectes)
                            <div class="flex items-start p-4 bg-purple-50 rounded-xl">
                                <i class="fas fa-code-branch text-purple-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-secondary-900 mb-1">Dialectes principaux</h4>
                                    <p class="text-secondary-600">{{ $langue->dialectes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Carte ou illustration de la langue --}}
                <div class="relative animate-slide-up">
                    <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl p-8 border border-green-200 shadow-lg">
                        <div class="aspect-square bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center relative overflow-hidden">
                            {{-- Illustration stylisée --}}
                            <div class="absolute inset-4 bg-gradient-to-br from-green-200 to-green-300 rounded-lg"></div>
                            <div class="relative z-10 text-center">
                                <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-language text-white text-5xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-secondary-900">{{ $langue->nom_langue }}</h3>
                                <p class="text-secondary-600 mt-2">Langue du Bénin</p>
                                @if($langue->code_langue)
                                <div class="mt-4 inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full font-medium">
                                    Code : {{ $langue->code_langue }}
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Exemple de phrase --}}
                        <div class="mt-8 p-6 bg-white rounded-xl border border-green-100">
                            <h4 class="font-bold text-secondary-900 mb-3 flex items-center">
                                <i class="fas fa-comment-dots text-green-600 mr-2"></i>
                                Exemple de phrase
                            </h4>
                            <div class="text-lg text-secondary-700 italic mb-2">
                                "{{ $langue->exemple_phrase ?? 'Bienvenue dans notre communauté' }}"
                            </div>
                            <div class="text-sm text-secondary-500">
                                {{ $langue->traduction_exemple ?? 'Welcome to our community' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- RÉGIONS OÙ LA LANGUE EST PARLÉE --}}
    @if($langue->regions && $langue->regions->count() > 0)
    <section id="regions" class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">Géographie linguistique</span>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font mt-4">
                    Régions où le {{ $langue->nom_langue }} est parlé
                </h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Découvrez les régions du Bénin où cette langue est traditionnellement pratiquée
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($langue->regions as $region)
                <a href="{{ route('regions.show', $region) }}" 
                   class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-green-100 overflow-hidden animate-fade-in-up">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100 to-green-50 rounded-full -translate-y-10 translate-x-6 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 mb-4 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-map-pin text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-2">{{ $region->nom_region }}</h3>
                        @if($region->capitale)
                        <div class="inline-block bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full mb-3">
                            {{ $region->capitale }}
                        </div>
                        @endif
                        <p class="text-secondary-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($region->description ?? 'Région culturelle du Bénin', 100) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center text-green-600 font-medium text-sm">
                                Explorer la région
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                {{ $region->contenus_count ?? '0' }} contenu(s)
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            @if($langue->regions->count() > 6)
            <div class="text-center mt-12 animate-fade-in">
                <a href="{{ route('regions.index') }}" 
                   class="inline-flex items-center px-8 py-3 border-2 border-green-500 text-green-600 font-bold rounded-full hover:bg-green-50 hover:border-green-600 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-map mr-3"></i>
                    Voir toutes les régions du Bénin
                </a>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- CONTENUS DISPONIBLES DANS CETTE LANGUE --}}
    @if($langue->contenus && $langue->contenus->count() > 0)
    <section id="contenus" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">Patrimoine Culturel</span>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font mt-4">
                    Contenus disponibles en {{ $langue->nom_langue }}
                </h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Découvrez les histoires, traditions et savoirs culturels disponibles dans cette langue
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($langue->contenus as $contenu)
                <div class="animate-fade-in-up">
                    <x-content.content-card :contenu="$contenu" />
                </div>
                @endforeach
            </div>
            
            @if($langue->contenus_count > 6)
            <div class="text-center mt-12 animate-fade-in">
                <a href="{{ route('contenus.index', ['langue' => $langue->id]) }}" 
                   class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-full hover:from-green-600 hover:to-green-700 hover:shadow-xl hover:scale-105 transition-all duration-300 group shadow-lg">
                    Voir tous les {{ $langue->contenus_count }} contenus
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
            @endif
        </div>
    </section>
    @else
    {{-- APPEL À CONTRIBUTION SI PAS DE CONTENUS --}}
    <section class="py-16 bg-gradient-to-b from-white to-green-50/30">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="p-10 bg-gradient-to-br from-green-50 to-teal-50 rounded-3xl border-2 border-dashed border-green-200 animate-fade-in">
                <div class="w-24 h-24 mx-auto mb-8 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-pen-nib text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-secondary-900 mb-4">
                    Enrichissons la langue {{ $langue->nom_langue }}
                </h3>
                <p class="text-secondary-600 mb-8 max-w-lg mx-auto">
                    Cette langue a besoin de votre contribution pour partager ses richesses culturelles. 
                    Partagez des histoires, traditions, chansons ou connaissances en {{ $langue->nom_langue }}.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('devenir-contributeur') }}" 
                       class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full font-bold hover:from-green-600 hover:to-green-700 hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Devenir contributeur
                    </a>
                    <a href="{{ route('admin.contenus.create') }}?langue={{ $langue->id }}" 
                       class="inline-flex items-center justify-center border-2 border-green-500 text-green-600 px-8 py-3 rounded-full font-bold hover:bg-green-50 hover:border-green-600 transition-all duration-300">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Ajouter un contenu
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- LANGUES SIMILAIRES OU DE LA MÊME FAMILLE --}}
    <section class="py-16 bg-gradient-to-br from-secondary-900 to-secondary-800 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 heading-font">Découvrez d'autres langues</h2>
                <p class="text-secondary-300 max-w-2xl mx-auto">
                    Explorez les langues similaires ou de la même famille linguistique
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    // Récupérer 3 langues aléatoires (hors la langue actuelle)
                    $autresLangues = \App\Models\Langue::where('id_langue', '!=', $langue->id_langue)
                        ->inRandomOrder()
                        ->limit(3)
                        ->get();
                @endphp
                
                @foreach($autresLangues as $autreLangue)
                <a href="{{ route('langues.show', $autreLangue) }}" 
                   class="group bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-language text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $autreLangue->nom_langue }}</h3>
                            @if($autreLangue->code_langue)
                            <p class="text-secondary-300 text-sm">{{ $autreLangue->code_langue }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="text-secondary-300 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($autreLangue->description ?? 'Langue traditionnelle du Bénin', 80) }}
                    </p>
                    <div class="flex items-center text-green-300 text-sm font-medium group-hover:text-green-200">
                        <span>Explorer cette langue</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />
@endsection

@push('scripts')
<script>
    // Fonction de partage
    function shareLangue() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $langue->nom_langue }} - Culture Bénin',
                text: 'Découvrez la langue {{ $langue->nom_langue }} sur la plateforme Culture Bénin',
                url: window.location.href
            })
            .then(() => console.log('Langue partagée avec succès'))
            .catch((error) => console.log('Erreur de partage:', error));
        } else {
            copyLangueLink();
        }
    }
    
    function copyLangueLink() {
        navigator.clipboard.writeText(window.location.href);
        showToast('Lien copié dans le presse-papier !', 'success');
    }
    
    // Gestion des favoris
    function toggleFavoriteLangue() {
        const btn = document.querySelector('button[onclick="toggleFavoriteLangue()"]');
        const icon = btn.querySelector('i');
        
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas', 'text-red-500');
            btn.innerHTML = '<i class="fas fa-heart mr-2 text-red-500"></i> Retirer des favoris';
            showToast('Langue ajoutée aux favoris !', 'success');
            
            // Ici, tu pourrais faire une requête AJAX pour enregistrer le favori
            // fetch('/langues/{{ $langue->id }}/favori', { method: 'POST' })
        } else {
            icon.classList.remove('fas', 'text-red-500');
            icon.classList.add('far');
            btn.innerHTML = '<i class="far fa-heart mr-2"></i> Ajouter aux favoris';
            showToast('Langue retirée des favoris', 'info');
            
            // Ici, tu pourrais faire une requête AJAX pour supprimer le favori
            // fetch('/langues/{{ $langue->id }}/favori', { method: 'DELETE' })
        }
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
        
        // Smooth scroll pour les ancres internes
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
        
        // Animation des statistiques
        const statNumbers = document.querySelectorAll('.text-4xl.font-bold');
        statNumbers.forEach((element, index) => {
            const finalValue = element.textContent;
            if (finalValue !== '—') {
                // Vérifier si c'est un nombre
                const numericValue = parseFloat(finalValue.replace(/[^\d.]/g, ''));
                if (!isNaN(numericValue)) {
                    animateValue(element, 0, numericValue, 1500 + (index * 200));
                }
            }
        });
        
        function animateValue(element, start, end, duration) {
            if (start === end) return;
            
            const range = end - start;
            const increment = end > start ? 1 : -1;
            const stepTime = Math.abs(Math.floor(duration / range));
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (element.textContent.includes('K')) {
                    element.textContent = (current / 1000).toFixed(1) + 'K';
                } else {
                    element.textContent = Math.round(current).toLocaleString();
                }
                
                if (current === end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }
    });
</script>

<style>
    /* Animation pour le line-clamp */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Style pour la prose (description) */
    .prose p {
        margin-bottom: 1.5rem;
        line-height: 1.7;
    }
    
    .prose-lg {
        font-size: 1.125rem;
        line-height: 1.7;
    }
    
    /* Animation pour la carte */
    .langue-illustration {
        position: relative;
        overflow: hidden;
    }
    
    .langue-illustration::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.1) 0%, rgba(13, 148, 136, 0.1) 100%);
        z-index: 1;
    }
    
    /* Effet de brillance sur les cartes */
    .card-glow {
        position: relative;
        overflow: hidden;
    }
    
    .card-glow::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        transform: rotate(30deg);
        transition: transform 0.6s;
    }
    
    .card-glow:hover::after {
        transform: rotate(30deg) translate(10%, 10%);
    }
    
    /* Style pour l'exemple de phrase */
    .phrase-example {
        border-left: 4px solid #16a34a;
        padding-left: 1rem;
        font-style: italic;
    }
</style>
@endpush