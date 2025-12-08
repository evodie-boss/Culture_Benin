@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-edit text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Modifier le Type de Contenu</h1>
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
                    <a href="{{ route('type-contenus.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Types de Contenu</a>
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
                    <i class="fas fa-layer-group text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Modifier un type de contenu</h2>
                    <p class="text-gray-600 mt-2">Mettez à jour les informations du type de contenu</p>
                </div>
            </div>
            <div class="bg-white rounded-xl px-4 py-2 shadow-md border">
                <span class="text-sm text-gray-600">ID: </span>
                <span class="font-mono font-bold text-blue-600 text-lg">#{{ $typeContenu->id_type_contenu }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('type-contenus.update', $typeContenu->id_type_contenu) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6">
            <!-- Nom du type de contenu -->
            <div class="space-y-3 mb-6">
                <label for="nom_contenu" class="block text-sm font-semibold text-gray-700">
                    Nom du type de contenu <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-file-alt text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nom_contenu') border-red-500 @enderror" 
                           id="nom_contenu" 
                           name="nom_contenu" 
                           value="{{ old('nom_contenu', $typeContenu->nom_contenu) }}" 
                           placeholder="Ex: Article, Vidéo, Podcast…" 
                           required>
                </div>
                @error('nom_contenu')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Nom de la catégorie pour classer les contenus culturels</p>
            </div>

            <!-- Informations du type de contenu -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-3">Informations du type de contenu</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-blue-800">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag mr-3 text-blue-600"></i>
                                <span><strong>ID :</strong> #{{ $typeContenu->id_type_contenu }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-3 text-blue-600"></i>
                                <span><strong>Dernière modification :</strong> 
                                    {{ $typeContenu->updated_at ? $typeContenu->updated_at->format('d/m/Y H:i') : 'Non modifié' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-plus mr-3 text-blue-600"></i>
                                <span><strong>Créé le :</strong> 
                                    {{ $typeContenu->created_at ? $typeContenu->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-cubes mr-3 text-blue-600"></i>
                                <span><strong>Statut :</strong> 
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Actif
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suggestions de types de contenu -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-5">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-yellow-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-yellow-900 mb-3">Suggestions de catégories</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-yellow-800">
                            <div class="flex items-center">
                                <i class="fas fa-book mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="document.getElementById('nom_contenu').value = 'Histoire traditionnelle'">Histoire traditionnelle</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-utensils mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="document.getElementById('nom_contenu').value = 'Recette culinaire'">Recette culinaire</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-music mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="document.getElementById('nom_contenu').value = 'Chant traditionnel'">Chant traditionnel</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-dance mr-3 text-yellow-600"></i>
                                <span class="cursor-pointer hover:bg-yellow-100 px-2 py-1 rounded transition-colors" onclick="document.getElementById('nom_contenu').value = 'Danse traditionnelle'">Danse traditionnelle</span>
                            </div>
                        </div>
                        <p class="text-yellow-700 text-xs mt-3">
                            Cliquez sur une suggestion pour la sélectionner automatiquement.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('type-contenus.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour
                </a>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('type-contenus.show', $typeContenu->id_type_contenu) }}" 
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

    // Effets sur le champ de formulaire
    const input = document.getElementById('nom_contenu');
    let formChanged = false;
    const initialValue = input.value;

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
        
        // Vérifier si la valeur a changé
        if (currentValue !== initialValue) {
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

    // Suggestion rapide au clic sur les exemples
    const suggestions = document.querySelectorAll('.text-yellow-800 span');
    suggestions.forEach(suggestion => {
        suggestion.addEventListener('click', function() {
            input.value = this.textContent;
            input.focus();
            formChanged = true;
            
            // Animation de feedback
            input.classList.add('border-green-500', 'bg-green-50');
            setTimeout(() => {
                input.classList.remove('border-green-500', 'bg-green-50');
                input.classList.add('border-yellow-400', 'bg-yellow-50');
            }, 1000);
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
    const cancelLink = document.querySelector('a[href="{{ route('type-contenus.index') }}"]');
    cancelLink.addEventListener('click', function(e) {
        if (formChanged) {
            const confirmLeave = confirm('Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?');
            if (!confirmLeave) {
                e.preventDefault();
            }
        }
    });

    // Validation avant soumission
    form.addEventListener('submit', function(e) {
        const nomContenu = document.getElementById('nom_contenu').value;
        
        if (!nomContenu) {
            e.preventDefault();
            alert('Veuillez saisir un nom pour le type de contenu');
            input.classList.add('border-red-500');
            input.focus();
            return;
        }

        // Validation de la longueur
        if (nomContenu.length < 3) {
            e.preventDefault();
            alert('Le nom du type de contenu doit contenir au moins 3 caractères');
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

/* Icônes personnalisées */
.fa-dance {
    background: linear-gradient(45deg, #ec4899, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
@endsection