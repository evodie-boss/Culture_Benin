@extends('layouts.guest')
@section('title', 'Accueil - Culture Bénin')

@section('content')

    {{-- HERO AVEC CARROUSEL --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        {{-- Carrousel d'images --}}
        <div class="absolute inset-0 z-0">
            <div id="hero-carousel" class="h-full">
                {{-- Image 1 --}}
                <div class="carousel-slide absolute inset-0 opacity-40 transition-opacity duration-1000">
                    <img src="{{ asset('adminlte/img/culture-1.jpeg') }}" 
                         alt="Culture béninoise" class="w-full h-full object-cover">
                    {{-- FILTRE VERT SUPPRIMÉ ICI --}}
                </div>
                {{-- Image 2 --}}
                <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="{{ asset('adminlte/img/culture-2.jpeg') }}" 
                         alt="Artisanat béninois" class="w-full h-full object-cover">
                    {{-- FILTRE VERT SUPPRIMÉ ICI --}}
                </div>
                {{-- Image 3 --}}
                <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="{{ asset('adminlte/img/culture-3.jpeg') }}" 
                         alt="Traditions béninoises" class="w-full h-full object-cover">
                    {{-- FILTRE VERT SUPPRIMÉ ICI --}}
                </div>
                {{-- Image 4 --}}
                <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="{{ asset('adminlte/img/culture-4.jpeg') }}" 
                         alt="Nature béninoise" class="w-full h-full object-cover">
                    {{-- FILTRE VERT SUPPRIMÉ ICI --}}
                </div>
            </div>
        </div>

        {{-- Fallback si images manquantes --}}
        <div class="absolute inset-0 z-0 opacity-20 hidden" id="fallback-pattern">
            <div class="w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z" fill="%23ffffff" fill-opacity="0.4"/%3E%3C/svg%3E');"></div>
        </div>

        {{-- Contenu Hero --}}
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-3xl">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">Patrimoine Culturel Vivant</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up">
                    <span class="block heading-font">Plongez au cœur de la</span>
                    <span class="block text-green-300 heading-font">Culture Béninoise</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-2xl animate-fade-in delay-100">
                    Découvrez les trésors culturels du Bénin à travers ses histoires, 
                    ses langues, ses traditions et son patrimoine immatériel.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-12 animate-fade-in delay-200">
                    <a href="{{ route('contenus.index') ?? '/contenus' }}" 
                       class="inline-flex items-center justify-center bg-green-400 text-green-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-green-300 hover:scale-105 hover:shadow-2xl transition-all duration-300 group shadow-lg">
                        Commencer l'exploration
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                    </a>
                    <a href="{{ route('regions.index') ?? '/regions' }}" 
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-8 py-4 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 hover:shadow-xl transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-map-marked-alt mr-3"></i>
                        Explorer les régions
                    </a>
                </div>
                
                {{-- Indicateurs carrousel --}}
                <div class="flex space-x-3 animate-fade-in delay-300">
                    <button class="carousel-indicator w-10 h-2 bg-white/50 rounded-full hover:bg-white transition" 
                            data-slide="0"></button>
                    <button class="carousel-indicator w-10 h-2 bg-white/30 rounded-full hover:bg-white transition" 
                            data-slide="1"></button>
                    <button class="carousel-indicator w-10 h-2 bg-white/30 rounded-full hover:bg-white transition" 
                            data-slide="2"></button>
                    <button class="carousel-indicator w-10 h-2 bg-white/30 rounded-full hover:bg-white transition" 
                            data-slide="3"></button>
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
        
        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
            <a href="#categories" class="text-white/70 hover:text-white transition-colors">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    {{-- STATISTIQUES --}}
    <x-partials.stats-section class="my-20" />

    {{-- CATÉGORIES --}}
    <section id="categories" class="py-20 bg-gradient-to-b from-white to-green-50/20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">Explorez par thème</span>
                <h2 class="text-4xl md:text-5xl font-bold text-secondary-900 mb-6 heading-font mt-4">Découvrez Notre Patrimoine</h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Plongez dans les différentes facettes de la culture béninoise à travers nos collections thématiques
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <a href="{{ route('contenus.index', ['type' => 'histoire']) ?? '/contenus?type=histoire' }}" 
                   class="group relative bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-secondary-100 overflow-hidden animate-slide-up">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-100 to-green-50 rounded-full -translate-y-12 translate-x-6 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 mb-6 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-book-open text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Histoires & Récits</h3>
                        <p class="text-secondary-600 text-sm mb-4">Contes, légendes et traditions orales qui ont traversé les siècles</p>
                        <span class="inline-flex items-center text-green-600 font-medium text-sm group-hover:text-green-700">
                            Explorer
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
                
                <a href="{{ route('contenus.index', ['type' => 'musique']) ?? '/contenus?type=musique' }}" 
                   class="group relative bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-secondary-100 overflow-hidden animate-slide-up delay-100">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-teal-100 to-teal-50 rounded-full -translate-y-12 translate-x-6 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 mb-6 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-music text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Musique & Danse</h3>
                        <p class="text-secondary-600 text-sm mb-4">Rythmes traditionnels et danses ancestrales des différentes ethnies</p>
                        <span class="inline-flex items-center text-teal-600 font-medium text-sm group-hover:text-teal-700">
                            Explorer
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
                
                <a href="{{ route('contenus.index', ['type' => 'art']) ?? '/contenus?type=art' }}" 
                   class="group relative bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-secondary-100 overflow-hidden animate-slide-up delay-200">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-amber-100 to-amber-50 rounded-full -translate-y-12 translate-x-6 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 mb-6 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-palette text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Arts Visuels</h3>
                        <p class="text-secondary-600 text-sm mb-4">Sculptures, tissages, peintures et artisanat traditionnel</p>
                        <span class="inline-flex items-center text-amber-600 font-medium text-sm group-hover:text-amber-700">
                            Explorer
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
                
                <a href="{{ route('contenus.index', ['type' => 'fete']) ?? '/contenus?type=fete' }}" 
                   class="group relative bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-secondary-100 overflow-hidden animate-slide-up delay-300">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-purple-100 to-purple-50 rounded-full -translate-y-12 translate-x-6 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 mb-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-calendar-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Fêtes & Cérémonies</h3>
                        <p class="text-secondary-600 text-sm mb-4">Rituels, célébrations et événements culturels traditionnels</p>
                        <span class="inline-flex items-center text-purple-600 font-medium text-sm group-hover:text-purple-700">
                            Explorer
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- CONTENUS RÉCENTS --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">À découvrir</span>
                <h2 class="text-4xl md:text-5xl font-bold text-secondary-900 mb-6 heading-font mt-4">Contenus Récents</h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Les dernières contributions de notre communauté culturelle
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($contenusRecents ?? \App\Models\Contenu::latest()->take(6)->get() as $contenu)
                    <x-content.content-card :contenu="$contenu" />
                @empty
                    <div class="col-span-full text-center py-12 animate-fade-in">
                        <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-book-open text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-secondary-700 mb-2">Aucun contenu pour le moment</h3>
                        <p class="text-secondary-500">Soyez le premier à contribuer !</p>
                        <a href="{{ route('register') ?? '/register' }}" class="inline-flex items-center mt-6 text-green-600 hover:text-green-700 font-medium">
                            <i class="fas fa-user-plus mr-2"></i>
                            S'inscrire maintenant
                        </a>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center animate-fade-in">
                <a href="{{ route('contenus.index') ?? '/contenus' }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-full hover:from-green-600 hover:to-green-700 hover:shadow-2xl hover:scale-105 transition-all duration-300 group shadow-lg">
                    Voir tous les contenus
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- RÉGIONS --}}
    <section class="py-20 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 animate-fade-in">
                <span class="inline-block text-green-600 font-semibold mb-3 px-4 py-1.5 bg-green-100 rounded-full">Géographie culturelle</span>
                <h2 class="text-4xl md:text-5xl font-bold text-secondary-900 mb-6 heading-font mt-4">Régions du Bénin</h2>
                <p class="text-secondary-600 text-lg max-w-2xl mx-auto">
                    Découvrez la diversité culturelle à travers les différentes régions du pays
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($regions ?? \App\Models\Region::take(6)->get() as $region)
                    <x-region.region-card :region="$region" />
                @empty
                    <div class="col-span-full text-center py-12 animate-fade-in">
                        <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-map text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-secondary-700 mb-2">Aucune région disponible</h3>
                        <p class="text-secondary-500">Les régions seront bientôt ajoutées</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12 animate-fade-in">
                <a href="{{ route('regions.index') ?? '/regions' }}" 
                   class="inline-flex items-center px-8 py-4 border-2 border-green-500 text-green-600 font-bold rounded-full hover:bg-green-50 hover:border-green-600 hover:scale-105 transition-all duration-300 shadow-sm">
                    <i class="fas fa-globe-africa mr-3"></i>
                    Explorer toutes les régions
                </a>
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />

@endsection

@push('scripts')
<script>
    // Carrousel Hero avec gestion d'erreurs pour images manquantes
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide img');
        const fallbackPattern = document.getElementById('fallback-pattern');
        
        // Vérifier si les images existent
        slides.forEach(img => {
            img.onerror = function() {
                this.style.display = 'none';
                fallbackPattern.classList.remove('hidden');
            };
            img.onload = function() {
                fallbackPattern.classList.add('hidden');
            };
        });
        
        // Fonctionnalité du carrousel
        const slideContainers = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        let currentSlide = 0;
        
        function showSlide(index) {
            // Masquer toutes les slides
            slideContainers.forEach(slide => {
                slide.style.opacity = '0';
                slide.style.zIndex = '0';
            });
            
            // Afficher la slide actuelle
            slideContainers[index].style.opacity = '1';
            slideContainers[index].style.zIndex = '1';
            
            // Mettre à jour les indicateurs
            indicators.forEach((indicator, i) => {
                if (i === index) {
                    indicator.classList.remove('bg-white/30');
                    indicator.classList.add('bg-white');
                } else {
                    indicator.classList.remove('bg-white');
                    indicator.classList.add('bg-white/30');
                }
            });
            
            currentSlide = index;
        }
        
        // Gestion des clics sur les indicateurs
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                showSlide(index);
                resetAutoSlide();
            });
        });
        
        let autoSlideInterval;
        
        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                let nextSlide = (currentSlide + 1) % slideContainers.length;
                showSlide(nextSlide);
            }, 5000);
        }
        
        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }
        
        // Initialisation
        showSlide(0);
        startAutoSlide();
        
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);
        
        // Observer les éléments avec animations
        document.querySelectorAll('.animate-fade-in, .animate-slide-up').forEach(el => {
            observer.observe(el);
        });
    });
    
    // Smooth scroll pour le bouton "Explorer"
    document.addEventListener('DOMContentLoaded', function() {
        const scrollIndicator = document.querySelector('a[href="#categories"]');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }
    });
</script>

<style>
    /* Animations supplémentaires */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        opacity: 0;
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    .animate-slide-up {
        opacity: 0;
        animation: slideUp 0.8s ease-out forwards;
    }
    
    .delay-100 {
        animation-delay: 100ms;
    }
    
    .delay-200 {
        animation-delay: 200ms;
    }
    
    .delay-300 {
        animation-delay: 300ms;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    /* Effet de flou au défilement pour le hero */
    .hero-blur {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    
    /* Effet de surbrillance sur les cartes */
    .card-highlight {
        position: relative;
        overflow: hidden;
    }
    
    .card-highlight::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.7s;
    }
    
    .card-highlight:hover::before {
        left: 100%;
    }
    
    /* Animation pour le badge */
    @keyframes pulse-subtle {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }
    
    .animate-pulse {
        animation: pulse-subtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endpush