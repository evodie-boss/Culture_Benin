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
            <h1 class="text-2xl font-bold text-gray-900">Ajouter un Rôle</h1>
            <p class="text-gray-600 mt-1">Nouveau rôle utilisateur</p>
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
                    <a href="{{ route('roles.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Rôles</a>
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
                <i class="fas fa-user-shield text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nouveau Rôle Utilisateur</h2>
                <p class="text-gray-600 mt-2">Ajoutez un nouveau rôle à la plateforme</p>
            </div>
        </div>
    </div>
    
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="p-6">
            <!-- Nom du rôle -->
            <div class="space-y-3 mb-6">
                <label for="nom_role" class="block text-sm font-semibold text-gray-700">
                    Nom du rôle <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user-tag text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nom_role') border-red-500 @enderror" 
                           id="nom_role" 
                           name="nom_role" 
                           value="{{ old('nom_role') }}" 
                           placeholder="Ex: Administrateur, Éditeur, Visiteur..." 
                           required>
                </div>
                @error('nom_role')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Nom complet du rôle</p>
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
                              rows="5" 
                              placeholder="Décrivez ce rôle : permissions, accès, responsabilités...">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Informations complémentaires sur le rôle</p>
            </div>
        </div>
        
        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('roles.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour à la liste
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-3"></i>
                    Enregistrer le rôle
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
        const nomRole = document.getElementById('nom_role').value;
        
        if (!nomRole) {
            e.preventDefault();
            alert('Veuillez remplir le nom du rôle');
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

/* Pour les textareas */
textarea {
    resize: vertical;
    min-height: 150px;
}
</style>
@endsection