@extends('layouts.guest')
@section('title', 'Langues du Bénin')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1456513073567-0d6a9c5f2e8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-green-800/60"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-20 left-10 w-72 h-72 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-400/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <i class="fas fa-language text-green-300"></i>
                    <span class="text-sm font-medium">Diversité Linguistique</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">Les Langues du</span>
                    <span class="block text-green-300">Bénin</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    Découvrez la richesse linguistique exceptionnelle du pays avec plus de 50 langues vivantes, 
                    témoins de la diversité culturelle et historique de notre patrimoine.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8 animate-fade-in delay-200">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-users text-green-300 mr-2"></i>
                        <span class="text-sm">12 langues nationales</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-map-marker-alt text-green-300 mr-2"></i>
                        <span class="text-sm">8 familles linguistiques</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-volume-up text-green-300 mr-2"></i>
                        <span class="text-sm">Oralité préservée</span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Vague décorative --}}
        <div class="absolute bottom-0 left-0 right-0 z-10">
            <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org2000/svg">
                <path d="M0 120L60 100C120 80 240 40 360 30C480 20 600 40 720 50C840 60 960 60 1080 45C1200 30 1320 0 1380 0H1440V120H0Z" 
                      fill="white"/>
            </svg>
        </div>
    </section>

    {{-- INTRODUCTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">Un Patrimoine Linguistique Unique</h2>
                <p class="text-secondary-600 text-lg max-w-3xl mx-auto">
                    Le Bénin est un véritable trésor linguistique où coexistent harmonieusement langues nationales, 
                    régionales et locales. Chaque langue raconte une histoire, porte une culture et véhicule un savoir ancestral.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-green-50 to-green-100/50 border border-green-200 animate-slide-up">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-book text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary-900 mb-3">Langues Nationales</h3>
                    <p class="text-secondary-600">12 langues officiellement reconnues dont le Fon, le Yoruba, le Goun et le Dendi</p>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-teal-50 to-teal-100/50 border border-teal-200 animate-slide-up delay-100">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-comments text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary-900 mb-3">Usage Quotidien</h3>
                    <p class="text-secondary-600">Plus de 80% de la population utilise quotidiennement une langue nationale</p>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100/50 border border-amber-200 animate-slide-up delay-200">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-amber-500 to-amber-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-history text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary-900 mb-3">Transmission Orale</h3>
                    <p class="text-secondary-600">Tradition orale vivante à travers contes, proverbes et expressions culturelles</p>
                </div>
            </div>
        </div>
    </section>

    {{-- LISTE DES LANGUES --}}
    <section class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-4 heading-font">Explorez les Langues</h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Découvrez la diversité linguistique à travers nos fiches détaillées pour chaque langue
                </p>
            </div>
            
            {{-- Filtres --}}
            <div class="mb-10 animate-fade-in">
                <div class="flex flex-wrap gap-3 justify-center">
                    <button class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full font-medium hover:from-green-600 hover:to-green-700 transition-all shadow-md">
                        Toutes les langues
                    </button>
                    <button class="px-5 py-2.5 bg-white text-secondary-700 rounded-full font-medium hover:bg-green-50 hover:text-green-700 border border-secondary-200 transition-all">
                        Langues nationales
                    </button>
                    <button class="px-5 py-2.5 bg-white text-secondary-700 rounded-full font-medium hover:bg-teal-50 hover:text-teal-700 border border-secondary-200 transition-all">
                        Langues régionales
                    </button>
                    <button class="px-5 py-2.5 bg-white text-secondary-700 rounded-full font-medium hover:bg-amber-50 hover:text-amber-700 border border-secondary-200 transition-all">
                        Langues locales
                    </button>
                </div>
            </div>
            
            {{-- Grille des langues --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($langues as $langue)
                    <div class="group animate-fade-in-up">
                        <x-language.language-card :langue="$langue" />
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 animate-fade-in">
                        <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-language text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary-800 mb-3">Aucune langue disponible</h3>
                        <p class="text-secondary-600 mb-6">Les langues seront bientôt ajoutées à la plateforme</p>
                        <a href="{{ route('devenir-contributeur') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            <i class="fas fa-user-plus mr-2"></i>
                            Devenir contributeur pour ajouter des langues
                        </a>
                    </div>
                @endforelse
            </div>
            
            {{-- Pagination si nécessaire --}}
            @if($langues instanceof \Illuminate\Pagination\LengthAwarePaginator && $langues->hasPages())
                <div class="mt-12 animate-fade-in">
                    {{ $langues->links('vendor.pagination.tailwind') }}
                </div>
            @endif
            
            {{-- CTA --}}
            <div class="mt-16 text-center animate-fade-in">
                <div class="inline-flex flex-col items-center p-8 bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl border border-green-200 max-w-2xl mx-auto">
                    <div class="w-16 h-16 mb-6 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-microphone-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-3">Contribuez à la préservation</h3>
                    <p class="text-secondary-600 mb-6 max-w-lg">
                        Aidez-nous à documenter et préserver les langues du Bénin en partageant vos connaissances, 
                        enregistrements audio et traductions.
                    </p>
                    <a href="{{ route('devenir-contributeur') }}" 
                       class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-full hover:from-green-600 hover:to-green-700 hover:shadow-xl hover:scale-105 transition-all duration-300 group shadow-lg">
                        <i class="fas fa-plus-circle mr-3"></i>
                        Proposer une nouvelle langue
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- STATISTIQUES LINGUISTIQUES --}}
    <section class="py-16 bg-gradient-to-br from-secondary-900 to-secondary-800 text-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 heading-font">Chiffres Clés</h2>
                <p class="text-secondary-300 max-w-2xl mx-auto">
                    Quelques statistiques sur la diversité linguistique au Bénin
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up">
                    <div class="text-4xl font-bold text-green-300 mb-2">50+</div>
                    <div class="text-sm text-secondary-300">Langues parlées</div>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-100">
                    <div class="text-4xl font-bold text-teal-300 mb-2">12</div>
                    <div class="text-sm text-secondary-300">Langues nationales</div>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-200">
                    <div class="text-4xl font-bold text-amber-300 mb-2">8</div>
                    <div class="text-sm text-secondary-300">Familles linguistiques</div>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-2xl backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-300">
                    <div class="text-4xl font-bold text-purple-300 mb-2">85%</div>
                    <div class="text-sm text-secondary-300">Usage quotidien</div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />

@endsection

@push('styles')
<style>
    /* Animation pour les cartes de langues */
    .language-card-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .language-card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(22, 163, 74, 0.15);
    }
    
    /* Animation des badges de statistiques */
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
    
    /* Style pour le composant language-card */
    .language-flag {
        position: relative;
        overflow: hidden;
    }
    
    .language-flag::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #16a34a, #0d9488, #059669);
    }
</style>
@endpush

@push('scripts')
<script>
    // Animation des chiffres
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll pour les éléments
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
                
                // Ici, tu pourrais ajouter la logique de filtrage AJAX
                console.log('Filtre activé:', this.textContent.trim());
            });
        });
        
        // Animation pour les cartes de langue
        const languageCards = document.querySelectorAll('.group');
        languageCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 100}ms`;
        });
    });
</script>
@endpush