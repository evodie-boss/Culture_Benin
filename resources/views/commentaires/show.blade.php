@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-comment-dots text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Détails du Commentaire</h1>
            <p class="text-gray-600 mt-1">Informations complètes sur ce commentaire</p>
        </div>
    </div>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 text-sm">
            <li class="inline-flex items-center">
                <a href="{{ url('/') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('commentaires.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Commentaires</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-blue-600 font-medium">Détails</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Colonne principale -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Carte Informations principales -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-green-50 px-6 py-5 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="bg-white p-3 rounded-xl shadow-md mr-4">
                            <i class="fas fa-comment-dots text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Commentaire #{{ $commentaire->id_commentaire }}</h2>
                            <div class="flex items-center mt-2 space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    #{{ $commentaire->id_commentaire }}
                                </span>
                                @if($commentaire->note)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i>
                                    {{ $commentaire->note }}/5
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('commentaires.edit', $commentaire->id_commentaire) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier
                        </a>
                        <a href="{{ route('commentaires.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Informations de base -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-user text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Utilisateur</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ $commentaire->utilisateur->prenom ?? 'N/A' }} {{ $commentaire->utilisateur->nom ?? '' }}
                                </p>
                                <p class="text-sm text-gray-600 mt-1">{{ $commentaire->utilisateur->email ?? '' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-calendar text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Date</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $commentaire->date->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @if($commentaire->note)
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-star text-yellow-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Note</h3>
                                <div class="flex items-center mt-1">
                                    <div class="flex mr-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-{{ $i <= $commentaire->note ? 'yellow-400' : 'gray-300' }} text-lg mr-1"></i>
                                        @endfor
                                    </div>
                                    <span class="text-lg font-semibold text-gray-900">({{ $commentaire->note }}/5)</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-clock text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Statut</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Actif
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commentaire texte -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-comment text-blue-600 mr-3"></i>
                        Commentaire
                    </h3>
                    <div class="bg-gray-50 border-l-4 border-blue-500 p-6 rounded-xl">
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($commentaire->texte)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Carte Contenu Associé -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-file-alt text-blue-600 mr-2"></i>
                    Contenu Associé
                </h3>
            </div>
            <div class="p-6">
                @if($commentaire->contenu)
                <div class="space-y-4">
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <h4 class="font-semibold text-blue-900 mb-2">
                            <a href="{{ route('contenus.show', $commentaire->contenu->id_contenu) }}" 
                               class="hover:text-blue-700 hover:underline transition-colors duration-200">
                                {{ $commentaire->contenu->titre }}
                            </a>
                        </h4>
                        <div class="space-y-2 text-sm text-blue-800">
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2 text-blue-600 text-xs"></i>
                                <span><strong>Type :</strong> {{ $commentaire->contenu->typeContenu->nom_contenu ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-600 text-xs"></i>
                                <span><strong>Région :</strong> {{ $commentaire->contenu->region->nom_region ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-language mr-2 text-blue-600 text-xs"></i>
                                <span><strong>Langue :</strong> {{ $commentaire->contenu->langue->nom_langue ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contenus.show', $commentaire->contenu->id_contenu) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow-md">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Voir le contenu
                    </a>
                </div>
                @else
                <div class="text-center py-6 text-gray-500">
                    <i class="fas fa-file-excel text-3xl mb-3 opacity-50"></i>
                    <p class="font-medium">Aucun contenu associé</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Carte Métadonnées -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history text-blue-600 mr-2"></i>
                    Métadonnées
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Créé le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $commentaire->created_at ? $commentaire->created_at->format('d/m/Y à H:i') : 'N/A' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Modifié le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $commentaire->updated_at ? $commentaire->updated_at->format('d/m/Y à H:i') : 'Non modifié' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm font-medium text-gray-500">Statut :</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Actif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Actions Rapides -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bolt text-blue-600 mr-2"></i>
                    Actions Rapides
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('commentaires.edit', $commentaire->id_commentaire) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier le commentaire
                    </a>
                    
                    @if($commentaire->contenu)
                    <a href="{{ route('contenus.show', $commentaire->contenu->id_contenu) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Voir le contenu
                    </a>
                    @endif
                    
                    <a href="{{ route('commentaires.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-list mr-2"></i>
                        Voir tous les commentaires
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée progressive
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // Effet de hover sur les cartes d'information
    const infoCards = document.querySelectorAll('.bg-gray-50.rounded-xl');
    infoCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });

    // Animation pour les étoiles de notation
    const stars = document.querySelectorAll('.fa-star');
    stars.forEach((star, index) => {
        star.style.animationDelay = `${index * 0.1}s`;
        star.classList.add('animate-pulse');
    });
});
</script>

<!-- Styles personnalisés -->
<style>
.glass-effect {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

.hover-lift:hover {
    transform: translateY(-4px);
    transition: transform 0.2s ease-in-out;
}

.gradient-border {
    border: 1px solid transparent;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #3B82F6, #10B981) border-box;
}

/* Amélioration de la typographie */
.prose {
    line-height: 1.7;
    font-size: 1.05rem;
}

.prose p {
    margin-bottom: 1rem;
}

.prose p:last-child {
    margin-bottom: 0;
}

/* Animation pour les étoiles */
.animate-pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

/* Style pour les liens dans le contenu associé */
a:hover {
    text-decoration: underline;
}
</style>
@endsection