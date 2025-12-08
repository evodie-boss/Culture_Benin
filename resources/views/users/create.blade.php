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
            <h1 class="text-2xl font-bold text-gray-900">Ajouter un Utilisateur</h1>
            <p class="text-gray-600 mt-1">Nouvel utilisateur de la plateforme</p>
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
                    <a href="{{ route('admin.users.index') }}" class="ml-1 text-gray-500 hover:text-blue-600">Utilisateurs</a>
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
                <i class="fas fa-user-plus text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nouvel Utilisateur</h2>
                <p class="text-gray-600 mt-2">Ajoutez un nouvel utilisateur à la plateforme</p>
            </div>
        </div>
    </div>
    
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="p-6">
            <!-- Informations personnelles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Prénom -->
                <div class="space-y-3">
                    <label for="prenom" class="block text-sm font-semibold text-gray-700">
                        Prénom <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-lg"></i>
                        </div>
                        <input type="text" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('prenom') border-red-500 @enderror" 
                               id="prenom" 
                               name="prenom" 
                               value="{{ old('prenom') }}" 
                               placeholder="Ex: Jean, Marie..." 
                               required>
                    </div>
                    @error('prenom')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Prénom de l'utilisateur</p>
                </div>

                <!-- Nom -->
                <div class="space-y-3">
                    <label for="nom" class="block text-sm font-semibold text-gray-700">
                        Nom <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-lg"></i>
                        </div>
                        <input type="text" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nom') border-red-500 @enderror" 
                               id="nom" 
                               name="nom" 
                               value="{{ old('nom') }}" 
                               placeholder="Ex: Dupont, Martin..." 
                               required>
                    </div>
                    @error('nom')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Nom de famille de l'utilisateur</p>
                </div>
            </div>

            <!-- Email et Téléphone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Email -->
                <div class="space-y-3">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 text-lg"></i>
                        </div>
                        <input type="email" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Ex: jean.dupont@email.com" 
                               required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Adresse email de l'utilisateur</p>
                </div>

                <!-- Téléphone -->
                <div class="space-y-3">
                    <label for="telephone" class="block text-sm font-semibold text-gray-700">
                        Téléphone <span class="text-gray-500 text-sm font-normal">(Optionnel)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400 text-lg"></i>
                        </div>
                        <input type="tel" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('telephone') border-red-500 @enderror" 
                               id="telephone" 
                               name="telephone" 
                               value="{{ old('telephone') }}" 
                               placeholder="Ex: +33 1 23 45 67 89">
                    </div>
                    @error('telephone')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Numéro de téléphone</p>
                </div>
            </div>

            <!-- Sexe et Date de naissance -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Sexe -->
                <div class="space-y-3">
                    <label for="sexe" class="block text-sm font-semibold text-gray-700">
                        Sexe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-venus-mars text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('sexe') border-red-500 @enderror" 
                                id="sexe" 
                                name="sexe" 
                                required>
                            <option value="">Sélectionnez le sexe</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>
                    @error('sexe')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Genre de l'utilisateur</p>
                </div>

                <!-- Date de naissance -->
                <div class="space-y-3">
                    <label for="date_naissance" class="block text-sm font-semibold text-gray-700">
                        Date de naissance <span class="text-gray-500 text-sm font-normal">(Optionnel)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-birthday-cake text-gray-400 text-lg"></i>
                        </div>
                        <input type="date" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('date_naissance') border-red-500 @enderror" 
                               id="date_naissance" 
                               name="date_naissance" 
                               value="{{ old('date_naissance') }}">
                    </div>
                    @error('date_naissance')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Date de naissance de l'utilisateur</p>
                </div>
            </div>

            <!-- Rôle et Langue -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Rôle -->
                <div class="space-y-3">
                    <label for="id_role" class="block text-sm font-semibold text-gray-700">
                        Rôle <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400 text-lg"></i>
                        </div>
                        <select class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('id_role') border-red-500 @enderror" 
                                id="id_role" 
                                name="id_role" 
                                required>
                            <option value="">Sélectionnez un rôle</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id_role }}" {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                                    {{ $role->nom_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_role')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Rôle de l'utilisateur dans la plateforme</p>
                </div>

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
                            <option value="">Sélectionnez une langue</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_langue')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Langue préférée de l'utilisateur</p>
                </div>
            </div>

            <!-- Photo de profil -->
            <div class="space-y-3 mb-6">
                <label for="photo" class="block text-sm font-semibold text-gray-700">
                    Photo de profil <span class="text-gray-500 text-sm font-normal">(Optionnel)</span>
                </label>
                <div class="relative">
                    <div class="absolute top-4 left-4 flex items-start pointer-events-none">
                        <i class="fas fa-camera text-gray-400 text-lg mt-1"></i>
                    </div>
                    <input type="file" 
                           class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('photo') border-red-500 @enderror" 
                           id="photo" 
                           name="photo" 
                           accept="image/*">
                </div>
                @error('photo')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm">Image de profil (JPG, PNG, max 2MB)</p>
            </div>

            <!-- Mot de passe -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Mot de passe -->
                <div class="space-y-3">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        Mot de passe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-lg"></i>
                        </div>
                        <input type="password" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Saisissez le mot de passe" 
                               required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Mot de passe de connexion</p>
                </div>

                <!-- Confirmation mot de passe -->
                <div class="space-y-3">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                        Confirmation mot de passe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-lg"></i>
                        </div>
                        <input type="password" 
                               class="pl-12 w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password_confirmation') border-red-500 @enderror" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Confirmez le mot de passe" 
                               required>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm">Saisissez à nouveau le mot de passe</p>
                </div>
            </div>
        </div>
        
        <!-- Pied de page du formulaire -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Retour à la liste
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-3"></i>
                    Créer l'utilisateur
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
