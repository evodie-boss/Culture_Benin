@extends('layouts.guest')
@section('title', 'Galeries & Arts - Culture Bénin')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond --}}
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1517248135467-197e66b9745d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-green-800/60"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-20 left-10 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
            
            {{-- Motif de galerie en arrière-plan --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <div class="grid grid-cols-4 gap-8">
                    @for($i = 0; $i < 8; $i++)
                        <div class="w-16 h-16 md:w-20 md:h-20 border-2 border-white/20 rounded-lg"></div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <i class="fas fa-images text-green-300"></i>
                    <span class="text-sm font-medium">Patrimoine Visuel</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">Galeries & Arts</span>
                    <span class="block text-green-300">du Bénin</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    Découvrez la richesse visuelle du patrimoine béninois à travers des photos, 
                    œuvres d'art, artisanat traditionnel et scènes de vie quotidienne.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8 animate-fade-in delay-200">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-camera text-green-300 mr-2"></i>
                        <span class="text-sm">{{ $photos->total() ?? '0' }} photos</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-palette text-green-300 mr-2"></i>
                        <span class="text-sm">Arts traditionnels</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-hands-helping text-green-300 mr-2"></i>
                        <span class="text-sm">Artisanat local</span>
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

    {{-- CATÉGORIES D'IMAGES --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">Explorez par Thème</h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Naviguez à travers les différentes facettes visuelles de la culture béninoise
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                @foreach([
                    ['icon' => 'fas fa-landmark', 'label' => 'Architecture', 'count' => 42, 'color' => 'green'],
                    ['icon' => 'fas fa-users', 'label' => 'Portraits', 'count' => 38, 'color' => 'teal'],
                    ['icon' => 'fas fa-utensils', 'label' => 'Artisanat', 'count' => 35, 'color' => 'amber'],
                    ['icon' => 'fas fa-leaf', 'label' => 'Nature', 'count' => 29, 'color' => 'emerald'],
                    ['icon' => 'fas fa-music', 'label' => 'Cérémonies', 'count' => 31, 'color' => 'purple'],
                    ['icon' => 'fas fa-paint-brush', 'label' => 'Arts', 'count' => 27, 'color' => 'pink'],
                    ['icon' => 'fas fa-city', 'label' => 'Vie urbaine', 'count' => 24, 'color' => 'blue'],
                    ['icon' => 'fas fa-water', 'label' => 'Paysages', 'count' => 33, 'color' => 'cyan']
                ] as $category)
                <a href="#gallery-{{ Str::slug($category['label']) }}"
                   class="group bg-gradient-to-b from-white to-green-50 rounded-xl p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-green-100 animate-fade-in-up">
                    <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-{{ $category['color'] }}-500 to-{{ $category['color'] }}-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="{{ $category['icon'] }} text-white"></i>
                    </div>
                    <div class="font-medium text-secondary-900 mb-1">{{ $category['label'] }}</div>
                    <div class="text-xs text-secondary-600">{{ $category['count'] }} images</div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALERIE PRINCIPALE --}}
    <section class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            {{-- En-tête avec filtres --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 animate-fade-in">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 heading-font">
                        Galerie Photo
                    </h2>
                    <p class="text-secondary-600 mt-2">
                        {{ $photos->total() ?? '0' }} trésors visuels à découvrir
                    </p>
                </div>
                
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <div class="flex bg-green-50 rounded-xl p-1">
                        <button class="px-4 py-2 rounded-lg bg-white shadow text-secondary-900 font-medium">
                            <i class="fas fa-th-large mr-2"></i> Grille
                        </button>
                        <button class="px-4 py-2 rounded-lg text-secondary-600 hover:text-secondary-900">
                            <i class="fas fa-masonry mr-2"></i> Masonry
                        </button>
                    </div>
                    <select class="border border-secondary-200 rounded-xl px-4 py-2.5 text-secondary-700 focus:ring-2 focus:ring-green-500/30 focus:border-green-400 outline-none">
                        <option value="recent">Plus récentes</option>
                        <option value="popular">Plus populaires</option>
                        <option value="oldest">Plus anciennes</option>
                    </select>
                </div>
            </div>
            
            {{-- Galerie d'images --}}
            @if($photos->count() > 0)
                <div class="animate-fade-in">
                    <x-gallery.gallery-grid :photos="$photos" />
                </div>
                
                {{-- Pagination --}}
                @if($photos->hasPages())
                    <div class="mt-12 animate-fade-in">
                        {{ $photos->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            @else
                <div class="text-center py-20 animate-fade-in">
                    <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-images text-green-600 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-800 mb-3">Aucune photo disponible</h3>
                    <p class="text-secondary-600 mb-6">La galerie sera bientôt enrichie avec de nouvelles images</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('devenir-contributeur') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            <i class="fas fa-user-plus mr-2"></i>
                            Devenir contributeur
                        </a>
                        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            <i class="fas fa-upload mr-2"></i>
                            Proposer des photos
                        </a>
                    </div>
                </div>
            @endif
            
            {{-- Galeries thématiques --}}
            <div class="mt-20 pt-12 border-t border-secondary-100">
                <div class="text-center mb-12 animate-fade-in">
                    <h3 class="text-2xl md:text-3xl font-bold text-secondary-900 mb-4 heading-font">Galeries Thématiques</h3>
                    <p class="text-secondary-600 max-w-2xl mx-auto">
                        Découvrez des collections spéciales organisées par thème
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach([
                        ['title' => 'Artisanat Traditionnel', 'count' => 24, 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                        ['title' => 'Costumes & Parures', 'count' => 18, 'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                        ['title' => 'Marchés Locaux', 'count' => 32, 'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']
                    ] as $gallery)
                    <a href="#" 
                       class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 animate-slide-up">
                        <div class="aspect-[4/3]">
                            <img src="{{ $gallery['image'] }}" alt="{{ $gallery['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h4 class="text-xl font-bold mb-2">{{ $gallery['title'] }}</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-sm opacity-90">{{ $gallery['count'] }} photos</span>
                                <span class="text-green-300 group-hover:text-green-200 transition-colors">
                                    Voir la galerie <i class="fas fa-arrow-right ml-1"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CONTRIBUTION --}}
    <section class="py-16 bg-gradient-to-br from-secondary-900 to-secondary-800 text-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 heading-font">Partagez vos photos</h2>
                <p class="text-secondary-300 max-w-2xl mx-auto">
                    Contribuez à enrichir le patrimoine visuel du Bénin en partageant vos photos
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up">
                    <div class="flex items-start mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-upload text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Envoyer des photos</h3>
                            <p class="text-secondary-300">
                                Partagez vos plus belles photos du Bénin pour enrichir notre galerie communautaire
                            </p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center text-sm">
                            <i class="fas fa-check text-green-400 mr-3 w-5"></i>
                            <span>Formats acceptés : JPG, PNG, WebP</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i class="fas fa-check text-green-400 mr-3 w-5"></i>
                            <span>Résolution minimum : 1200x800px</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i class="fas fa-check text-green-400 mr-3 w-5"></i>
                            <span>Poids maximum : 10MB par image</span>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center justify-center w-full mt-6 bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 transition-all">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                        Téléverser des photos
                    </a>
                </div>
                
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 animate-slide-up delay-100">
                    <div class="flex items-start mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-award text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Concours photo mensuel</h3>
                            <p class="text-secondary-300">
                                Participez à notre concours et gagnez des prix en partageant vos plus belles photos
                            </p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-secondary-300">Prochain concours :</span>
                            <span class="font-bold text-green-300">« Scènes de marché »</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-secondary-300">Date limite :</span>
                            <span class="font-medium">15 {{ now()->addMonth()->translatedFormat('F') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-secondary-300">Prix à gagner :</span>
                            <span class="font-medium text-amber-300">3 prix</span>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center justify-center w-full mt-6 border-2 border-teal-500 text-teal-300 py-3 rounded-xl font-bold hover:bg-teal-500/10 transition-all">
                        <i class="fas fa-trophy mr-2"></i>
                        Participer au concours
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- GUIDE PHOTOGRAPHIQUE --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">Conseils pour de belles photos</h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Quelques astuces pour capturer au mieux la beauté du Bénin
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-b from-green-50 to-white rounded-2xl p-6 border border-green-100 hover:shadow-lg transition-all duration-300 animate-fade-in-up">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-sun text-white"></i>
                    </div>
                    <h4 class="font-bold text-secondary-900 mb-3">Lumière naturelle</h4>
                    <p class="text-secondary-600 text-sm">
                        Profitez des golden hours (lever et coucher du soleil) pour des photos chaleureuses
                    </p>
                </div>
                
                <div class="bg-gradient-to-b from-green-50 to-white rounded-2xl p-6 border border-green-100 hover:shadow-lg transition-all duration-300 animate-fade-in-up delay-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-user-friends text-white"></i>
                    </div>
                    <h4 class="font-bold text-secondary-900 mb-3">Respect des personnes</h4>
                    <p class="text-secondary-600 text-sm">
                        Demandez toujours la permission avant de photographier des personnes
                    </p>
                </div>
                
                <div class="bg-gradient-to-b from-green-50 to-white rounded-2xl p-6 border border-green-100 hover:shadow-lg transition-all duration-300 animate-fade-in-up delay-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-history text-white"></i>
                    </div>
                    <h4 class="font-bold text-secondary-900 mb-3">Patrimoine authentique</h4>
                    <p class="text-secondary-600 text-sm">
                        Capturer la culture dans son authenticité, sans mise en scène artificielle
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />
@endsection

@push('styles')
<style>
    /* Style pour la galerie masonry */
    .masonry-grid {
        column-count: 3;
        column-gap: 1rem;
    }
    
    .masonry-item {
        break-inside: avoid;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .masonry-grid {
            column-count: 2;
        }
    }
    
    @media (max-width: 640px) {
        .masonry-grid {
            column-count: 1;
        }
    }
    
    /* Animation pour les images de galerie */
    .gallery-image {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-image:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    /* Overlay sur les images */
    .image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        padding: 1rem;
    }
    
    .gallery-image:hover .image-overlay {
        opacity: 1;
    }
    
    /* Style pour les catégories */
    .category-card {
        transition: all 0.3s ease;
    }
    
    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(22, 163, 74, 0.15);
    }
    
    /* Animation pour les galeries thématiques */
    .theme-gallery {
        position: relative;
        overflow: hidden;
    }
    
    .theme-gallery::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.7s;
    }
    
    .theme-gallery:hover::before {
        left: 100%;
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
        
        // Navigation entre les vues grille/masonry
        const viewButtons = document.querySelectorAll('.flex.bg-green-50 button');
        viewButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                viewButtons.forEach(btn => {
                    btn.classList.remove('bg-white', 'shadow', 'text-secondary-900');
                    btn.classList.add('text-secondary-600', 'hover:text-secondary-900');
                });
                this.classList.remove('text-secondary-600', 'hover:text-secondary-900');
                this.classList.add('bg-white', 'shadow', 'text-secondary-900');
                
                const galleryGrid = document.querySelector('.gallery-grid');
                if (galleryGrid) {
                    if (index === 0) {
                        // Vue grille
                        galleryGrid.classList.remove('masonry-grid');
                        console.log('Vue grille activée');
                    } else {
                        // Vue masonry
                        galleryGrid.classList.add('masonry-grid');
                        console.log('Vue masonry activée');
                    }
                }
            });
        });
        
        // Tri des photos
        const sortSelect = document.querySelector('select');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const sortValue = this.value;
                console.log('Tri par:', sortValue);
                // Ici, tu pourrais ajouter la logique AJAX pour trier
            });
        }
        
        // Filtrage par catégorie
        const categoryLinks = document.querySelectorAll('a[href^="#gallery-"]');
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.getAttribute('href').replace('#gallery-', '');
                console.log('Filtrer par catégorie:', category);
                
                // Mettre en surbrillance la catégorie sélectionnée
                categoryLinks.forEach(l => l.classList.remove('bg-green-100', 'border-green-300'));
                this.classList.add('bg-green-100', 'border-green-300');
                
                // Ici, tu pourrais ajouter la logique AJAX pour filtrer
            });
        });
        
        // Lightbox pour les images de galerie
        const galleryImages = document.querySelectorAll('.gallery-image');
        galleryImages.forEach(img => {
            img.addEventListener('click', function(e) {
                if (this.tagName === 'A') return; // Si c'est déjà un lien
                
                e.preventDefault();
                const imageUrl = this.querySelector('img')?.src;
                const imageAlt = this.querySelector('img')?.alt;
                
                if (imageUrl) {
                    openLightbox(imageUrl, imageAlt);
                }
            });
        });
        
        function openLightbox(imageUrl, imageAlt) {
            const lightbox = document.createElement('div');
            lightbox.className = 'fixed inset-0 bg-black/90 flex items-center justify-center z-50 p-4 animate-fade-in';
            lightbox.innerHTML = `
                <div class="relative max-w-6xl w-full max-h-[90vh]">
                    <button onclick="this.closest('.fixed').remove()" 
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                    <img src="${imageUrl}" alt="${imageAlt || 'Image galerie'}" 
                         class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
                    ${imageAlt ? `
                    <div class="mt-4 text-center">
                        <p class="text-white text-lg">${imageAlt}</p>
                    </div>` : ''}
                </div>
            `;
            document.body.appendChild(lightbox);
        }
    });
    
    // Simulation de chargement progressif des images
    function lazyLoadImages() {
        const images = document.querySelectorAll('img[data-src]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('opacity-100');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => observer.observe(img));
    }
    
    // Démarrer le lazy loading après le chargement de la page
    window.addEventListener('load', lazyLoadImages);
</script>
@endpush