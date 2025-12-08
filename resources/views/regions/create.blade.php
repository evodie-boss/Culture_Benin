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
            <h1 class="text-2xl font-bold text-gray-900">Ajouter une Région</h1>
            <p class="text-gray-600 mt-1">Nouvelle région béninoise</p>
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
                    <a href="{{ route('regions.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Régions</a>
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
                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nouvelle Région Béninoise</h2>
                <p class="text-gray-600 mt-2">Ajoutez une nouvelle région à la plateforme culturelle</p>
            </div>
        </div>
    </div>
    
    <form action="{{ route('regions.store') }}" method="POST">
        @csrf
        <div class="p-6">
            <!-- Nom de la région -->
            <div class="space-y-3 mb-6">
                <label for="nom_region" class="block text-sm font-semibold text-gray-700">
                    Nom de la région <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-flag text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nom_region') border-red-500 @enderror" 
                           id="nom_region" 
                           name="nom_region" 
                           value="{{ old('nom_region') }}" 
                           placeholder="Ex: Atlantique, Zou, Mono..." 
                           required>
                </div>
                @error('nom_region')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Nom complet de la région</p>
            </div>

            <!-- Description -->
            <div class="space-y-3 mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700">
                    Description <span class="text-gray-500 text-sm font-normal">(Optionnel)</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-align-left text-gray-400 text-lg mt-1"></i>
                    </div>
                    <textarea class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Description de la région...">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Informations complémentaires sur la région</p>
            </div>

            <!-- Population, Superficie et Localisation -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Population -->
                <div class="space-y-3">
                    <label for="population" class="block text-sm font-semibold text-gray-700">
                        Population
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-users text-gray-400 text-lg"></i>
                        </div>
                        <input type="number" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('population') border-red-500 @enderror" 
                               id="population" 
                               name="population" 
                               value="{{ old('population') }}" 
                               placeholder="Ex: 1400000">
                    </div>
                    @error('population')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror>
                    <p class="text-gray-500 text-sm">Nombre d'habitants</p>
                </div>

                <!-- Superficie -->
                <div class="space-y-3">
                    <label for="superficie" class="block text-sm font-semibold text-gray-700">
                        Superficie (km²)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-ruler-combined text-gray-400 text-lg"></i>
                        </div>
                        <input type="number"
                               step="0.01"
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('superficie') border-red-500 @enderror" 
                               id="superficie" 
                               name="superficie" 
                               value="{{ old('superficie') }}" 
                               placeholder="Ex: 3233">
                    </div>
                    @error('superficie')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror>
                    <p class="text-gray-500 text-sm">Superficie en kilomètres carrés</p>
                </div>

                <!-- Localisation -->
                <div class="space-y-3">
                    <label for="localisation" class="block text-sm font-semibold text-gray-700">
                        Localisation
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-400 text-lg"></i>
                        </div>
                        <input type="text" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('localisation') border-red-500 @enderror" 
                               id="localisation" 
                               name="localisation" 
                               value="{{ old('localisation') }}" 
                               placeholder="Ex: Sud du Bénin">
                    </div>
                    @error('localisation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror>
                    <p class="text-gray-500 text-sm">Position géographique</p>
                </div>
            </div>
        </div>
        
        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('regions.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour à la liste
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-3"></i>
                    Enregistrer la région
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Scripts pour les interactions -->
<script>
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

    // Effets sur les champs de formulaire
    const inputs = document.querySelectorAll('input, textarea');
    
    inputs.forEach(input => {
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
    });

    // Confirmation avant soumission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const nomRegion = document.getElementById('nom_region').value;
        
        if (!nomRegion) {
            e.preventDefault();
            alert('Veuillez remplir le nom de la région');
            return;
        }
    });

    // Amélioration de l'expérience utilisateur pour les inputs
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.backgroundColor = '#f9fafb';
        });
        
        input.addEventListener('blur', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>

<!-- Styles personnalisés supplémentaires -->
<style>
/* Animation pour les champs obligatoires */
input:required, textarea:required {
    background-image: linear-gradient(45deg, transparent 95%, #ef4444 95%);
    background-size: 8px 8px;
    background-position: right top;
    background-repeat: no-repeat;
}

/* Transition douce pour tous les éléments interactifs */
input, textarea, button, a {
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
input:focus, textarea:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
}

/* Style spécifique pour les champs nombre */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    opacity: 1;
    margin-left: 8px;
}

/* Pour les textareas */
textarea {
    resize: vertical;
    min-height: 100px;
}
</style>
@endsection