@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-file-alt text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Détails du Contenu</h1>
            <p class="text-gray-600 mt-1">Informations complètes sur ce contenu</p>
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
                    <a href="{{ route('contenus.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Contenus</a>
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
                            <i class="fas fa-file-text text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $contenu->titre }}</h2>
                            <div class="flex items-center mt-2 space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    #{{ $contenu->id_contenu }}
                                </span>
                                @if($contenu->statut == 'valide')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Validé
                                    </span>
                                @elseif($contenu->statut == 'en_attente')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        En attente
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Rejeté
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('contenus.edit', $contenu->id_contenu) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier
                        </a>
                        <a href="{{ route('contenus.index') }}" 
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
                                <i class="fas fa-tags text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Type de contenu</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $contenu->typeContenu->nom_contenu ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Région</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $contenu->region->nom_region ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-language text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Langue</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $contenu->langue->nom_langue ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-orange-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-user-edit text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Auteur</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ $contenu->auteur->prenom ?? 'N/A' }} {{ $contenu->auteur->nom ?? '' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-calendar-plus text-indigo-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Date création</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $contenu->date_creation->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        @if($contenu->date_validation)
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-calendar-check text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Date validation</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $contenu->date_validation->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Texte du contenu -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-align-left text-blue-600 mr-3"></i>
                        Texte du contenu
                    </h3>
                    <div class="bg-gray-50 border-l-4 border-blue-500 p-6 rounded-xl">
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($contenu->texte)) !!}
                        </div>
                    </div>
                </div>

                <!-- Médias associés -->
                @if($contenu->medias->count() > 0)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-images text-blue-600 mr-3"></i>
                        Médias associés ({{ $contenu->medias->count() }})
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($contenu->medias as $media)
                        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-200">
                            <div class="text-center mb-3">
                                @if(in_array($media->typeMedia->nom_media, ['Image', 'Vidéo']))
                                    <div class="bg-blue-100 p-4 rounded-lg inline-flex">
                                        <i class="fas fa-image text-blue-600 text-2xl"></i>
                                    </div>
                                @else
                                    <div class="bg-green-100 p-4 rounded-lg inline-flex">
                                        <i class="fas fa-music text-green-600 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="text-center">
                                <p class="font-medium text-gray-900 mb-1">{{ $media->description ?? 'Sans description' }}</p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-tag mr-1 text-xs"></i>
                                    {{ $media->typeMedia->nom_media }}
                                </span>
                            </div>
                        </div>
                        @endforeach
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
                            {{ $contenu->created_at ? $contenu->created_at->format('d/m/Y à H:i') : 'N/A' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Modifié le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $contenu->updated_at ? $contenu->updated_at->format('d/m/Y à H:i') : 'Non modifié' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm font-medium text-gray-500">Statut :</span>
                        @if($contenu->statut == 'valide')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Validé
                            </span>
                        @elseif($contenu->statut == 'en_attente')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>
                                En attente
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>
                                Rejeté
                            </span>
                        @endif
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
                    <a href="{{ route('contenus.edit', $contenu->id_contenu) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier le contenu
                    </a>
                    
                    <a href="{{ route('contenus.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-list mr-2"></i>
                        Voir tous les contenus
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
</style>
@endsection