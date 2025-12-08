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
            <h1 class="text-2xl font-bold text-gray-900">Modifier le Contenu</h1>
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
                    <a href="{{ route('contenus.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Contenus</a>
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
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Modifier : {{ $contenu->titre }}</h2>
                    <p class="text-gray-600 mt-2">Mettez à jour les informations de ce contenu</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-xl px-4 py-2 shadow-md border">
                    <span class="text-sm text-gray-600">ID: </span>
                    <span class="font-mono font-bold text-blue-600 text-lg">#{{ $contenu->id_contenu }}</span>
                </div>
                <!-- AJOUT: Badge premium -->
                @if($contenu->est_premium && $contenu->type_acces === 'payant')
                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl px-4 py-2 shadow-md">
                        <span class="text-sm text-white">
                            <i class="fas fa-crown mr-1"></i> Premium
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <form action="{{ route('contenus.update', $contenu->id_contenu) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6">
            <!-- Titre et Type de contenu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Titre du contenu -->
                <div class="space-y-3">
                    <label for="titre" class="block text-sm font-semibold text-gray-700">
                        Titre du contenu <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-heading text-gray-400 text-lg"></i>
                        </div>
                        <input type="text" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('titre') border-red-500 @enderror" 
                               id="titre" 
                               name="titre" 
                               value="{{ old('titre', $contenu->titre) }}" 
                               placeholder="Titre du contenu..."
                               required>
                    </div>
                    @error('titre')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Titre principal du contenu</p>
                </div>

                <!-- Type de contenu -->
                <div class="space-y-3">
                    <label for="id_type_contenu" class="block text-sm font-semibold text-gray-700">
                        Type de Contenu <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-list text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_type_contenu') border-red-500 @enderror" 
                                id="id_type_contenu" 
                                name="id_type_contenu" 
                                required>
                            <option value="">Sélectionnez</option>
                            @foreach($typeContenus as $type)
                                <option value="{{ $type->id_type_contenu }}" 
                                    {{ old('id_type_contenu', $contenu->id_type_contenu) == $type->id_type_contenu ? 'selected' : '' }}>
                                    {{ $type->nom_contenu }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_type_contenu')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Catégorie du contenu</p>
                </div>
            </div>

            <!-- Texte du contenu -->
            <div class="space-y-3 mb-6">
                <label for="texte" class="block text-sm font-semibold text-gray-700">
                    Texte <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-align-left text-gray-400 text-lg mt-1"></i>
                    </div>
                    <textarea class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('texte') border-red-500 @enderror" 
                              id="texte" 
                              name="texte" 
                              rows="6" 
                              placeholder="Saisissez le contenu ici..." 
                              required>{{ old('texte', $contenu->texte) }}</textarea>
                </div>
                @error('texte')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Auteur et Région -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Auteur -->
                <div class="space-y-3">
                    <label for="id_auteur" class="block text-sm font-semibold text-gray-700">
                        Auteur <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_auteur') border-red-500 @enderror" 
                                id="id_auteur" 
                                name="id_auteur" 
                                required>
                            <option value="">Sélectionnez</option>
                            @foreach($auteurs as $auteur)
                                <option value="{{ $auteur->id_utilisateur }}" 
                                    {{ old('id_auteur', $contenu->id_auteur) == $auteur->id_utilisateur ? 'selected' : '' }}>
                                    {{ $auteur->prenom }} {{ $auteur->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_auteur')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Région -->
                <div class="space-y-3">
                    <label for="id_region" class="block text-sm font-semibold text-gray-700">
                        Région <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-map text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_region') border-red-500 @enderror" 
                                id="id_region" 
                                name="id_region" 
                                required>
                            <option value="">Sélectionnez</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id_region }}" 
                                    {{ old('id_region', $contenu->id_region) == $region->id_region ? 'selected' : '' }}>
                                    {{ $region->nom_region }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_region')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Langue et Statut -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Langue -->
                <div class="space-y-3">
                    <label for="id_langue" class="block text-sm font-semibold text-gray-700">
                        Langue <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-language text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_langue') border-red-500 @enderror" 
                                id="id_langue" 
                                name="id_langue" 
                                required>
                            <option value="">Sélectionnez</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}" 
                                    {{ old('id_langue', $contenu->id_langue) == $langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_langue')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div class="space-y-3">
                    <label for="statut" class="block text-sm font-semibold text-gray-700">
                        Statut
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-check-circle text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('statut') border-red-500 @enderror" 
                                id="statut" 
                                name="statut">
                            <option value="brouillon" {{ old('statut', $contenu->statut) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            <option value="en_attente" {{ old('statut', $contenu->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="validé" {{ old('statut', $contenu->statut) == 'validé' ? 'selected' : '' }}>Validé</option>
                            <option value="rejeté" {{ old('statut', $contenu->statut) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                    </div>
                    @error('statut')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- AJOUT: SECTION PREMIUM -->
            <div class="mt-8 mb-6">
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-crown text-amber-500 mr-3"></i>
                        Configuration Premium
                    </h3>
                    <p class="text-gray-600 mb-6">Configurez les options d'accès pour ce contenu</p>
                    
                    <!-- Type d'accès -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="space-y-3">
                            <label for="type_acces" class="block text-sm font-semibold text-gray-700">
                                Type d'accès <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-unlock-alt text-gray-400 text-lg"></i>
                                </div>
                                <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('type_acces') border-red-500 @enderror" 
                                        id="type_acces" 
                                        name="type_acces" 
                                        required>
                                    @foreach($typesAcces as $value => $label)
                                        <option value="{{ $value }}" {{ old('type_acces', $contenu->type_acces) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type_acces')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Durée d'accès -->
                        <div class="space-y-3">
                            <label for="duree_acces" class="block text-sm font-semibold text-gray-700">
                                Durée d'accès
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400 text-lg"></i>
                                </div>
                                <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('duree_acces') border-red-500 @enderror" 
                                        id="duree_acces" 
                                        name="duree_acces">
                                    @foreach($dureesAcces as $value => $label)
                                        <option value="{{ $value }}" {{ old('duree_acces', $contenu->duree_acces) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('duree_acces')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Prix et Devise -->
                    <div id="premium-fields" class="{{ old('type_acces', $contenu->type_acces) === 'payant' ? '' : 'hidden' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Prix -->
                            <div class="space-y-3">
                                <label for="prix" class="block text-sm font-semibold text-gray-700">
                                    Prix <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="number" 
                                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('prix') border-red-500 @enderror" 
                                           id="prix" 
                                           name="prix" 
                                           value="{{ old('prix', $contenu->prix) }}" 
                                           min="0" 
                                           step="0.01"
                                           placeholder="0.00"
                                           {{ old('type_acces', $contenu->type_acces) === 'payant' ? 'required' : '' }}>
                                </div>
                                @error('prix')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm">Prix en {{ $contenu->devise ?? 'XOF' }}</p>
                            </div>

                            <!-- Devise -->
                            <div class="space-y-3">
                                <label for="devise" class="block text-sm font-semibold text-gray-700">
                                    Devise <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-money-bill-wave text-gray-400 text-lg"></i>
                                    </div>
                                    <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('devise') border-red-500 @enderror" 
                                            id="devise" 
                                            name="devise"
                                            {{ old('type_acces', $contenu->type_acces) === 'payant' ? 'required' : '' }}>
                                        @foreach($devises as $value => $label)
                                            <option value="{{ $value }}" {{ old('devise', $contenu->devise) == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('devise')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Aperçu -->
                        <div class="space-y-3 mb-6">
                            <label for="apercu" class="block text-sm font-semibold text-gray-700">
                                Aperçu (pour contenus payants)
                            </label>
                            <div class="relative">
                                <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                                    <i class="fas fa-eye text-gray-400 text-lg mt-1"></i>
                                </div>
                                <textarea class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('apercu') border-red-500 @enderror" 
                                          id="apercu" 
                                          name="apercu" 
                                          rows="3" 
                                          placeholder="Texte d'aperçu qui sera affiché avant l'achat... (maximum 200 caractères)">{{ old('apercu', $contenu->apercu) }}</textarea>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500">
                                    <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                    Si vide, les premiers 200 caractères du contenu seront utilisés
                                </p>
                                <span id="apercu-count" class="text-xs text-gray-500">0/200</span>
                            </div>
                            @error('apercu')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations du contenu -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-4"></i>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-3">Informations du contenu</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-blue-800">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag mr-3 text-blue-600"></i>
                                <span><strong>ID :</strong> #{{ $contenu->id_contenu }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-plus mr-3 text-blue-600"></i>
                                <span><strong>Créé le :</strong> 
                                    {{ $contenu->date_creation ? $contenu->date_creation->format('d/m/Y H:i') : 'N/A' }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-3 text-blue-600"></i>
                                <span><strong>Dernière modification :</strong> 
                                    {{ $contenu->updated_at ? $contenu->updated_at->format('d/m/Y H:i') : 'Non modifié' }}
                                </span>
                            </div>
                            <!-- AJOUT: Information premium -->
                            <div class="flex items-center">
                                <i class="fas fa-{{ $contenu->est_premium ? 'crown text-amber-600' : 'unlock text-green-600' }} mr-3"></i>
                                <span><strong>Statut :</strong> 
                                    {{ $contenu->est_premium ? 'Contenu Premium' : 'Contenu Gratuit' }}
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
                <a href="{{ route('contenus.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Annuler
                </a>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('contenus.show', $contenu->id_contenu) }}" 
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

    // Gestion de l'affichage/masquage des champs premium
    const typeAccesSelect = document.getElementById('type_acces');
    const premiumFields = document.getElementById('premium-fields');
    const prixInput = document.getElementById('prix');
    const deviseSelect = document.getElementById('devise');
    
    function togglePremiumFields() {
        if (typeAccesSelect.value === 'payant') {
            premiumFields.classList.remove('hidden');
            prixInput.required = true;
            deviseSelect.required = true;
        } else {
            premiumFields.classList.add('hidden');
            prixInput.required = false;
            deviseSelect.required = false;
        }
    }
    
    // Initialiser l'état
    togglePremiumFields();
    
    // Écouter les changements
    typeAccesSelect.addEventListener('change', togglePremiumFields);
    
    // Compteur de caractères pour l'aperçu
    const apercuTextarea = document.getElementById('apercu');
    const apercuCount = document.getElementById('apercu-count');
    
    if (apercuTextarea && apercuCount) {
        function updateApercuCount() {
            const count = apercuTextarea.value.length;
            apercuCount.textContent = `${count}/200`;
            
            if (count > 200) {
                apercuCount.classList.add('text-red-500');
                apercuCount.classList.remove('text-gray-500');
            } else if (count > 190) {
                apercuCount.classList.add('text-amber-500');
                apercuCount.classList.remove('text-gray-500', 'text-red-500');
            } else {
                apercuCount.classList.remove('text-red-500', 'text-amber-500');
                apercuCount.classList.add('text-gray-500');
            }
        }
        
        // Initialiser le compteur
        updateApercuCount();
        
        // Mettre à jour à chaque saisie
        apercuTextarea.addEventListener('input', function() {
            // Limiter à 200 caractères
            if (this.value.length > 200) {
                this.value = this.value.substring(0, 200);
                showToast('L\'aperçu est limité à 200 caractères', 'warning');
            }
            updateApercuCount();
        });
    }
    
    // Effets sur les champs de formulaire
    const inputs = document.querySelectorAll('input, textarea, select');
    let formChanged = false;
    const initialValues = {
        titre: document.getElementById('titre').value,
        id_type_contenu: document.getElementById('id_type_contenu').value,
        texte: document.getElementById('texte').value,
        id_auteur: document.getElementById('id_auteur').value,
        id_region: document.getElementById('id_region').value,
        id_langue: document.getElementById('id_langue').value,
        statut: document.getElementById('statut').value,
        type_acces: document.getElementById('type_acces').value,
        prix: document.getElementById('prix').value,
        devise: document.getElementById('devise').value,
        duree_acces: document.getElementById('duree_acces').value,
        apercu: apercuTextarea ? apercuTextarea.value : ''
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
    form.addEventListener('submit', function(e) {
        // Validation supplémentaire pour les contenus payants
        if (typeAccesSelect.value === 'payant') {
            if (!prixInput.value || parseFloat(prixInput.value) <= 0) {
                e.preventDefault();
                prixInput.classList.add('border-red-500');
                showToast('Veuillez entrer un prix valide pour les contenus payants', 'error');
                return;
            }
        }
        
        formChanged = false;
    });

    // Avertissement si tentative de quitter avec modifications
    const cancelLink = document.querySelector('a[href="{{ route('contenus.index') }}"]');
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

    // Fonction pour afficher des notifications toast
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-xl shadow-xl z-50 animate-fade-in-up ${
            type === 'error' ? 'bg-red-500 text-white' : 
            type === 'warning' ? 'bg-amber-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});

// Animation pour les notifications
const style = document.createElement('style');
style.textContent = `
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out;
    }
`;
document.head.appendChild(style);
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
    min-height: 150px;
}

/* Style pour la section premium */
#premium-fields {
    transition: all 0.3s ease;
}
</style>
@endsection