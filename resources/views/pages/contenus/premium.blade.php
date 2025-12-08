{{-- resources/views/pages/contenus/premium.blade.php --}}
@extends('layouts.guest')

@section('title', $contenu->titre . ' - Contenu Premium')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <!-- Bannière succès -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                    <div class="text-sm">
                        Accès valide jusqu'au {{ $transaction->expire_le ? $transaction->expire_le->format('d/m/Y H:i') : 'illimité' }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- En-tête du contenu -->
            <div class="mb-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                                <i class="fas fa-crown mr-2"></i> Contenu Premium
                            </span>
                            @if($contenu->typeContenu)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $contenu->typeContenu->nom_contenu }}
                                </span>
                            @endif
                        </div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $contenu->titre }}</h1>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-3">
                        <button onclick="window.print()" 
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                            <i class="fas fa-print mr-2"></i> Imprimer
                        </button>
                        <button onclick="genererPDF()" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all">
                            <i class="fas fa-file-pdf mr-2"></i> Télécharger
                        </button>
                    </div>
                </div>

                <!-- Métadonnées -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg border shadow-sm">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg mr-4">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Auteur</p>
                                <p class="font-semibold">{{ $contenu->auteur->prenom ?? 'Inconnu' }} {{ $contenu->auteur->nom ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg border shadow-sm">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Région</p>
                                <p class="font-semibold">{{ $contenu->region->nom_region ?? 'Non spécifiée' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg border shadow-sm">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-100 rounded-lg mr-4">
                                <i class="fas fa-language text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Langue</p>
                                <p class="font-semibold">{{ $contenu->langue->nom_langue ?? 'Non spécifiée' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <!-- Barre d'outils -->
                <div class="border-b border-gray-200 p-4 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-calendar mr-1"></i>
                            Publié le {{ $contenu->date_creation->format('d/m/Y') }}
                            @if($contenu->date_validation)
                                | Validé le {{ $contenu->date_validation->format('d/m/Y') }}
                            @endif
                        </div>
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i>
                            Temps de lecture : {{ ceil(str_word_count(strip_tags($contenu->texte)) / 200) }} min
                        </div>
                    </div>
                </div>
                
                <!-- Contenu texte -->
                <div class="p-8">
                    <article class="prose prose-lg max-w-none">
                        {!! $contenu->texte !!}
                    </article>
                </div>
            </div>

            <!-- Médias associés -->
            @if($contenu->medias->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Contenus multimédias</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($contenu->medias as $media)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                                @if($media->typeMedia->nom_media === 'image')
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $media->chemin) }}" 
                                             alt="{{ $media->description }}"
                                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </div>
                                @elseif($media->typeMedia->nom_media === 'video')
                                    <div class="relative h-48 bg-gray-900">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-play-circle text-white text-5xl opacity-75"></i>
                                        </div>
                                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                            <p class="text-white font-semibold">Vidéo</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="h-48 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                                        <div class="text-center">
                                            <i class="fas fa-file-audio text-blue-500 text-5xl mb-3"></i>
                                            <p class="font-semibold text-gray-700">Audio</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <p class="text-gray-700 mb-2">{{ $media->description }}</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas {{ $media->typeMedia->nom_media === 'image' ? 'fa-image' : ($media->typeMedia->nom_media === 'video' ? 'fa-video' : 'fa-music') }} mr-2"></i>
                                        {{ strtoupper($media->typeMedia->nom_media) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Section commentaires -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Commentaires</h2>
                <div class="space-y-6">
                    <!-- Formulaire commentaire -->
                    @auth
                        <form class="mb-8">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr(auth()->user()->prenom, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <textarea rows="3" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 resize-none"
                                              placeholder="Partagez votre avis sur ce contenu..."></textarea>
                                    <div class="mt-3 flex justify-between items-center">
                                        <div class="flex items-center space-x-4">
                                            <button type="button" class="text-gray-500 hover:text-orange-600">
                                                <i class="fas fa-smile"></i>
                                            </button>
                                            <button type="button" class="text-gray-500 hover:text-orange-600">
                                                <i class="fas fa-image"></i>
                                            </button>
                                        </div>
                                        <button type="submit" 
                                                class="px-6 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-red-600 transition-all">
                                            Commenter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                            <i class="fas fa-comments text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-4">Connectez-vous pour commenter ce contenu</p>
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-red-600 transition-all">
                                <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                            </a>
                        </div>
                    @endauth
                    
                    <!-- Liste commentaires -->
                    <div id="commentaires">
                        <!-- Les commentaires seront chargés ici -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose {
        line-height: 1.75;
    }
    .prose h2 {
        color: #1f2937;
        font-weight: 700;
        margin-top: 2em;
        margin-bottom: 1em;
    }
    .prose p {
        margin-bottom: 1.5em;
    }
    .prose img {
        border-radius: 0.5rem;
        margin: 2em auto;
    }
</style>
@endpush

@push('scripts')
<script>
    function genererPDF() {
        alert('Fonctionnalité PDF à implémenter prochainement');
        // Ici vous pourrez ajouter la génération PDF
    }
    
    // Charger les commentaires
    function chargerCommentaires() {
        fetch(`/api/contenus/{{ $contenu->id_contenu }}/commentaires`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('commentaires').innerHTML = data.html;
            })
            .catch(error => console.error('Erreur:', error));
    }
    
    // Charger au démarrage
    document.addEventListener('DOMContentLoaded', chargerCommentaires);
</script>
@endpush