@extends('layouts.guest')
@section('title', $event->titre)

@section('content')
    {{-- HERO SECTION AVEC DESIGN AMÉLIORÉ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white">
        <div class="absolute inset-0 z-0">
            {{-- Image de fond dynamique --}}
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-800/80"></div>
            
            @if($event->image)
                <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ $event->image }}')"></div>
            @endif
            
            {{-- Éléments décoratifs --}}
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
            
            {{-- Icône d'événement en arrière-plan --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <i class="fas fa-calendar-alt text-[20vw]"></i>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 md:py-32">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <div class="flex items-center space-x-2 text-sm mb-6 animate-fade-in">
                    <a href="{{ route('evenements.index') }}" class="text-green-300 hover:text-white transition-colors">
                        <i class="fas fa-calendar mr-1"></i> Événements
                    </a>
                    <span class="text-green-400">/</span>
                    <span class="text-white/80">{{ Str::limit($event->titre, 40) }}</span>
                </div>
                
                {{-- Badge type d'événement --}}
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6 animate-fade-in">
                    @php
                        $eventTypeIcon = match($event->type ?? '') {
                            'festival' => 'fas fa-music',
                            'ceremonie' => 'fas fa-mask',
                            'fete' => 'fas fa-utensils',
                            'exposition' => 'fas fa-palette',
                            'conference' => 'fas fa-microphone',
                            default => 'fas fa-calendar-alt'
                        };
                    @endphp
                    <i class="{{ $eventTypeIcon }} text-green-300"></i>
                    <span class="text-sm font-medium">{{ $event->type ?? 'Événement culturel' }}</span>
                </div>
                
                {{-- Titre principal --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 animate-slide-up heading-font">
                    {{ $event->titre }}
                </h1>
                
                {{-- Sous-titre avec date et lieu --}}
                <div class="flex flex-wrap items-center gap-4 mb-8 animate-fade-in delay-100">
                    <div class="flex items-center text-white/90">
                        <i class="far fa-calendar-alt text-green-300 mr-3"></i>
                        <span class="text-lg">{{ $event->date_formatee }}</span>
                    </div>
                    <div class="flex items-center text-white/90">
                        <i class="fas fa-map-marker-alt text-green-300 mr-3"></i>
                        <span class="text-lg">{{ $event->lieu }}</span>
                    </div>
                    @if($event->region)
                    <div class="flex items-center text-white/90">
                        <i class="fas fa-map text-green-300 mr-3"></i>
                        <span class="text-lg">{{ $event->region->nom_region }}</span>
                    </div>
                    @endif
                </div>
                
                {{-- Description courte --}}
                <p class="text-xl text-white/90 mb-8 leading-relaxed max-w-3xl animate-fade-in delay-200">
                    {{ Str::limit($event->description, 200) }}
                </p>
                
                {{-- Actions --}}
                <div class="flex flex-wrap gap-4 animate-fade-in delay-300">
                    @if($event->lien_inscription)
                    <a href="{{ $event->lien_inscription }}" target="_blank"
                       class="inline-flex items-center justify-center bg-green-400 text-green-900 px-6 py-3 rounded-full text-lg font-bold hover:bg-green-300 hover:scale-105 hover:shadow-xl transition-all duration-300 group shadow-lg">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        S'inscrire
                    </a>
                    @endif
                    <button onclick="shareEvent()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="fas fa-share-alt mr-2"></i>
                        Partager
                    </button>
                    <button onclick="addToCalendar()"
                       class="inline-flex items-center justify-center border-2 border-white/80 text-white px-6 py-3 rounded-full text-lg font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        <i class="far fa-calendar-plus mr-2"></i>
                        Ajouter au calendrier
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

    {{-- INFORMATIONS PRATIQUES --}}
    <section class="py-16 bg-gradient-to-b from-white to-green-50/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Colonne gauche : Informations pratiques --}}
                <div class="lg:col-span-1 animate-slide-up">
                    <div class="bg-white rounded-2xl shadow-xl border border-green-100 p-8 sticky top-24">
                        <h2 class="text-2xl font-bold text-secondary-900 mb-6 pb-4 border-b border-secondary-100 heading-font">
                            <i class="fas fa-info-circle text-green-600 mr-3"></i>
                            Informations pratiques
                        </h2>
                        
                        <div class="space-y-6">
                            {{-- Date --}}
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="far fa-calendar-alt text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500 mb-1">Date et heure</div>
                                    <div class="font-bold text-secondary-900">{{ $event->date_formatee }}</div>
                                    @if($event->heure_debut)
                                    <div class="text-sm text-secondary-600">{{ $event->heure_debut }} @if($event->heure_fin)- {{ $event->heure_fin }}@endif</div>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Lieu --}}
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500 mb-1">Lieu</div>
                                    <div class="font-bold text-secondary-900">{{ $event->lieu }}</div>
                                    @if($event->adresse)
                                    <div class="text-sm text-secondary-600 mt-1">{{ $event->adresse }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Région --}}
                            @if($event->region)
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-map text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500 mb-1">Région</div>
                                    <div class="font-bold text-secondary-900">{{ $event->region->nom_region }}</div>
                                    <a href="{{ route('regions.show', $event->region) }}" class="text-green-600 hover:text-green-700 text-sm font-medium inline-flex items-center mt-1">
                                        Voir la région
                                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            {{-- Prix --}}
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-ticket-alt text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500 mb-1">Tarif</div>
                                    <div class="text-2xl font-bold text-green-600 mb-2">{{ $event->prix_formate }}</div>
                                    @if($event->lien_inscription)
                                    <a href="{{ $event->lien_inscription }}" target="_blank"
                                       class="inline-flex items-center justify-center w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Réserver maintenant
                                    </a>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Organisateur --}}
                            @if($event->organisateur)
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-secondary-500 mb-1">Organisé par</div>
                                    <div class="font-bold text-secondary-900">{{ $event->organisateur }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        {{-- Partager --}}
                        <div class="mt-8 pt-6 border-t border-secondary-100">
                            <div class="text-sm text-secondary-500 mb-3">Partager cet événement</div>
                            <div class="flex space-x-3">
                                <button onclick="shareOnFacebook()" class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-200 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button onclick="shareOnTwitter()" class="w-10 h-10 bg-blue-50 text-blue-400 rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button onclick="shareOnWhatsApp()" class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center hover:bg-green-200 transition-colors">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                                <button onclick="copyEventLink()" class="w-10 h-10 bg-secondary-100 text-secondary-600 rounded-full flex items-center justify-center hover:bg-secondary-200 transition-colors">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Colonne droite : Description et contenu --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Description détaillée --}}
                    <div class="bg-white rounded-2xl shadow-xl border border-green-100 p-8 animate-fade-in">
                        <h2 class="text-2xl font-bold text-secondary-900 mb-6 heading-font">À propos de l'événement</h2>
                        <div class="prose prose-lg max-w-none text-secondary-600">
                            {!! $event->description !!}
                        </div>
                    </div>
                    
                    {{-- Programme (si disponible) --}}
                    @if($event->programme)
                    <div class="bg-white rounded-2xl shadow-xl border border-green-100 p-8 animate-fade-in delay-100">
                        <h2 class="text-2xl font-bold text-secondary-900 mb-6 heading-font">
                            <i class="fas fa-list-ol text-green-600 mr-3"></i>
                            Programme
                        </h2>
                        <div class="prose prose-lg max-w-none text-secondary-600">
                            {!! $event->programme !!}
                        </div>
                    </div>
                    @endif
                    
                    {{-- Galerie (si disponible) --}}
                    @if($event->hasMedia('galerie'))
                    <div class="bg-white rounded-2xl shadow-xl border border-green-100 p-8 animate-fade-in delay-200">
                        <h2 class="text-2xl font-bold text-secondary-900 mb-6 heading-font">
                            <i class="fas fa-images text-green-600 mr-3"></i>
                            Galerie
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($event->getMedia('galerie')->take(6) as $media)
                            <a href="{{ $media->getUrl() }}" data-lightbox="event-gallery" class="block aspect-square rounded-xl overflow-hidden hover:opacity-90 transition-opacity">
                                <img src="{{ $media->getUrl('thumb') }}" alt="Image événement" class="w-full h-full object-cover">
                            </a>
                            @endforeach
                        </div>
                        @if($event->getMedia('galerie')->count() > 6)
                        <div class="text-center mt-6">
                            <button class="text-green-600 hover:text-green-700 font-medium">
                                Voir les {{ $event->getMedia('galerie')->count() - 6 }} photos supplémentaires
                            </button>
                        </div>
                        @endif
                    </div>
                    @endif
                    
                    {{-- Événements similaires --}}
                    @if($similarEvents && $similarEvents->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl border border-green-100 p-8 animate-fade-in delay-300">
                        <h2 class="text-2xl font-bold text-secondary-900 mb-6 heading-font">
                            <i class="fas fa-calendar-day text-green-600 mr-3"></i>
                            Événements similaires
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($similarEvents as $similarEvent)
                            <a href="{{ route('evenements.show', $similarEvent) }}" 
                               class="group bg-gradient-to-b from-white to-green-50 rounded-xl p-4 border border-green-100 hover:border-green-300 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-start">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-calendar-alt text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-secondary-900 group-hover:text-green-700 transition-colors line-clamp-1">
                                            {{ $similarEvent->titre }}
                                        </h3>
                                        <div class="flex items-center text-sm text-secondary-500 mt-2">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            <span>{{ $similarEvent->date_formatee }}</span>
                                        </div>
                                        <div class="flex items-center text-sm text-secondary-500 mt-1">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            <span>{{ $similarEvent->lieu }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- MAP (si localisation disponible) --}}
    @if($event->latitude && $event->longitude)
    <section class="py-16 bg-gradient-to-b from-green-50/30 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 animate-fade-in">
                <h2 class="text-3xl font-bold text-secondary-900 mb-4 heading-font">Localisation</h2>
                <p class="text-secondary-600">Comment se rendre à l'événement</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl border border-green-100 overflow-hidden animate-slide-up">
                <div class="aspect-[21/9] bg-gradient-to-br from-green-100 to-green-200 relative">
                    {{-- Ici tu pourrais intégrer Google Maps ou OpenStreetMap --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt text-green-600 text-5xl mb-4"></i>
                            <h3 class="text-xl font-bold text-secondary-900">{{ $event->lieu }}</h3>
                            <p class="text-secondary-600 mt-2">{{ $event->adresse ?? '' }}</p>
                            <button class="mt-4 inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-full font-medium hover:bg-green-700 transition-colors">
                                <i class="fas fa-directions mr-2"></i>
                                Obtenir l'itinéraire
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- NEWSLETTER --}}
    <x-partials.newsletter />
