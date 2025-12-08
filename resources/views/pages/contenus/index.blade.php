@extends('layouts.guest')
@section('title', 'Tous les contenus')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond --}}
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-green-800/60"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-20 left-10 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
            
            {{-- Icônes culturelles en arrière-plan --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <div class="grid grid-cols-4 gap-12">
                    <i class="fas fa-book-open text-[10vw]"></i>
                    <i class="fas fa-music text-[10vw]"></i>
                    <i class="fas fa-palette text-[10vw]"></i>
                    <i class="fas fa-mask text-[10vw]"></i>
                </div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <i class="fas fa-book-open text-green-300"></i>
                    <span class="text-sm font-medium">Patrimoine Immatériel</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">Tous les Contenus</span>
                    <span class="block text-green-300">Culturels</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    Explorez la richesse du patrimoine béninois à travers des milliers de contenus validés : 
                    histoires, musiques, arts, traditions et savoirs ancestraux.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8 animate-fade-in delay-200">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-book text-green-300 mr-2"></i>
                        <span class="text-sm">{{ $contenus->total() }} contenus</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-language text-green-300 mr-2"></i>
                        <span class="text-sm">Multilingues</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-users text-green-300 mr-2"></i>
                        <span class="text-sm">Contributions communautaires</span>
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

    {{-- FILTRES ET RECHERCHE --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Filtres latéraux --}}
                <div class="lg:w-1/4 animate-fade-in">
                    <div class="bg-gradient-to-b from-green-50 to-white rounded-2xl shadow-lg p-6 border border-green-100 sticky top-24">
                        <h3 class="text-xl font-bold text-secondary-900 mb-6 pb-4 border-b border-secondary-100 heading-font">
                            <i class="fas fa-filter text-green-600 mr-2"></i>
                            Filtrer les contenus
                        </h3>
                        
                        {{-- Recherche --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Rechercher</label>
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Titre, auteur, mot-clé..." 
                                       class="w-full pl-10 pr-4 py-2.5 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-green-500/30 focus:border-green-400 transition-all duration-300 outline-none">
                                <i class="fas fa-search absolute left-3 top-3 text-secondary-400"></i>
                            </div>
                        </div>
                        
                        {{-- Filtre par type --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Type de contenu</label>
                            <div class="space-y-2">
                                @foreach([
                                    ['icon' => 'fas fa-book-open', 'label' => 'Histoires & Récits', 'count' => 42],
                                    ['icon' => 'fas fa-music', 'label' => 'Musique & Danse', 'count' => 28],
                                    ['icon' => 'fas fa-palette', 'label' => 'Arts Visuels', 'count' => 35],
                                    ['icon' => 'fas fa-utensils', 'label' => 'Cuisine & Recettes', 'count' => 19],
                                    ['icon' => 'fas fa-mask', 'label' => 'Fêtes & Cérémonies', 'count' => 31],
                                    ['icon' => 'fas fa-language', 'label' => 'Langues & Dialectes', 'count' => 27]
                                ] as $type)
                                <label class="flex items-center justify-between cursor-pointer p-2 hover:bg-green-50 rounded-lg transition-colors">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded border-secondary-300 text-green-600 focus:ring-green-500">
                                        <span class="ml-3 text-sm text-secondary-600">{{ $type['label'] }}</span>
                                    </div>
                                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">{{ $type['count'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Filtre par langue --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Langue</label>
                            <div class="space-y-2">
                                @foreach([
                                    ['code' => 'fr', 'label' => 'Français', 'count' => 156],
                                    ['code' => 'fon', 'label' => 'Fon', 'count' => 89],
                                    ['code' => 'yor', 'label' => 'Yoruba', 'count' => 67],
                                    ['code' => 'dje', 'label' => 'Dendi', 'count' => 42],
                                    ['code' => 'goun', 'label' => 'Goun', 'count' => 38]
                                ] as $lang)
                                <label class="flex items-center justify-between cursor-pointer p-2 hover:bg-green-50 rounded-lg transition-colors">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded border-secondary-300 text-green-600 focus:ring-green-500">
                                        <span class="ml-3 text-sm text-secondary-600">{{ $lang['label'] }}</span>
                                    </div>
                                    <span class="text-xs bg-secondary-100 text-secondary-700 px-2 py-1 rounded-full">{{ $lang['count'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Filtre par région --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Région</label>
                            <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                                @foreach([
                                    ['label' => 'Toutes les régions', 'count' => $contenus->total()],
                                    ['label' => 'Zou', 'count' => 45],
                                    ['label' => 'Atlantique', 'count' => 38],
                                    ['label' => 'Littoral', 'count' => 32],
                                    ['label' => 'Borgou', 'count' => 29],
                                    ['label' => 'Alibori', 'count' => 26],
                                    ['label' => 'Collines', 'count' => 24],
                                    ['label' => 'Plateau', 'count' => 22],
                                    ['label' => 'Ouémé', 'count' => 21],
                                    ['label' => 'Mono', 'count' => 19],
                                    ['label' => 'Couffo', 'count' => 18],
                                    ['label' => 'Donga', 'count' => 17],
                                    ['label' => 'Atacora', 'count' => 16]
                                ] as $region)
                                <label class="flex items-center justify-between cursor-pointer p-2 hover:bg-green-50 rounded-lg transition-colors">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded border-secondary-300 text-green-600 focus:ring-green-500">
                                        <span class="ml-3 text-sm text-secondary-600">{{ $region['label'] }}</span>
                                    </div>
                                    <span class="text-xs bg-secondary-100 text-secondary-700 px-2 py-1 rounded-full">{{ $region['count'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Boutons d'action --}}
                        <div class="space-y-3">
                            <button class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                                <i class="fas fa-check mr-2"></i>
                                Appliquer les filtres
                            </button>
                            <button class="w-full border-2 border-green-500 text-green-600 py-3 rounded-xl font-bold hover:bg-green-50 transition-all duration-300">
                                <i class="fas fa-redo mr-2"></i>
                                Réinitialiser
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Contenu principal --}}
                <div class="lg:w-3/4">
                    {{-- En-tête avec options --}}
                    <div class="flex flex-col md:flex-row justify-between items-center mb-10 animate-fade-in">
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 heading-font">
                                {{ $contenus->total() }} Contenus Culturels
                            </h2>
                            <p class="text-secondary-600 mt-2">
                                Découvrez les trésors du patrimoine béninois
                            </p>
                        </div>
                        
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <div class="flex bg-green-50 rounded-xl p-1">
                                <button class="px-4 py-2 rounded-lg bg-white shadow text-secondary-900 font-medium">
                                    <i class="fas fa-th-large mr-2"></i> Grille
                                </button>
                                <button class="px-4 py-2 rounded-lg text-secondary-600 hover:text-secondary-900">
                                    <i class="fas fa-list mr-2"></i> Liste
                                </button>
                            </div>
                            <select class="border border-secondary-200 rounded-xl px-4 py-2.5 text-secondary-700 focus:ring-2 focus:ring-green-500/30 focus:border-green-400 outline-none">
                                <option value="recent">Plus récents</option>
                                <option value="popular">Plus populaires</option>
                                <option value="commented">Plus commentés</option>
                                <option value="liked">Plus aimés</option>
                            </select>
                        </div>
                    </div>
                    
                    {{-- Statistiques rapides --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10 animate-fade-in">
                        <div class="bg-gradient-to-br from-green-50 to-green-100/50 rounded-xl p-4 border border-green-200">
                            <div class="text-2xl font-bold text-green-600 mb-1">{{ $contenus->total() }}</div>
                            <div class="text-sm text-secondary-600">Total contenus</div>
                        </div>
                        <div class="bg-gradient-to-br from-teal-50 to-teal-100/50 rounded-xl p-4 border border-teal-200">
                            <div class="text-2xl font-bold text-teal-600 mb-1">6</div>
                            <div class="text-sm text-secondary-600">Catégories</div>
                        </div>
                        <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-xl p-4 border border-amber-200">
                            <div class="text-2xl font-bold text-amber-600 mb-1">12</div>
                            <div class="text-sm text-secondary-600">Régions couvertes</div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-xl p-4 border border-purple-200">
                            <div class="text-2xl font-bold text-purple-600 mb-1">5+</div>
                            <div class="text-sm text-secondary-600">Langues</div>
                        </div>
                    </div>
                    
                    {{-- Liste des contenus --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($contenus as $contenu)
                            <div class="group animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                                <x-content.content-card :contenu="$contenu" />
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16 animate-fade-in">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-book-open text-green-600 text-3xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-secondary-800 mb-3">Aucun contenu disponible</h3>
                                <p class="text-secondary-600 mb-6">Les contenus seront bientôt ajoutés à la plateforme</p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="{{ route('devenir-contributeur') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Devenir contributeur
                                    </a>
                                    <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                        <i class="fas fa-bell mr-2"></i>
                                        Être notifié des nouveautés
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    {{-- Pagination --}}
                    @if($contenus->hasPages())
                        <div class="mt-12 animate-fade-in">
                            {{ $contenus->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                    
                    {{-- Appel à contribution --}}
                    <div class="mt-16 pt-12 border-t border-secondary-100">
                        <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl p-8 border-2 border-dashed border-green-300 animate-fade-in">
                            <div class="flex flex-col md:flex-row items-center gap-8">
                                <div class="md:w-2/3 text-center md:text-left">
                                    <h3 class="text-2xl font-bold text-secondary-900 mb-4 heading-font">Partagez vos connaissances culturelles</h3>
                                    <p class="text-secondary-600 mb-6">
                                        Vous avez une histoire à raconter, une recette traditionnelle, une chanson ou une danse à partager ? 
                                        Contribuez à enrichir le patrimoine culturel du Bénin en publiant votre contenu.
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
                                            Publier un contenu
                                        </a>
                                    </div>
                                </div>
                                <div class="md:w-1/3 text-center">
                                    <div class="w-32 h-32 mx-auto bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-2xl">
                                        <i class="fas fa-feather-alt text-white text-4xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CATÉGORIES POPULAIRES --}}
    <section class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">Explorez par Catégorie</h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Découvrez les différentes facettes de la culture béninoise à travers nos collections thématiques
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach([
                    ['icon' => 'fas fa-book-open', 'label' => 'Histoires', 'color' => 'green', 'count' => 42],
                    ['icon' => 'fas fa-music', 'label' => 'Musique', 'color' => 'teal', 'count' => 28],
                    ['icon' => 'fas fa-palette', 'label' => 'Arts', 'color' => 'amber', 'count' => 35],
                    ['icon' => 'fas fa-utensils', 'label' => 'Cuisine', 'color' => 'red', 'count' => 19],
                    ['icon' => 'fas fa-mask', 'label' => 'Fêtes', 'color' => 'purple', 'count' => 31],
                    ['icon' => 'fas fa-language', 'label' => 'Langues', 'color' => 'blue', 'count' => 27]
                ] as $category)
                <a href="{{ route('contenus.index') }}?type={{ strtolower($category['label']) }}"
                   class="group bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-secondary-100 animate-fade-in-up">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-{{ $category['color'] }}-500 to-{{ $category['color'] }}-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                        <i class="{{ $category['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-secondary-900 mb-2">{{ $category['label'] }}</h3>
                    <div class="text-sm text-secondary-600">{{ $category['count'] }} contenus</div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />
@endsection

@push('styles')
<style>
    /* Animation pour les cartes de contenu */
    .content-card-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .content-card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(22, 163, 74, 0.15);
    }
    
    /* Style pour les filtres */
    .filter-section {
        scrollbar-width: thin;
        scrollbar-color: #16a34a #f0fdf4;
    }
    
    .filter-section::-webkit-scrollbar {
        width: 6px;
    }
    
    .filter-section::-webkit-scrollbar-track {
        background: #f0fdf4;
        border-radius: 3px;
    }
    
    .filter-section::-webkit-scrollbar-thumb {
        background: #16a34a;
        border-radius: 3px;
    }
    
    /* Animation pour les catégories */
    @keyframes float-subtle {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    .animate-float {
        animation: float-subtle 3s ease-in-out infinite;
    }
    
    /* Style pour les badges de comptage */
    .count-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-weight: 500;
    }
    
    /* Effet de surbrillance sur les options de filtre */
    .filter-option {
        transition: all 0.2s ease;
    }
    
    .filter-option:hover {
        background-color: #f0fdf4;
        transform: translateX(4px);
    }
</style>
@endpush

@push('scripts')
<script>
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
        
        // Gestion des filtres
        const filterCheckboxes = document.querySelectorAll('input[type="checkbox"]');
        const applyFiltersBtn = document.querySelector('button:contains("Appliquer les filtres")');
        const resetFiltersBtn = document.querySelector('button:contains("Réinitialiser")');
        
        if (applyFiltersBtn) {
            applyFiltersBtn.addEventListener('click', function() {
                const selectedFilters = Array.from(filterCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.nextElementSibling?.textContent || cb.parentElement?.textContent);
                
                console.log('Filtres appliqués:', selectedFilters);
                // Ici, tu pourrais ajouter la logique AJAX pour filtrer les contenus
            });
        }
        
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function() {
                filterCheckboxes.forEach(cb => cb.checked = false);
                console.log('Filtres réinitialisés');
                // Ici, tu pourrais ajouter la logique AJAX pour réinitialiser
            });
        }
        
        // Recherche en temps réel
        const searchInput = document.querySelector('input[placeholder="Titre, auteur, mot-clé..."]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = this.value;
                    console.log('Recherche:', searchTerm);
                    // Ici, tu pourrais ajouter la logique de recherche AJAX
                }, 300);
            });
        }
        
        // Tri des contenus
        const sortSelect = document.querySelector('select');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const sortValue = this.value;
                console.log('Tri par:', sortValue);
                // Ici, tu pourrais ajouter la logique AJAX pour trier
            });
        }
        
        // Navigation entre vue grille/liste
        const viewButtons = document.querySelectorAll('.flex.bg-green-50 button');
        viewButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                viewButtons.forEach(btn => {
                    btn.classList.remove('bg-white', 'shadow', 'text-secondary-900');
                    btn.classList.add('text-secondary-600', 'hover:text-secondary-900');
                });
                this.classList.remove('text-secondary-600', 'hover:text-secondary-900');
                this.classList.add('bg-white', 'shadow', 'text-secondary-900');
                
                // Changer la vue
                const contentGrid = document.querySelector('.grid.grid-cols-1');
                if (contentGrid) {
                    if (index === 0) {
                        // Vue grille
                        contentGrid.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
                    } else {
                        // Vue liste
                        contentGrid.className = 'grid grid-cols-1 gap-6';
                        document.querySelectorAll('.content-card').forEach(card => {
                            card.classList.add('md:flex-row');
                            card.classList.remove('flex-col');
                        });
                    }
                }
            });
        });
    });
    
    // Fonction pour charger plus de contenus (infinite scroll)
    let isLoading = false;
    let page = 1;
    
    function loadMoreContents() {
        if (isLoading) return;
        
        isLoading = true;
        page++;
        
        // Simuler un chargement AJAX
        console.log('Chargement page', page);
        
        // Ici, tu pourrais faire une requête AJAX pour charger plus de contenus
        // fetch(`/contenus?page=${page}`)
        //   .then(response => response.json())
        //   .then(data => {
        //       // Ajouter les nouveaux contenus au DOM
        //       isLoading = false;
        //   });
        
        setTimeout(() => {
            isLoading = false;
        }, 1000);
    }
    
    // Détecter le scroll pour le chargement infini
    window.addEventListener('scroll', function() {
        const scrollPosition = window.innerHeight + window.scrollY;
        const documentHeight = document.documentElement.scrollHeight;
        
        if (scrollPosition >= documentHeight - 500 && !isLoading) {
            loadMoreContents();
        }
    });
</script>
@endpush