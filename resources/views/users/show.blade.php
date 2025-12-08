@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-user text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Détails de l'Utilisateur</h1>
            <p class="text-gray-600 mt-1">Informations complètes sur cet utilisateur</p>
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
                    <span class="ml-1 text-blue-600 font-medium">Détails</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Colonne principale -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Carte Informations principales -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-green-50 px-6 py-5 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="bg-white p-3 rounded-xl shadow-md mr-4">
                            <i class="fas fa-user-circle text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $user->prenom }} {{ $user->nom }}</h2>
                            <div class="flex items-center mt-2 space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    #{{ $user->id_utilisateur }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-comment mr-1"></i>
                                    {{ $user->commentaires->count() }} commentaire(s)
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.users.edit', $user->id_utilisateur) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier
                        </a>
                        <a href="{{ route('admin.users.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Photo et informations principales -->
                <div class="flex items-start space-x-6 mb-8">
                    <div class="flex-shrink-0">
                        @if($user->photo)
                            <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg" 
                                 src="{{ asset('storage/' . $user->photo) }}" 
                                 alt="{{ $user->prenom }}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="h-24 w-24 rounded-full bg-gradient-to-r from-blue-500 to-green-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg hidden">
                                {{ substr($user->prenom, 0, 1) }}{{ substr($user->nom, 0, 1) }}
                            </div>
                        @else
                            <div class="h-24 w-24 rounded-full bg-gradient-to-r from-blue-500 to-green-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                {{ substr($user->prenom, 0, 1) }}{{ substr($user->nom, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $user->prenom }} {{ $user->nom }}</h3>
                        <p class="text-gray-600 text-lg mb-4">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-2">
                            @if($user->role)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <i class="fas fa-user-tag mr-1"></i>
                                    {{ $user->role->nom_role }}
                                </span>
                            @endif
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-{{ $user->sexe === 'M' ? 'male' : 'female' }} mr-1"></i>
                                {{ $user->sexe === 'M' ? 'Masculin' : 'Féminin' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Informations de base -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-envelope text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Email</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-phone text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Téléphone</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ $user->telephone ?? 'Non renseigné' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-birthday-cake text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Date de naissance</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    @if($user->date_naissance)
                                        {{ \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') }}
                                        ({{ \Carbon\Carbon::parse($user->date_naissance)->age }} ans)
                                    @else
                                        Non renseignée
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-orange-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-language text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Langue</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ $user->langue->nom_langue ?? 'Non spécifiée' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-calendar-plus text-indigo-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Date d'inscription</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ \Carbon\Carbon::parse($user->date_inscription)->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-teal-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-sync-alt text-teal-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Dernière mise à jour</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commentaires associés -->
                @if($user->commentaires->count() > 0)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-comments text-blue-600 mr-3"></i>
                        Commentaires ({{ $user->commentaires->count() }})
                    </h3>
                    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Contenu
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Note
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($user->commentaires->take(5) as $commentaire)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">
                                            {{ $commentaire->texte }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($commentaire->note)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-star mr-1"></i>
                                                {{ $commentaire->note }}/5
                                            </span>
                                        @else
                                            <span class="text-gray-500 text-sm">Aucune note</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $commentaire->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($user->commentaires->count() > 5)
                    <div class="mt-4 text-center">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Voir tous les {{ $user->commentaires->count() }} commentaires
                        </a>
                    </div>
                    @endif
                </div>
                @else
                <div class="text-center py-8">
                    <div class="bg-blue-50 rounded-full p-4 inline-flex mb-4">
                        <i class="fas fa-comment-slash text-blue-500 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Aucun commentaire</h4>
                    <p class="text-gray-600">Cet utilisateur n'a pas encore publié de commentaires.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Carte Métadonnées -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history text-blue-600 mr-2"></i>
                    Métadonnées
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Créé le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y à H:i') : 'N/A' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Modifié le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $user->updated_at ? $user->updated_at->format('d/m/Y à H:i') : 'Non modifié' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm font-medium text-gray-500">Statut :</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Actif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Statistiques -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-1">{{ $user->commentaires->count() }}</div>
                        <div class="text-sm text-gray-600">Commentaires total</div>
                    </div>
                    
                    @if($user->commentaires->count() > 0)
                    @php
                        $avecNote = $user->commentaires->whereNotNull('note')->count();
                        $sansNote = $user->commentaires->whereNull('note')->count();
                    @endphp
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-green-600">Avec note</span>
                            <span class="font-semibold">{{ $avecNote }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-yellow-600">Sans note</span>
                            <span class="font-semibold">{{ $sansNote }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Carte Actions Rapides -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bolt text-blue-600 mr-2"></i>
                    Actions Rapides
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user->id_utilisateur) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier l'utilisateur
                    </a>
                    
                    <a href="mailto:{{ $user->email }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-envelope mr-2"></i>
                        Envoyer un email
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-list mr-2"></i>
                        Voir tous les utilisateurs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée progressive
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // Effet de hover sur les cartes d'information
    const infoCards = document.querySelectorAll('.bg-gray-50.rounded-xl');
    infoCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });

    // Animation pour les lignes du tableau
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.4s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, index * 100);
    });
});
</script>

<!-- Styles personnalisés -->
<style>
.glass-effect {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

.hover-lift:hover {
    transform: translateY(-4px);
    transition: transform 0.2s ease-in-out;
}

.gradient-border {
    border: 1px solid transparent;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #3B82F6, #10B981) border-box;
}

/* Amélioration du tableau */
table {
    border-collapse: separate;
    border-spacing: 0;
}

table th,
table td {
    border-bottom: 1px solid #e5e7eb;
}

table thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Animation pour les liens */
a {
    transition: all 0.2s ease-in-out;
}

a:hover {
    text-decoration: underline;
}

/* Style pour l'avatar */
.avatar-gradient {
    background: linear-gradient(135deg, #3B82F6, #10B981);
}
</style>
@endsection