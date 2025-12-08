@extends('layouts.guest')
@section('title', $region->nom . ' - Culture Bénin')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond dynamique ou placeholder --}}
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-800/80"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-teal-400/10 rounded-full blur-3xl"></div>
            
            {{-- Nom de région en arrière-plan subtil --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <div class="text-[15vw] font-black tracking-wider">{{ strtoupper(substr($region->nom, 0, 3)) }}</div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                {{-- Breadcrumb --}}
                <div class="flex justify-center items-center space-x-2 text-sm mb-6 animate-fade-in">
                    <a href="{{ route('regions.index') }}" class="text-green-300 hover:text-white transition-colors">
                        <i class="fas fa-map mr-1"></i> Régions
                    </a>
                    <span class="text-green-400">/</span>
                    <span class="text-white/80">{{ $region->nom }}</span>
                </div>
                
                {{-- Badge capitale --}}
                @if($region->capitale)
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <i class="fas fa-city text-green-300"></i>
                    <span class="text-sm font-medium">Capitale : {{ $region->capitale }}</span>
                </div>
                @endif
                
                {{-- Titre principal --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">{{ $region->nom }}</span>
                    <span class="block text-green-300 text-3xl md:text-4xl mt-4">
                        @if($region->capitale)
                        Région de {{ $region->capitale }}
                        @else
                        Région Culturelle du Bénin
                        @endif
                    </span>
                </h1>
                
                {{-- Description --}}
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    {{ $region->description ?? 'Découvrez les traditions, langues et contenus culturels uniques de cette région.' }}
                </p>
                
                {{-- Actions rapides --}}
                <div class="flex flex-wrap justify-center gap-4 animate-fade-in delay-200">
                    <a href="#contenus" 
                       class="inline-flex items-center justify-center bg-green-400 text-green-900 px-6 py-3 rounded-full text-lg font-bold hover:bg-green-300 hover:scale-105 hover:shadow-xl transition-all duration-300 group">
                        <i class="fas fa-book-open mr-2"></i>
                        Voir les contenus
                    </a>
                    <a href="#langues" 
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-language mr-2"></i>
                        Langues parlées
                    </a>
                    <button onclick="shareRegion()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-share-alt mr-2"></i>
                        Partager
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

    {{-- STATISTIQUES --}}
    <section class="py-12 bg-gradient-to-b from-white to-green-50/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-green-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up">
                    <div class="text-4xl font-bold text-green-600 mb-3">{{ $region->contenus_count ?? '0' }}</div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Contenus</div>
                    <div class="text-sm text-secondary-600">Culturels publiés</div>
                    <div class="mt-3">
                        <i class="fas fa-book text-green-400 text-xl"></i>
                    </div>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-teal-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up delay-100">
                    <div class="text-4xl font-bold text-teal-600 mb-3">{{ $region->langues->count() }}</div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Langues</div>
                    <div class="text-sm text-secondary-600">Traditionnellement parlées</div>
                    <div class="mt-3">
                        <i class="fas fa-language text-teal-400 text-xl"></i>
                    </div>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-amber-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up delay-200">
                    <div class="text-4xl font-bold text-amber-600 mb-3">
                        @if($region->population)
                            {{ number_format($region->population / 1000, 1) }}K
                        @else
                            —
                        @endif
                    </div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Habitants</div>
                    <div class="text-sm text-secondary-600">Population estimée</div>
                    <div class="mt-3">
                        <i class="fas fa-users text-amber-400 text-xl"></i>
                    </div>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg border border-purple-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slide-up delay-300">
                    <div class="text-4xl font-bold text-purple-600 mb-3">
                        @if($region->superficie)
                            {{ number_format($region->superficie) }} km²
                        @else
                            —
                        @endif
                    </div>
                    <div class="text-lg font-semibold text-secondary-900 mb-2">Superficie</div>
                    <div class="text-sm text-secondary-600">Surface totale</div>
                    <div class="mt-3">
                        <i class="fas fa-ruler-combined text-purple-400 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DESCRIPTION DÉTAILLÉE --}}
    @if($region->description || $region->localisation)
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in">
                    <h2 class="text-3xl font-bold text-secondary-900 mb-6 heading-font">À propos de la région</h2>
                    <div class="prose prose-lg max-w-none text-secondary-600">
                        @if($region->description)
                            <p class="mb-6">{{ $region->description }}</p>
                        @endif
                        
                        @if($region->localisation)
                            <div class="flex items-start mt-6 p-4 bg-green-50 rounded-xl">
                                <i class="fas fa-map-marker-alt text-green-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-secondary-900 mb-1">Localisation</h4>
                                    <p class="text-secondary-600">{{ $region->localisation }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($region->capitale)
                            <div class="flex items-start mt-4 p-4 bg-teal-50 rounded-xl">
                                <i class="fas fa-city text-teal-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-secondary-900 mb-1">Capitale régionale</h4>
                                    <p class="text-secondary-600">{{ $region->capitale }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                {{-- Carte ou illustration de la région --}}
                <div class="relative animate-slide-up">
                    <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl p-8 border border-green-200 shadow-lg">
                        <div class="aspect-video bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center relative overflow-hidden">
                            {{-- Carte stylisée --}}
                            <div class="absolute inset-4 bg-gradient-to-br from-green-200 to-green-300 rounded-lg"></div>
                            <div class="relative z-10 text-center">
                                <i class="fas fa-map-marked-alt text-green-600 text-6xl mb-4"></i>
                                <h3 class="text-xl font-bold text-secondary-900">{{ $region->nom }}</h3>
                                <p class="text-secondary-600 mt-2">Région du Bénin</p>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                <i class="fas fa-expand-alt mr-2"></i>
                                Voir la carte détaillée
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- LANGUES PARLÉES DANS LA RÉGION --}}
    @if($region->langues->count() > 0)
    <section id="langues" class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">Diversité Linguistique</span>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font mt-4">
                    Langues parlées dans la région
                </h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Découvrez la richesse linguistique de {{ $region->nom }} à travers les langues traditionnellement pratiquées
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($region->langues as $langue)
                <a href="{{ route('langues.show', $langue) }}" 
                   class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-green-100 overflow-hidden animate-fade-in-up">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100 to-green-50 rounded-full -translate-y-10 translate-x-6 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 mb-4 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-language text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-2">{{ $langue->nom_langue }}</h3>
                        @if($langue->code_langue)
                        <div class="inline-block bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full mb-3">
                            {{ $langue->code_langue }}
                        </div>
                        @endif
                        <p class="text-secondary-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($langue->description ?? 'Langue traditionnelle de la région', 100) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center text-green-600 font-medium text-sm">
                                En savoir plus
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                {{ $langue->contenus_count ?? '0' }} contenu(s)
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            @if($region->langues->count() > 6)
            <div class="text-center mt-12 animate-fade-in">
                <a href="{{ route('langues.index') }}" 
                   class="inline-flex items-center px-8 py-3 border-2 border-green-500 text-green-600 font-bold rounded-full hover:bg-green-50 hover:border-green-600 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-language mr-3"></i>
                    Voir toutes les langues du Bénin
                </a>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- CONTENUS DE LA RÉGION --}}
    @if($region->contenus->count() > 0)
    <section id="contenus" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">Patrimoine Culturel</span>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font mt-4">
                    Contenus liés à {{ $region->nom }}
                </h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Découvrez les histoires, traditions et savoirs culturels originaires de cette région
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($region->contenus as $contenu)
                <div class="animate-fade-in-up">
                    <x-content.content-card :contenu="$contenu" />
                </div>
                @endforeach
            </div>
            
            @if($region->contenus_count > 6)
            <div class="text-center mt-12 animate-fade-in">
                <a href="{{ route('admin.contenus.index', ['region' => $region->id]) }}" 
                   class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-full hover:from-green-600 hover:to-green-700 hover:shadow-xl hover:scale-105 transition-all duration-300 group shadow-lg">
                    Voir tous les {{ $region->contenus_count }} contenus
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
                    Enrichissons ensemble {{ $region->nom }}
                </h3>
                <p class="text-secondary-600 mb-8 max-w-lg mx-auto">
                    Cette région a besoin de votre contribution pour partager ses richesses culturelles. 
                    Partagez des histoires, traditions, photos ou connaissances sur {{ $region->nom }}.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('devenir-contributeur') }}" 
                       class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full font-bold hover:from-green-600 hover:to-green-700 hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Devenir contributeur
                    </a>
                    <a href="{{ route('admin.contenus.create') }}?region={{ $region->id }}" 
                       class="inline-flex items-center justify-center border-2 border-green-500 text-green-600 px-8 py-3 rounded-full font-bold hover:bg-green-50 hover:border-green-600 transition-all duration-300">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Ajouter un contenu
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- RÉGIONS VOISINES OU SIMILAIRES --}}
    <section class="py-16 bg-gradient-to-br from-secondary-900 to-secondary-800 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 heading-font">Explorez d'autres régions</h2>
                <p class="text-secondary-300 max-w-2xl mx-auto">
                    Découvrez les régions voisines ou aux caractéristiques similaires
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    // Récupérer 3 régions aléatoires (hors la région actuelle)
                    $autresRegions = \App\Models\Region::where('id_region', '!=', $region->id_region)->inRandomOrder()->limit(3)->get();
                @endphp
                
                @foreach($autresRegions as $autreRegion)
                <a href="{{ route('regions.show', $autreRegion) }}" 
                   class="group bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-map-pin text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $autreRegion->nom }}</h3>
                            @if($autreRegion->capitale)
                            <p class="text-secondary-300 text-sm">{{ $autreRegion->capitale }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="text-secondary-300 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($autreRegion->description ?? 'Région culturelle du Bénin', 80) }}
                    </p>
                    <div class="flex items-center text-green-300 text-sm font-medium group-hover:text-green-200">
                        <span>Explorer cette région</span>
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
    function shareRegion() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $region->nom }} - Culture Bénin',
                text: 'Découvrez la région {{ $region->nom }} sur la plateforme Culture Bénin',
                url: window.location.href
            })
            .then(() => console.log('Contenu partagé avec succès'))
            .catch((error) => console.log('Erreur de partage:', error));
        } else {
            // Fallback pour les navigateurs qui ne supportent pas l'API Web Share
            const url = window.location.href;
            navigator.clipboard.writeText(url);
            showToast('Lien copié dans le presse-papier !', 'success');
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
                animateValue(element, 0, parseFloat(finalValue.replace(/[^\d.]/g, '')), 1500 + (index * 200));
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
                if (element.textContent.includes('km²')) {
                    element.textContent = Math.round(current).toLocaleString() + ' km²';
                } else if (element.textContent.includes('K')) {
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
    .region-map {
        position: relative;
        overflow: hidden;
    }
    
    .region-map::before {
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
</style>
@endpush