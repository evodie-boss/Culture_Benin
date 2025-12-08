@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-photo-video text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Détails du Média</h1>
            <p class="text-gray-600 mt-1">Informations complètes sur ce média</p>
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
                    <a href="{{ route('admin.medias.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Médias</a>
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
                            <i class="fas fa-file-image text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Média #{{ $media->id_media }}</h2>
                            <div class="flex items-center mt-2 space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    #{{ $media->id_media }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $media->typeMedia->nom_media ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.medias.edit', $media->id_media) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier
                        </a>
                        <a href="{{ route('admin.medias.index') }}" 
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
                                <i class="fas fa-hashtag text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">ID</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">#{{ $media->id_media }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-tags text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Type de média</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    @if($media->typeMedia->nom_media == 'Image')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-image mr-1"></i> Image
                                        </span>
                                    @elseif($media->typeMedia->nom_media == 'Audio')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-music mr-1"></i> Audio
                                        </span>
                                    @elseif($media->typeMedia->nom_media == 'Vidéo')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-video mr-1"></i> Vidéo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-file mr-1"></i> Document
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-file text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Chemin</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $media->chemin }}</code>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-orange-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-file-alt text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Description</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ $media->description ?? 'Aucune description disponible' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-link text-indigo-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Contenu associé</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    @if($media->contenu)
                                        <a href="{{ route('contenus.show', $media->contenu->id_contenu) }}" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $media->contenu->titre }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">Aucun contenu associé</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails du contenu associé -->
                @if($media->contenu)
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-4"></i>
                        <div class="flex-1">
                            <h4 class="text-base font-semibold text-blue-900 mb-3">Détails du contenu associé</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-blue-800">
                                <div class="flex items-center">
                                    <i class="fas fa-heading mr-3 text-blue-600"></i>
                                    <span><strong>Titre :</strong> {{ $media->contenu->titre }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-layer-group mr-3 text-blue-600"></i>
                                    <span><strong>Type :</strong> {{ $media->contenu->typeContenu->nom_contenu ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-map mr-3 text-blue-600"></i>
                                    <span><strong>Région :</strong> {{ $media->contenu->region->nom_region ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-language mr-3 text-blue-600"></i>
                                    <span><strong>Langue :</strong> {{ $media->contenu->langue->nom_langue ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-3 text-blue-600"></i>
                                    <span><strong>Date création :</strong> {{ $media->contenu->date_creation->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-3 text-blue-600"></i>
                                    <span><strong>Statut :</strong> 
                                        @if($media->contenu->statut == 'valide')
                                            <span class="text-green-600 font-medium">Validé</span>
                                        @elseif($media->contenu->statut == 'en_attente')
                                            <span class="text-yellow-600 font-medium">En attente</span>
                                        @else
                                            <span class="text-red-600 font-medium">Rejeté</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
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
                            {{ $media->created_at ? $media->created_at->format('d/m/Y à H:i') : 'N/A' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Modifié le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $media->updated_at ? $media->updated_at->format('d/m/Y à H:i') : 'Non modifié' }}
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

        <!-- Carte Type de média -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Type de média
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center">
                    @if($media->typeMedia->nom_media == 'Image')
                        <div class="bg-green-100 rounded-full p-4 inline-flex mb-3">
                            <i class="fas fa-image text-green-600 text-2xl"></i>
                        </div>
                    @elseif($media->typeMedia->nom_media == 'Audio')
                        <div class="bg-blue-100 rounded-full p-4 inline-flex mb-3">
                            <i class="fas fa-music text-blue-600 text-2xl"></i>
                        </div>
                    @elseif($media->typeMedia->nom_media == 'Vidéo')
                        <div class="bg-red-100 rounded-full p-4 inline-flex mb-3">
                            <i class="fas fa-video text-red-600 text-2xl"></i>
                        </div>
                    @else
                        <div class="bg-gray-100 rounded-full p-4 inline-flex mb-3">
                            <i class="fas fa-file text-gray-600 text-2xl"></i>
                        </div>
                    @endif
                    <h4 class="text-lg font-bold text-gray-900">{{ $media->typeMedia->nom_media }}</h4>
                    <p class="text-sm text-gray-600 mt-1">Type de fichier média</p>
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
                    <a href="{{ route('admin.medias.edit', $media->id_media) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier le média
                    </a>
                    
                    @if($media->contenu)
                    <a href="{{ route('contenus.show', $media->contenu->id_contenu) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Voir le contenu
                    </a>
                    @endif
                    
                    <a href="{{ route('admin.medias.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-list mr-2"></i>
                        Voir tous les médias
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

/* Style pour le code */
code {
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.875rem;
}

/* Animation pour les liens */
a {
    transition: all 0.2s ease-in-out;
}

a:hover {
    text-decoration: underline;
}
</style>
@endsection