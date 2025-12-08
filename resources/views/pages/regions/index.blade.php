@extends('layouts.guest')
@section('title', 'Régions du Bénin')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond --}}
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1580136607986-855c56ae0ff1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-green-800/60"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-20 left-1/4 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-1/4 w-96 h-96 bg-teal-400/10 rounded-full blur-3xl"></div>
            
            {{-- Carte du Bénin stylisée --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-10">
                <svg class="w-1/2 h-1/2" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50,10 L90,30 L80,70 L20,90 L10,50 Z" stroke="white" stroke-width="2" fill="none" />
                    <circle cx="30" cy="40" r="3" fill="white" />
                    <circle cx="60" cy="50" r="3" fill="white" />
                    <circle cx="45" cy="65" r="3" fill="white" />
                    <circle cx="70" cy="35" r="3" fill="white" />
                </svg>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <i class="fas fa-map-marked-alt text-green-300"></i>
                    <span class="text-sm font-medium">Géographie Culturelle</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">Les Régions du</span>
                    <span class="block text-green-300">Bénin</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    Découvrez la diversité culturelle du Bénin à travers ses 12 départements, 
                    chacun avec ses traditions uniques, ses langues et son patrimoine vivant.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8 animate-fade-in delay-200">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-language text-green-300 mr-2"></i>
                        <span class="text-sm">50+ langues parlées</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-landmark text-green-300 mr-2"></i>
                        <span class="text-sm">Patrimoine UNESCO</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-users text-green-300 mr-2"></i>
                        <span class="text-sm">Communautés diverses</span>
                    </div>
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

    {{-- INTRODUCTION ET FILTRES --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">Explorez par Région</h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Naviguez à travers les différentes régions culturelles du Bénin et découvrez leur richesse patrimoniale
                </p>
            </div>
            
            {{-- Filtres et recherche --}}
            <div class="mb-12 animate-fade-in">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    {{-- Barre de recherche --}}
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-secondary-400"></i>
                        </div>
                        <input type="search" 
                               placeholder="Rechercher une région..." 
                               class="pl-10 pr-4 py-3 w-full border border-secondary-200 rounded-xl bg-white focus:ring-2 focus:ring-green-500/30 focus:border-green-400 transition-all duration-300 outline-none">
                    </div>
                    
                    {{-- Filtres --}}
                    <div class="flex flex-wrap gap-2">
                        <button class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-medium hover:from-green-600 hover:to-green-700 transition-all shadow-md">
                            Toutes les régions
                        </button>
                        <button class="px-5 py-2.5 bg-white text-secondary-700 rounded-xl font-medium hover:bg-green-50 hover:text-green-700 border border-secondary-200 transition-all">
                            Par population
                        </button>
                        <button class="px-5 py-2.5 bg-white text-secondary-700 rounded-xl font-medium hover:bg-teal-50 hover:text-teal-700 border border-secondary-200 transition-all">
                            Par superficie
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CARTE INTERACTIVE --}}
    <section class="py-12 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 animate-fade-in">
                <h3 class="text-2xl font-bold text-secondary-900 mb-4">Carte des Régions</h3>
                <p class="text-secondary-600">Cliquez sur une région pour découvrir ses caractéristiques</p>
            </div>
            
            {{-- Carte simplifiée du Bénin (visuelle) --}}
            <div class="relative bg-white rounded-2xl shadow-lg p-6 mb-12 animate-slide-up overflow-hidden">
                <div class="relative h-64 md:h-80 bg-gradient-to-br from-green-50 to-teal-50 rounded-xl border border-green-200 overflow-hidden">
                    {{-- Carte simplifiée avec régions cliquables --}}
                    <div class="absolute inset-0 flex items-center justify-center p-8">
                        <div class="relative w-full h-full max-w-2xl mx-auto">
                            {{-- Représentation stylisée des régions --}}
                            @foreach($regions as $index => $region)
                            <a href="{{ route('regions.show', $region) }}" 
                               class="absolute region-dot group"
                               style="
                                   top: {{ 20 + (rand(10, 70)) }}%;
                                   left: {{ 15 + (rand(10, 70)) }}%;
                               "
                               title="{{ $region->nom_region }}">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-xs md:text-sm shadow-lg hover:scale-125 transition-transform duration-300">
                                    {{ substr($region->nom_region, 0, 2) }}
                                </div>
                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-1 bg-white rounded-lg shadow-lg text-secondary-900 text-sm font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10">
                                    {{ $region->nom_region }}
                                    <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-white rotate-45"></div>
                                </div>
                            </a>
                            @endforeach
                            
                            {{-- Légende --}}
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg p-4 shadow-lg">
                                <div class="text-sm font-medium text-secondary-900 mb-2">Légende</div>
                                <div class="flex items-center text-xs text-secondary-600">
                                    <div class="w-3 h-3 bg-gradient-to-br from-green-500 to-green-600 rounded-full mr-2"></div>
                                    <span>Région culturelle</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LISTE DES RÉGIONS --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">
                    {{ $regions->count() }} Régions Culturelles
                </h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Découvrez chaque région avec ses spécificités linguistiques, traditions et patrimoines
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($regions as $region)
                    <div class="group animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                        <x-region.region-card :region="$region" />
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 animate-fade-in">
                        <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-map text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary-800 mb-3">Aucune région disponible</h3>
                        <p class="text-secondary-600 mb-6">Les régions seront bientôt ajoutées à la plateforme</p>
                        <a href="{{ route('devenir-contributeur') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            <i class="fas fa-user-plus mr-2"></i>
                            Devenir contributeur pour ajouter des régions
                        </a>
                    </div>
                @endforelse
            </div>
            
            {{-- Pagination si nécessaire --}}
            @if($regions instanceof \Illuminate\Pagination\LengthAwarePaginator && $regions->hasPages())
                <div class="mt-12 animate-fade-in">
                    {{ $regions->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </section>

    {{-- STATISTIQUES RÉGIONALES --}}
    <section class="py-16 bg-gradient-to-br from-secondary-900 to-secondary-800 text-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 heading-font">Chiffres par Région</h2>
                <p class="text-secondary-300 max-w-2xl mx-auto">
                    Quelques statistiques sur la diversité culturelle à travers les régions du Bénin
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up">
                    <div class="text-4xl font-bold text-green-300 mb-2">{{ $regions->count() }}</div>
                    <div class="text-sm text-secondary-300">Départements</div>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-100">
                    <div class="text-4xl font-bold text-teal-300 mb-2">50+</div>
                    <div class="text-sm text-secondary-300">Langues parlées</div>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-200">
                    <div class="text-4xl font-bold text-amber-300 mb-2">12M+</div>
                    <div class="text-sm text-secondary-300">Habitants</div>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-300">
                    <div class="text-4xl font-bold text-purple-300 mb-2">114K km²</div>
                    <div class="text-sm text-secondary-300">Superficie totale</div>
                </div>
            </div>
        </div>
    </section>

    {{-- APPEL À CONTRIBUTION --}}
    <section class="py-16 bg-gradient-to-b from-white to-green-50/30">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-3xl p-10 border-2 border-green-200 shadow-xl animate-fade-in">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/3 text-center">
                        <div class="w-32 h-32 mx-auto bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-2xl">
                            <i class="fas fa-map-marked text-white text-4xl"></i>
                        </div>
                    </div>
                    
                    <div class="md:w-2/3 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-secondary-900 mb-4">Connaissez-vous bien votre région ?</h3>
                        <p class="text-secondary-600 mb-6">
                            Contribuez à enrichir la connaissance de votre région en partageant vos connaissances 
                            sur ses traditions, langues, fêtes et patrimoines culturels.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('devenir-contributeur') }}" 
                               class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full font-bold hover:from-green-600 hover:to-green-700 hover:shadow-xl transition-all duration-300 group">
                                <i class="fas fa-user-plus mr-2"></i>
                                Devenir contributeur
                            </a>
                            <a href="{{ route('admin.contenus.create') }}" 
                               class="inline-flex items-center justify-center border-2 border-green-500 text-green-600 px-8 py-3 rounded-full font-bold hover:bg-green-50 hover:border-green-600 transition-all duration-300">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Ajouter une région
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />
@endsection

@push('styles')
<style>
    /* Animation pour les points de la carte */
    .region-dot {
        transition: all 0.3s ease;
        z-index: 1;
    }
    
    .region-dot:hover {
        z-index: 10;
    }
    
    /* Animation des statistiques */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stat-number {
        animation: countUp 1s ease-out forwards;
    }
    
    /* Style pour la carte interactive */
    .map-container {
        position: relative;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border-radius: 1rem;
        overflow: hidden;
    }
    
    /* Effet de profondeur pour les cartes */
    .card-depth {
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-depth:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(22, 163, 74, 0.25);
    }
    
    /* Animation pour les éléments qui apparaissent */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    // Animation des statistiques au scroll
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    
                    // Animation des chiffres
                    if (entry.target.classList.contains('stat-number')) {
                        animateValue(entry.target, 0, parseInt(entry.target.textContent), 1500);
                    }
                }
            });
        }, observerOptions);
        
        // Observer les statistiques
        document.querySelectorAll('.text-4xl.font-bold').forEach(el => {
            if (el.parentElement.classList.contains('text-center')) {
                observer.observe(el);
            }
        });
        
        // Fonction d'animation des chiffres
        function animateValue(element, start, end, duration) {
            if (start === end) return;
            
            const range = end - start;
            const increment = end > start ? 1 : -1;
            const stepTime = Math.abs(Math.floor(duration / range));
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                element.textContent = current;
                
                if (current === end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }
        
        // Filtres interactifs (simulé)
        const filterButtons = document.querySelectorAll('button[class*="px-5 py-2.5"]');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Retirer la classe active de tous les boutons
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-gradient-to-r', 'from-green-500', 'to-green-600', 'text-white');
                    btn.classList.add('bg-white', 'text-secondary-700', 'border', 'border-secondary-200');
                });
                
                // Ajouter la classe active au bouton cliqué
                this.classList.remove('bg-white', 'text-secondary-700', 'border', 'border-secondary-200');
                this.classList.add('bg-gradient-to-r', 'from-green-500', 'to-green-600', 'text-white');
                
                // Simulation de filtrage
                console.log('Filtre activé:', this.textContent.trim());
            });
        });
        
        // Recherche en temps réel (simulée)
        const searchInput = document.querySelector('input[type="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                console.log('Recherche:', searchTerm);
                // Ici, tu pourrais ajouter la logique de filtrage AJAX
            });
        }
        
        // Animation pour les points de la carte
        const regionDots = document.querySelectorAll('.region-dot');
        regionDots.forEach((dot, index) => {
            dot.style.animationDelay = `${index * 200}ms`;
        });
    });
    
    // Fonction pour afficher une infobulle sur la carte
    function showRegionInfo(regionName, description) {
        const infoBox = document.createElement('div');
        infoBox.className = 'fixed top-4 right-4 max-w-sm bg-white rounded-xl shadow-2xl p-6 z-50 animate-fade-in-up';
        infoBox.innerHTML = `
            <div class="flex justify-between items-start mb-4">
                <h4 class="text-lg font-bold text-secondary-900">${regionName}</h4>
                <button onclick="this.parentElement.parentElement.remove()" class="text-secondary-400 hover:text-secondary-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-secondary-600 text-sm">${description}</p>
            <div class="mt-4 pt-4 border-t border-secondary-100">
                <a href="#" class="text-green-600 hover:text-green-700 font-medium text-sm">
                    En savoir plus <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        `;
        document.body.appendChild(infoBox);
        
        setTimeout(() => {
            infoBox.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => infoBox.remove(), 300);
        }, 5000);
    }
</script>
@endpush