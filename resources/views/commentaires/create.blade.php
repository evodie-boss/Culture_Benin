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
            <h1 class="text-2xl font-bold text-gray-900">Ajouter un Commentaire</h1>
            <p class="text-gray-600 mt-1">Nouveau commentaire</p>
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
                <i class="fas fa-comment-dots text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nouveau Commentaire</h2>
                <p class="text-gray-600 mt-2">Ajoutez un commentaire pour un contenu culturel</p>
            </div>
        </div>
    </div>

    <form action="{{ route('commentaires.store') }}" method="POST">
        @csrf
        <div class="p-6">
            <!-- Commentaire texte -->
            <div class="space-y-3 mb-6">
                <label for="texte" class="block text-sm font-semibold text-gray-700">
                    Commentaire <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-comment text-gray-400 text-lg mt-1"></i>
                    </div>
                    <textarea class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('texte') border-red-500 @enderror" 
                              id="texte" 
                              name="texte" 
                              rows="4" 
                              placeholder="Saisissez votre commentaire..." 
                              required>{{ old('texte') }}</textarea>
                </div>
                @error('texte')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Note -->
            <div class="space-y-3 mb-6">
                <label for="note" class="block text-sm font-semibold text-gray-700">
                    Note <span class="text-gray-500 text-sm font-normal">(Optionnelle)</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-star text-gray-400 text-lg"></i>
                    </div>
                    <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('note') border-red-500 @enderror" 
                            id="note" 
                            name="note">
                        <option value="">Sélectionnez une note</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('note') == $i ? 'selected' : '' }}>
                                {!! str_repeat('⭐', $i) !!} - {{ $i }}/5
                            </option>
                        @endfor
                    </select>
                </div>
                @error('note')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Évaluez le contenu de 1 à 5 étoiles</p>
            </div>

            <!-- Utilisateur et Contenu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Utilisateur -->
                <div class="space-y-3">
                    <label for="id_utilisateur" class="block text-sm font-semibold text-gray-700">
                        Utilisateur <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_utilisateur') border-red-500 @enderror" 
                                id="id_utilisateur" 
                                name="id_utilisateur" 
                                required>
                            <option value="">Sélectionnez un utilisateur</option>
                            @foreach($utilisateurs as $utilisateur)
                                <option value="{{ $utilisateur->id_utilisateur }}" {{ old('id_utilisateur') == $utilisateur->id_utilisateur ? 'selected' : '' }}>
                                    {{ $utilisateur->prenom }} {{ $utilisateur->nom }} ({{ $utilisateur->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_utilisateur')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contenu -->
                <div class="space-y-3">
                    <label for="id_contenu" class="block text-sm font-semibold text-gray-700">
                        Contenu <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-file-alt text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_contenu') border-red-500 @enderror" 
                                id="id_contenu" 
                                name="id_contenu" 
                                required>
                            <option value="">Sélectionnez un contenu</option>
                            @foreach($contenus as $contenu)
                                <option value="{{ $contenu->id_contenu }}" {{ old('id_contenu') == $contenu->id_contenu ? 'selected' : '' }}>
                                    {{ $contenu->titre }} ({{ $contenu->typeContenu->nom_contenu ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_contenu')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Aide contextuelle -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-yellow-500 text-lg mt-0.5 mr-3"></i>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-yellow-900 mb-1">Conseil</h4>
                        <p class="text-yellow-800 text-sm">
                            Les commentaires permettent aux utilisateurs de partager leurs impressions sur les contenus culturels.
                            Vous pouvez également attribuer une note pour évaluer la qualité du contenu.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('commentaires.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour à la liste
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-3"></i>
                    Enregistrer le commentaire
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
    const inputs = document.querySelectorAll('input, textarea, select');
    
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

        // Pour les selects
        input.addEventListener('change', function() {
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
        const requiredFields = ['texte', 'id_utilisateur', 'id_contenu'];
        let isValid = true;
        
        requiredFields.forEach(field => {
            const element = document.getElementById(field);
            if (!element.value) {
                isValid = false;
                element.classList.add('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs obligatoires');
            return;
        }
    });

    // Amélioration de l'expérience utilisateur pour les selects
    const selects = document.querySelectorAll('select');
    selects.forEach(select => {
        select.addEventListener('focus', function() {
            this.style.backgroundColor = '#f9fafb';
        });
        
        select.addEventListener('blur', function() {
            this.style.backgroundColor = '';
        });
    });

    // Aperçu de la note sélectionnée
    const noteSelect = document.getElementById('note');
    const notePreview = document.createElement('div');
    notePreview.className = 'mt-2 text-sm text-gray-600';
    noteSelect.parentNode.appendChild(notePreview);

    noteSelect.addEventListener('change', function() {
        const selectedNote = this.value;
        if (selectedNote) {
            notePreview.innerHTML = `<strong>Note sélectionnée :</strong> ${selectedNote}/5 ${'⭐'.repeat(selectedNote)}`;
            notePreview.className = 'mt-2 text-sm text-green-600 font-medium';
        } else {
            notePreview.innerHTML = '';
        }
    });
});
</script>

<!-- Styles personnalisés supplémentaires -->
<style>
/* Animation pour les champs obligatoires */
input:required, textarea:required, select:required {
    background-image: linear-gradient(45deg, transparent 95%, #ef4444 95%);
    background-size: 8px 8px;
    background-position: right top;
    background-repeat: no-repeat;
}

/* Transition douce pour tous les éléments interactifs */
input, textarea, select, button, a {
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
input:focus, textarea:focus, select:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
}

/* Amélioration des selects */
select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* Pour les textareas */
textarea {
    resize: vertical;
    min-height: 120px;
}

/* Style pour les étoiles dans les options */
option {
    font-size: 1.1em;
}
</style>
@endsection