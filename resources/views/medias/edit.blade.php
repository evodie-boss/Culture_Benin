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
            <h1 class="text-2xl font-bold text-gray-900">Modifier le Média</h1>
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
                    <a href="{{ route('admin.medias.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Médias</a>
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
                    <h2 class="text-xl font-bold text-gray-900">Modifier le média #{{ $media->id_media }}</h2>
                    <p class="text-gray-600 mt-2">Mettre à jour les informations concernant ce média</p>
                </div>
            </div>
            <div class="bg-white rounded-xl px-4 py-2 shadow-md border">
                <span class="text-sm text-gray-600">ID: </span>
                <span class="font-semibold text-blue-600">#{{ $media->id_media }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.medias.update', $media->id_media) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6">
            <!-- Chemin/Fichier -->
            <div class="space-y-3 mb-6">
                <label for="chemin" class="block text-sm font-semibold text-gray-700">
                    Chemin/Fichier <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-file-image text-gray-400 text-lg mt-1"></i>
                    </div>
                    <input type="text" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('chemin') border-red-500 @enderror" 
                           id="chemin" 
                           name="chemin" 
                           value="{{ old('chemin', $media->chemin) }}"
                           placeholder="Ex : uploads/images/photo.png" 
                           required>
                </div>
                @error('chemin')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Chemin d'accès au fichier média</p>
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
                              placeholder="Décrivez le média...">{{ old('description', $media->description) }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Description du contenu du média</p>
            </div>

            <!-- Contenu associé et Type de média -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Contenu associé -->
                <div class="space-y-3">
                    <label for="id_contenu" class="block text-sm font-semibold text-gray-700">
                        Contenu associé <span class="text-red-500">*</span>
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
                                <option value="{{ $contenu->id_contenu }}" 
                                    {{ old('id_contenu', $media->id_contenu) == $contenu->id_contenu ? 'selected' : '' }}>
                                    {{ $contenu->titre }} ({{ $contenu->typeContenu->nom_contenu ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_contenu')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type de média -->
                <div class="space-y-3">
                    <label for="id_type_media" class="block text-sm font-semibold text-gray-700">
                        Type de média <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tags text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_type_media') border-red-500 @enderror" 
                                id="id_type_media" 
                                name="id_type_media" 
                                required>
                            <option value="">Sélectionnez un type</option>
                            @foreach($typeMedias as $type)
                                <option value="{{ $type->id_type_media }}" 
                                    {{ old('id_type_media', $media->id_type_media) == $type->id_type_media ? 'selected' : '' }}>
                                    {{ $type->nom_media }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_type_media')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Informations du média -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-3">Informations du média</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-blue-800">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag mr-3 text-blue-600"></i>
                                <span><strong>ID :</strong> #{{ $media->id_media }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-3 text-blue-600"></i>
                                <span><strong>Modifié le :</strong> 
                                    {{ $media->updated_at ? $media->updated_at->format('d/m/Y H:i') : 'Non modifié' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-plus mr-3 text-blue-600"></i>
                                <span><strong>Créé le :</strong> 
                                    {{ $media->created_at ? $media->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-file-image mr-3 text-blue-600"></i>
                                <span><strong>Type actuel :</strong> 
                                    {{ $media->typeMedia->nom_media ?? 'N/A' }}
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
                <a href="{{ route('admin.medias.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Annuler
                </a>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.medias.show', $media->id_media) }}" 
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
    const inputs = document.querySelectorAll('input, textarea, select');
    let formChanged = false;
    const initialValues = {
        chemin: document.getElementById('chemin').value,
        description: document.getElementById('description').value,
        id_contenu: document.getElementById('id_contenu').value,
        id_type_media: document.getElementById('id_type_media').value
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

        // Pour les selects
        input.addEventListener('change', function() {
            const currentValue = this.value;
            const fieldName = this.name;
            
            if (currentValue !== initialValues[fieldName]) {
                formChanged = true;
                this.classList.add('border-yellow-400', 'bg-yellow-50');
            } else {
                this.classList.remove('border-yellow-400', 'bg-yellow-50');
            }

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
    const cancelLink = document.querySelector('a[href="{{ route('admin.medias.index') }}"]');
    cancelLink.addEventListener('click', function(e) {
        if (formChanged) {
            const confirmLeave = confirm('Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?');
            if (!confirmLeave) {
                e.preventDefault();
            }
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
</style>
@endsection