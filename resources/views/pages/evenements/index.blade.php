@extends('layouts.guest')
@section('title', 'Événements - Culture Bénin')

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond --}}
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-green-800/60"></div>
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-20 left-10 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
            
            {{-- Calendrier stylisé en arrière-plan --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-10">
                <div class="grid grid-cols-7 gap-4 p-8">
                    @for($i = 1; $i <= 31; $i++)
                        <div class="w-8 h-8 md:w-10 md:h-10 border border-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-xs md:text-sm">{{ $i }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    <i class="fas fa-calendar-alt text-green-300"></i>
                    <span class="text-sm font-medium">Vie Culturelle</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    <span class="block">Calendrier Culturel</span>
                    <span class="block text-green-300">du Bénin</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto animate-fade-in delay-100">
                    Découvrez les fêtes traditionnelles, festivals, cérémonies et événements culturels 
                    qui rythment la vie des différentes régions du pays.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4 mb-8 animate-fade-in delay-200">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-music text-green-300 mr-2"></i>
                        <span class="text-sm">Festivals musicaux</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-mask text-green-300 mr-2"></i>
                        <span class="text-sm">Cérémonies traditionnelles</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                        <i class="fas fa-utensils text-green-300 mr-2"></i>
                        <span class="text-sm">Fêtes gastronomiques</span>
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

    {{-- FILTRES ET CALENDRIER --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                {{-- Filtres --}}
                <div class="lg:w-1/4 w-full animate-fade-in">
                    <div class="bg-gradient-to-b from-green-50 to-white rounded-2xl shadow-lg p-6 border border-green-100 sticky top-24">
                        <h3 class="text-xl font-bold text-secondary-900 mb-6 pb-4 border-b border-secondary-100 heading-font">
                            <i class="fas fa-filter text-green-600 mr-2"></i>
                            Filtres
                        </h3>
                        
                        {{-- Recherche --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Rechercher</label>
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Nom de l'événement..." 
                                       class="w-full pl-10 pr-4 py-2.5 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-green-500/30 focus:border-green-400 transition-all duration-300 outline-none">
                                <i class="fas fa-search absolute left-3 top-3 text-secondary-400"></i>
                            </div>
                        </div>
                        
                        {{-- Filtre par mois --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Par mois</label>
                            <div class="space-y-2">
                                @php
                                    $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                                @endphp
                                @foreach($months as $index => $month)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" class="rounded border-secondary-300 text-green-600 focus:ring-green-500">
                                        <span class="ml-3 text-sm text-secondary-600">{{ $month }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Filtre par région --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Par région</label>
                            <div class="space-y-2">
                                @foreach(['Toutes les régions', 'Atlantique', 'Littoral', 'Borgou', 'Alibori', 'Collines', 'Zou', 'Plateau', 'Ouémé', 'Mono', 'Couffo', 'Donga', 'Atacora'] as $region)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" class="rounded border-secondary-300 text-green-600 focus:ring-green-500">
                                        <span class="ml-3 text-sm text-secondary-600">{{ $region }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Bouton appliquer --}}
                        <button class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                            <i class="fas fa-check mr-2"></i>
                            Appliquer les filtres
                        </button>
                    </div>
                </div>
                
                {{-- Contenu principal --}}
                <div class="lg:w-3/4 w-full">
                    {{-- En-tête avec options d'affichage --}}
                    <div class="flex flex-col md:flex-row justify-between items-center mb-10 animate-fade-in">
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 heading-font">
                                Prochains événements
                            </h2>
                            <p class="text-secondary-600 mt-2">
                                Découvrez les {{ $events->count() }} prochains événements culturels
                            </p>
                        </div>
                        
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <div class="flex bg-green-50 rounded-xl p-1">
                                <button class="px-4 py-2 rounded-lg bg-white shadow text-secondary-900 font-medium">
                                    <i class="fas fa-list mr-2"></i> Liste
                                </button>
                                <button class="px-4 py-2 rounded-lg text-secondary-600 hover:text-secondary-900">
                                    <i class="fas fa-calendar mr-2"></i> Calendrier
                                </button>
                            </div>
                            <button class="inline-flex items-center px-5 py-2.5 border-2 border-green-500 text-green-600 rounded-xl font-bold hover:bg-green-50 transition-all duration-300">
                                <i class="fas fa-plus mr-2"></i>
                                Proposer un événement
                            </button>
                        </div>
                    </div>
                    
                    {{-- Vue en liste des événements --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        @forelse($events as $event)
                            <div class="group animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                                <x-event.event-card :event="$event" />
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16 animate-fade-in">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar-day text-green-600 text-3xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-secondary-800 mb-3">Aucun événement à venir</h3>
                                <p class="text-secondary-600 mb-6">Revenez bientôt pour découvrir le programme culturel</p>
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
                    @if($events->hasPages())
                        <div class="mt-12 animate-fade-in">
                            {{ $events->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                    
                    {{-- Événements passés --}}
                    @if(isset($pastEvents) && $pastEvents->count() > 0)
                    <div class="mt-16 pt-12 border-t border-secondary-100">
                        <h3 class="text-2xl font-bold text-secondary-900 mb-8 heading-font">
                            <i class="fas fa-history text-amber-600 mr-3"></i>
                            Événements passés
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pastEvents->take(3) as $pastEvent)
                            <div class="relative bg-gradient-to-br from-secondary-50 to-white rounded-2xl p-6 border border-secondary-200 opacity-75 hover:opacity-100 transition-opacity">
                                <div class="absolute top-4 right-4">
                                    <span class="text-xs bg-secondary-100 text-secondary-700 px-3 py-1 rounded-full">
                                        Terminé
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <div class="text-sm font-medium text-secondary-500 mb-1">
                                        <i class="far fa-calendar-minus mr-2"></i>
                                        {{ $pastEvent->date->format('d M Y') }}
                                    </div>
                                    <h4 class="text-lg font-bold text-secondary-900 line-clamp-2">{{ $pastEvent->title }}</h4>
                                </div>
                                <p class="text-secondary-600 text-sm mb-4 line-clamp-2">{{ Str::limit($pastEvent->description, 80) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-secondary-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ $pastEvent->location ?? 'Bénin' }}
                                    </span>
                                    <button class="text-green-600 hover:text-green-700 text-sm font-medium">
                                        Voir les photos
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($pastEvents->count() > 3)
                        <div class="text-center mt-8">
                            <a href="#" class="inline-flex items-center text-secondary-600 hover:text-secondary-900 font-medium">
                                <i class="fas fa-history mr-2"></i>
                                Voir tous les {{ $pastEvents->count() }} événements passés
                            </a>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- CALENDRIER MENSUEL --}}
    <section class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6 heading-font">Calendrier Mensuel</h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Visualisez tous les événements du mois en cours sur notre calendrier interactif
                </p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl border border-green-100 overflow-hidden animate-slide-up">
                {{-- En-tête du calendrier --}}
                <div class="flex justify-between items-center p-6 border-b border-secondary-100">
                    <button class="p-2 hover:bg-green-50 rounded-lg">
                        <i class="fas fa-chevron-left text-secondary-600"></i>
                    </button>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-secondary-900">{{ now()->format('F Y') }}</h3>
                        <p class="text-sm text-secondary-600">{{ $events->count() }} événements ce mois-ci</p>
                    </div>
                    <button class="p-2 hover:bg-green-50 rounded-lg">
                        <i class="fas fa-chevron-right text-secondary-600"></i>
                    </button>
                </div>
                
                {{-- Jours de la semaine --}}
                <div class="grid grid-cols-7 bg-green-50 border-b border-green-100">
                    @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day)
                        <div class="p-4 text-center text-sm font-semibold text-secondary-700">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>
                
                {{-- Jours du mois --}}
                <div class="grid grid-cols-7">
                    @php
                        $firstDay = now()->startOfMonth()->startOfWeek();
                        $lastDay = now()->endOfMonth()->endOfWeek();
                        $currentDay = $firstDay->copy();
                    @endphp
                    
                    @while($currentDay <= $lastDay)
                        @php
                            $isCurrentMonth = $currentDay->month == now()->month;
                            $isToday = $currentDay->isToday();
                            $hasEvent = $events->contains(function($event) use ($currentDay) {
                                return $event->date && $event->date->isSameDay($currentDay);
                            });
                        @endphp
                        
                        <div class="min-h-24 p-2 border border-secondary-100 relative
                            {{ !$isCurrentMonth ? 'bg-secondary-50' : '' }}
                            {{ $isToday ? 'bg-green-50 border-green-200' : '' }}">
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-sm font-medium 
                                    {{ $isCurrentMonth ? 'text-secondary-900' : 'text-secondary-400' }}
                                    {{ $isToday ? 'text-green-600 font-bold' : '' }}">
                                    {{ $currentDay->day }}
                                </span>
                                @if($hasEvent)
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                @endif
                            </div>
                            
                            {{-- Événements du jour --}}
                            @if($hasEvent)
                                @foreach($events->where(fn($e) => $e->date && $e->date->isSameDay($currentDay))->take(2) as $dayEvent)
                                <div class="mt-1 p-2 bg-green-100 rounded text-xs text-secondary-800 hover:bg-green-200 cursor-pointer transition-colors line-clamp-2">
                                    {{ Str::limit($dayEvent->title, 20) }}
                                </div>
                                @endforeach
                                @if($events->where(fn($e) => $e->date && $e->date->isSameDay($currentDay))->count() > 2)
                                <div class="text-xs text-secondary-500 text-center mt-1">
                                    +{{ $events->where(fn($e) => $e->date && $e->date->isSameDay($currentDay))->count() - 2 }} autres
                                </div>
                                @endif
                            @endif
                        </div>
                        
                        @php
                            $currentDay->addDay();
                        @endphp
                    @endwhile
                </div>
            </div>
        </div>
    </section>

    {{-- APPEL À CONTRIBUTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-3xl p-10 border-2 border-green-200 shadow-xl animate-fade-in">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-2/3 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-secondary-900 mb-4 heading-font">Organisez-vous un événement culturel ?</h3>
                        <p class="text-secondary-600 mb-6">
                            Faites connaître votre événement à toute la communauté Culture Bénin. 
                            Ajoutez vos festivals, cérémonies, expositions ou rencontres culturelles pour 
                            les partager avec des milliers de passionnés.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('devenir-contributeur') }}" 
                               class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full font-bold hover:from-green-600 hover:to-green-700 hover:shadow-xl transition-all duration-300 group">
                                <i class="fas fa-user-plus mr-2"></i>
                                Devenir contributeur
                            </a>
                            <a href="#" 
                               class="inline-flex items-center justify-center border-2 border-green-500 text-green-600 px-8 py-3 rounded-full font-bold hover:bg-green-50 hover:border-green-600 transition-all duration-300">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Proposer un événement
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/3 text-center">
                        <div class="w-32 h-32 mx-auto bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-2xl">
                            <i class="fas fa-calendar-check text-white text-4xl"></i>
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
    /* Animation pour les cartes d'événements */
    .event-card-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .event-card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(22, 163, 74, 0.15);
    }
    
    /* Style pour le calendrier */
    .calendar-day {
        transition: all 0.2s ease;
    }
    
    .calendar-day:hover {
        background-color: #f0fdf4;
    }
    
    /* Animation pour les filtres */
    .filter-option {
        transition: all 0.2s ease;
    }
    
    .filter-option:hover {
        background-color: #f0fdf4;
        transform: translateX(4px);
    }
    
    /* Style pour les événements passés */
    .past-event {
        position: relative;
    }
    
    .past-event::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.4) 100%);
        pointer-events: none;
    }
    
    /* Animation pour les jours avec événements */
    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.4);
        }
        50% {
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0);
        }
    }
    
    .has-event {
        animation: pulse-glow 2s infinite;
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
        
        // Navigation du calendrier
        const prevBtn = document.querySelector('button .fa-chevron-left').closest('button');
        const nextBtn = document.querySelector('button .fa-chevron-right').closest('button');
        
        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function() {
                console.log('Mois précédent');
                // Ici, tu pourrais ajouter la logique AJAX pour changer de mois
            });
            
            nextBtn.addEventListener('click', function() {
                console.log('Mois suivant');
                // Ici, tu pourrais ajouter la logique AJAX pour changer de mois
            });
        }
        
        // Gestion des filtres
        const filterButtons = document.querySelectorAll('.filter-option input[type="checkbox"]');
        filterButtons.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                console.log('Filtre modifié:', this.nextElementSibling.textContent);
                // Ici, tu pourrais ajouter la logique de filtrage AJAX
            });
        });
        
        // Recherche en temps réel
        const searchInput = document.querySelector('input[placeholder="Nom de l\'événement..."]');
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
        
        // Navigation entre liste et calendrier
        const viewButtons = document.querySelectorAll('.flex.bg-green-50 button');
        viewButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                viewButtons.forEach(btn => {
                    btn.classList.remove('bg-white', 'shadow', 'text-secondary-900');
                    btn.classList.add('text-secondary-600', 'hover:text-secondary-900');
                });
                this.classList.remove('text-secondary-600', 'hover:text-secondary-900');
                this.classList.add('bg-white', 'shadow', 'text-secondary-900');
                
                // Ici, tu pourrais ajouter la logique pour changer la vue
                if (index === 0) {
                    console.log('Vue liste activée');
                } else {
                    console.log('Vue calendrier activée');
                }
            });
        });
    });
    
    // Fonction pour afficher les détails d'un événement du calendrier
    function showEventDetails(eventId, eventTitle, eventDate, eventDescription) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 animate-fade-in';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl max-w-md w-full max-h-[90vh] overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="text-sm text-green-600 font-medium mb-1">
                                <i class="far fa-calendar-alt mr-2"></i>
                                ${eventDate}
                            </div>
                            <h3 class="text-xl font-bold text-secondary-900">${eventTitle}</h3>
                        </div>
                        <button onclick="this.closest('.fixed').remove()" class="text-secondary-400 hover:text-secondary-600">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    <p class="text-secondary-600 mb-6">${eventDescription}</p>
                    <div class="flex gap-3">
                        <a href="/evenements/${eventId}" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold text-center hover:from-green-600 hover:to-green-700 transition-all">
                            Voir les détails
                        </a>
                        <button onclick="this.closest('.fixed').remove()" class="px-6 py-3 border border-secondary-200 text-secondary-700 rounded-xl hover:bg-secondary-50 transition-colors">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }
</script>
@endpush