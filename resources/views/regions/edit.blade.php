@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-map text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Modifier la Région</h1>
            <p class="text-gray-600 mt-1">Mise à jour des informations</p>
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
                    <span class="ml-1 text-blue-600 font-medium">Modifier</span>
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
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center mb-4 sm:mb-0">
                <div class="bg-white p-3 rounded-xl shadow-md mr-4">
                    <i class="fas fa-edit text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Modifier la région #{{ $region->id_region }}</h2>
                    <p class="text-gray-600 mt-2">Mettez à jour les informations de cette région</p>
                </div>
            </div>
            <div class="bg-white rounded-xl px-4 py-2 shadow-md border">
                <span class="text-sm text-gray-600">ID: </span>
                <span class="font-semibold text-blue-600">#{{ $region->id_region }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('regions.update', $region->id_region) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6">
            <!-- Nom de la région -->
            <div class="space-y-3 mb-6">
                <label for="nom_region" class="block text-sm font-semibold text-gray-700">
                    Nom de la région <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400 text-lg mt-1"></i>
                    </div>
                    <input type="text" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nom_region') border-red-500 @enderror" 
                           id="nom_region" 
                           name="nom_region" 
                           value="{{ old('nom_region', $region->nom_region) }}"
                           placeholder="Ex : Atlantique" 
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
                    Description <span class="text-gray-500 text-sm font-normal">(Optionnelle)</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-align-left text-gray-400 text-lg mt-1"></i>
                    </div>
                    <textarea class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Description de la région...">{{ old('description', $region->description) }}</textarea>
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
                               value="{{ old('population', $region->population) }}"
                               placeholder="Ex : 1200000">
                    </div>
                    @error('population')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
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
                               value="{{ old('superficie', $region->superficie) }}"
                               placeholder="Ex : 45.30">
                    </div>
                    @error('superficie')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Localisation -->
                <div class="space-y-3">
                    <label for="localisation" class="block text-sm font-semibold text-gray-700">
                        Localisation
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-location-dot text-gray-400 text-lg"></i>
                        </div>
                        <input type="text" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('localisation') border-red-500 @enderror" 
                               id="localisation" 
                               name="localisation" 
                               value="{{ old('localisation', $region->localisation) }}"
                               placeholder="Ex : Sud du Bénin">
                    </div>
                    @error('localisation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Informations de la région -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-3">Informations sur la région</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-blue-800">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag mr-3 text-blue-600"></i>
                                <span><strong>ID :</strong> #{{ $region->id_region }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-3 text-blue-600"></i>
                                <span><strong>Modifié le :</strong> 
                                    {{ $region->updated_at ? $region->updated_at->format('d/m/Y H:i') : 'Non modifié' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-plus mr-3 text-blue-600"></i>
                                <span><strong>Créé le :</strong> 
                                    {{ $region->created_at ? $region->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map mr-3 text-blue-600"></i>
                                <span><strong>Nom actuel :</strong> 
                                    {{ $region->nom_region ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('regions.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour
                </a>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('regions.show', $region->id_region) }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-blue-300 text-base font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg order-2 sm:order-1">
                        <i class="fas fa-eye mr-3"></i>
                        Voir
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl order-1 sm:order-2">
                        <i class="fas fa-save mr-3"></i>
                        Mettre à jour
                    </button>
                </div>
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
    let formChanged = false;
    const initialValues = {
        nom_region: document.getElementById('nom_region').value,
        description: document.getElementById('description').value,
        population: document.getElementById('population').value,
        superficie: document.getElementById('superficie').value,
        localisation: document.getElementById('localisation').value
    };

    inputs.forEach(input => {
        // Effet au focus
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-200', 'ring-opacity-50');
        });
        
        // Effet à la perte du focus
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-200', 'ring-opacity-50');
        });

        // Détection des modifications
        input.addEventListener('input', function() {
            const currentValue = this.value;
            const fieldName = this.name;
            
            // Vérifier si la valeur a changé
            if (currentValue !== initialValues[fieldName]) {
                formChanged = true;
                this.classList.add('border-yellow-400', 'bg-yellow-50');
            } else {
                this.classList.remove('border-yellow-400', 'bg-yellow-50');
            }

            // Validation en temps réel
            if (this.checkValidity()) {
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
            } else {
                this.classList.remove('border-green-500');
            }
        });
    });

    // Confirmation avant de quitter si modifications
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
            return e.returnValue;
        }
    });

    // Réinitialiser le flag quand le formulaire est soumis
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        formChanged = false;
    });

    // Avertissement si tentative de quitter avec modifications
    const cancelLink = document.querySelector('a[href="{{ route('regions.index') }}"]');
    cancelLink.addEventListener('click', function(e) {
        if (formChanged) {
            const confirmLeave = confirm('Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?');
            if (!confirmLeave) {
                e.preventDefault();
            }
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
/* Animation pour les champs modifiés */
.border-yellow-400 {
    border-color: #fbbf24 !important;
    background-color: #fffbeb !important;
}

/* Indicateur pour les champs obligatoires */
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

/* Style pour la section d'information */
.bg-blue-50 {
    background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%);
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

/* Pour les textareas */
textarea {
    resize: vertical;
    min-height: 120px;
}

/* Style spécifique pour les champs nombre */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    opacity: 1;
    margin-left: 8px;
}
</style>
@endsection