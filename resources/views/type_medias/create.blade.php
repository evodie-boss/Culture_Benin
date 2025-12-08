@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-plus-circle text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Ajouter un Type de Média</h1>
            <p class="text-gray-600 mt-1">Nouvelle catégorie de média</p>
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
                    <a href="{{ route('type-medias.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Types de Média</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-blue-600 font-medium">Ajouter</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <!-- En-tête du formulaire -->
    <div class="bg-gradient-to-r from-blue-50 to-green-50 px-6 py-5 border-b border-gray-200">
        <div class="flex items-center">
            <div class="bg-white p-3 rounded-xl shadow-md mr-4">
                <i class="fas fa-folder-plus text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nouvelle Catégorie de Média</h2>
                <p class="text-gray-600 mt-2">Remplissez le formulaire pour ajouter un nouveau type de média culturel</p>
            </div>
        </div>
    </div>

    <form action="{{ route('type-medias.store') }}" method="POST">
        @csrf
        <div class="p-6">
            <!-- Nom du type de média -->
            <div class="space-y-3 mb-6">
                <label for="nom_media" class="block text-sm font-semibold text-gray-700">
                    Nom du type de média <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-folder text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nom_media') border-red-500 @enderror" 
                           id="nom_media" 
                           name="nom_media" 
                           value="{{ old('nom_media') }}" 
                           placeholder="Ex: Image, Vidéo, Audio, Document..." 
                           required>
                </div>
                @error('nom_media')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">
                    Cette catégorie sera utilisée pour classer les médias culturels
                </p>
            </div>

            <!-- Suggestions de types de média -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-5 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-yellow-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-yellow-900 mb-3">Suggestions de types de média</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-yellow-800">
                            <div class="flex items-center">
                                <i class="fas fa-image mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="selectSuggestion('Image')">Image</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-video mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="selectSuggestion('Vidéo')">Vidéo</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-music mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="selectSuggestion('Audio')">Audio</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-file-pdf mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="selectSuggestion('Document')">Document</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-photo-video mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="selectSuggestion('Multimédia')">Multimédia</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-podcast mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="selectSuggestion('Podcast')">Podcast</span>
                            </div>
                        </div>
                        <p class="text-yellow-700 text-xs mt-3">
                            Cliquez sur une suggestion pour la sélectionner automatiquement.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations sur les types de média -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-2">À propos des types de média</h4>
                        <div class="space-y-2 text-blue-800 text-sm leading-relaxed">
                            <p>
                                Les types de média permettent d'organiser et de catégoriser les différents supports 
                                multimédias utilisés pour illustrer les contenus culturels.
                            </p>
                            <p>
                                Chaque type représente un format spécifique comme les images, vidéos, audios, 
                                ou documents qui enrichissent la présentation du patrimoine culturel béninois.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('type-medias.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour à la liste
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-3"></i>
                    Enregistrer le type
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Scripts pour les interactions -->
<script>
function selectSuggestion(value) {
    const input = document.getElementById('nom_media');
    input.value = value;
    input.focus();
    
    // Animation de feedback
    input.classList.add('border-green-500', 'bg-green-50');
    setTimeout(() => {
        input.classList.remove('border-green-500', 'bg-green-50');
    }, 1000);
}

document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée
    const formCard = document.querySelector('.bg-white');
    formCard.style.opacity = '0';
    formCard.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        formCard.style.transition = 'all 0.5s ease';
        formCard.style.opacity = '1';
        formCard.style.transform = 'translateY(0)';
    }, 100);

    // Effets sur le champ de formulaire
    const input = document.getElementById('nom_media');
    
    // Effet au focus
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('ring-2', 'ring-blue-200', 'ring-opacity-50');
    });
    
    // Effet à la perte du focus
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('ring-2', 'ring-blue-200', 'ring-opacity-50');
    });

    // Validation en temps réel
    input.addEventListener('input', function() {
        if (this.checkValidity()) {
            this.classList.remove('border-red-500');
            this.classList.add('border-green-500');
        } else {
            this.classList.remove('border-green-500');
        }
    });

    // Confirmation avant soumission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const nomMedia = document.getElementById('nom_media').value;
        
        if (!nomMedia) {
            e.preventDefault();
            alert('Veuillez saisir un nom pour le type de média');
            input.classList.add('border-red-500');
            input.focus();
            return;
        }

        // Validation de la longueur
        if (nomMedia.length < 2) {
            e.preventDefault();
            alert('Le nom du type de média doit contenir au moins 2 caractères');
            input.classList.add('border-red-500');
            input.focus();
            return;
        }
    });

    // Amélioration de l'expérience utilisateur
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.dispatchEvent(new Event('submit', { cancelable: true }));
        }
    });

    // Animation pour les suggestions
    const suggestions = document.querySelectorAll('.text-yellow-800 span');
    suggestions.forEach((suggestion, index) => {
        suggestion.style.opacity = '0';
        suggestion.style.transform = 'translateX(-10px)';
        
        setTimeout(() => {
            suggestion.style.transition = 'all 0.3s ease';
            suggestion.style.opacity = '1';
            suggestion.style.transform = 'translateX(0)';
        }, index * 100);
    });
});
</script>

<!-- Styles personnalisés supplémentaires -->
<style>
/* Animation pour les champs obligatoires */
input:required {
    background-image: linear-gradient(45deg, transparent 95%, #ef4444 95%);
    background-size: 8px 8px;
    background-position: right top;
    background-repeat: no-repeat;
}

/* Transition douce pour tous les éléments interactifs */
input, button, a {
    transition: all 0.2s ease-in-out;
}

/* Style pour les erreurs de validation */
.border-red-500 {
    border-color: #ef4444 !important;
}

.border-red-500:focus {
    ring-color: #fecaca !important;
}

/* Amélioration de l'apparence des placeholders */
::placeholder {
    color: #9ca3af;
    opacity: 1;
}

/* Style pour les inputs focus */
input:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
}

/* Style pour les suggestions cliquables */
.text-yellow-800 span {
    cursor: pointer;
    border-radius: 4px;
    transition: all 0.2s ease;
}

/* Icônes personnalisées pour les médias */
.fa-photo-video {
    background: linear-gradient(45deg, #ec4899, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.fa-podcast {
    background: linear-gradient(45deg, #f59e0b, #d97706);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Animation pour le feedback des suggestions */
.bg-green-50 {
    transition: background-color 0.3s ease;
}

/* Amélioration de la typographie dans les sections d'information */
.text-blue-800 p {
    margin-bottom: 0.5rem;
}

.text-blue-800 p:last-child {
    margin-bottom: 0;
}
</style>
@endsection