@endsection

@push('scripts')
<script>
    // Fonction de partage
    function shareEvent() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $event->titre }} - Culture Bénin',
                text: '{{ Str::limit($event->description, 100) }}',
                url: window.location.href
            })
            .then(() => console.log('Événement partagé avec succès'))
            .catch((error) => console.log('Erreur de partage:', error));
        } else {
            copyEventLink();
        }
    }
    
    // Fonctions de partage spécifiques
    function shareOnFacebook() {
        const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`;
        window.open(url, '_blank', 'width=600,height=400');
    }
    
    function shareOnTwitter() {
        const text = encodeURIComponent('Découvrez cet événement culturel au Bénin: {{ $event->titre }}');
        const url = `https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(window.location.href)}`;
        window.open(url, '_blank', 'width=600,height=400');
    }
    
    function shareOnWhatsApp() {
        const text = encodeURIComponent('Découvrez cet événement: {{ $event->titre }} - ' + window.location.href);
        const url = `https://wa.me/?text=${text}`;
        window.open(url, '_blank');
    }
    
    function copyEventLink() {
        navigator.clipboard.writeText(window.location.href);
        showToast('Lien copié dans le presse-papier !', 'success');
    }
    
    // Ajouter au calendrier
    function addToCalendar() {
        // Format de date pour le calendrier (iCalendar)
        const eventDate = new Date('{{ $event->date->format("Y-m-d") }}');
        if ('{{ $event->heure_debut }}') {
            eventDate.setHours(parseInt('{{ $event->heure_debut }}'.split(':')[0]));
            eventDate.setMinutes(parseInt('{{ $event->heure_debut }}'.split(':')[1]));
        }
        
        const endDate = new Date(eventDate);
        endDate.setHours(endDate.getHours() + 2); // Durée par défaut de 2h
        
        const icsContent = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'BEGIN:VEVENT',
            `SUMMARY:{{ $event->titre }}`,
            `DESCRIPTION:{{ Str::limit($event->description, 500) }}`,
            `DTSTART:${eventDate.toISOString().replace(/[-:]/g, '').split('.')[0]}Z`,
            `DTEND:${endDate.toISOString().replace(/[-:]/g, '').split('.')[0]}Z`,
            `LOCATION:{{ $event->lieu }}`,
            'END:VEVENT',
            'END:VCALENDAR'
        ].join('\n');
        
        const blob = new Blob([icsContent], { type: 'text/calendar' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'evenement-{{ Str::slug($event->titre) }}.ics';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        
        showToast('Fichier calendrier téléchargé !', 'success');
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
    /* Style pour la prose (description) */
    .prose {
        line-height: 1.7;
    }
    
    .prose p {
        margin-bottom: 1.5rem;
    }
    
    .prose ul, .prose ol {
        margin-bottom: 1.5rem;
    }
    
    .prose li {
        margin-bottom: 0.5rem;
    }
    
    /* Animation pour les liens */
    .prose a {
        color: #16a34a;
        text-decoration: underline;
        transition: color 0.2s;
    }
    
    .prose a:hover {
        color: #15803d;
    }
    
    /* Style pour les cartes d'informations */
    .info-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(22, 163, 74, 0.1);
    }
    
    /* Effet de surbrillance sur les cartes similaires */
    .similar-event {
        position: relative;
        overflow: hidden;
    }
    
    .similar-event::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(22, 163, 74, 0.1), transparent);
        transition: left 0.7s;
    }
    
    .similar-event:hover::before {
        left: 100%;
    }
    
    /* Style pour la galerie */
    .gallery-image {
        transition: transform 0.3s ease;
    }
    
    .gallery-image:hover {
        transform: scale(1.05);
    }
</style>
@endpush