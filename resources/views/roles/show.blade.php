
@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-user-shield text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Détails du Rôle</h1>
            <p class="text-gray-600 mt-1">Informations complètes sur ce rôle</p>
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
                    <span class="ml-1 text-blue-600 font-medium">Détails</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
@php
    $userCount = $role->utilisateurs ? $role->utilisateurs->count() : 0;
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Colonne principale -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Carte Informations principales -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-green-50 px-6 py-5 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="bg-white p-3 rounded-xl shadow-md mr-4">
                            <i class="fas fa-user-tag text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $role->nom_role }}</h2>
                            <div class="flex items-center mt-2 space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    #{{ $role->id_role }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-users mr-1"></i>
                                    {{ $userCount }} utilisateur(s)
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('roles.edit', $role->id_role) }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier
                        </a>
                        <a href="{{ route('roles.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Informations de base -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-hashtag text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">ID</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">#{{ $role->id_role }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-tag text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Nom du rôle</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $role->nom_role }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-users text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Nombre d'utilisateurs</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $userCount }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-orange-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-calendar-plus text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Date création</h3>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $role->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($role->description)
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-align-left text-blue-500 text-xl mt-0.5 mr-4"></i>
                        <div class="flex-1">
                            <h4 class="text-base font-semibold text-blue-900 mb-3">Description du rôle</h4>
                            <p class="text-blue-800 leading-relaxed">{{ $role->description }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Utilisateurs associés -->
                @if($userCount > 0)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-users text-blue-600 mr-3"></i>
                        Utilisateurs associés ({{ $userCount }})
                    </h3>
                    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Utilisateur
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Téléphone
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Date création
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($role->utilisateurs ?? [] as $utilisateur)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('utilisateurs.show', $utilisateur->id_utilisateur) }}" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $utilisateur->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $utilisateur->telephone ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $utilisateur->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <div class="bg-blue-50 rounded-full p-4 inline-flex mb-4">
                        <i class="fas fa-user-slash text-blue-500 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Aucun utilisateur associé</h4>
                    <p class="text-gray-600 mb-4">Aucun utilisateur n'est associé à ce rôle pour le moment.</p>
                    <a href="{{ route('utilisateurs.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Créer un utilisateur
                    </a>
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
                            {{ $role->created_at ? $role->created_at->format('d/m/Y à H:i') : 'N/A' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Modifié le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $role->updated_at ? $role->updated_at->format('d/m/Y à H:i') : 'Non modifié' }}
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
                        <div class="text-3xl font-bold text-blue-600 mb-1">{{ $userCount }}</div>
                        <div class="text-sm text-gray-600">Utilisateurs total</div>
                    </div>
                    
                    @if($userCount > 0)
                    @php
                        $actifs = $role->utilisateurs->where('statut', 'actif')->count();
                        $inactifs = $role->utilisateurs->where('statut', 'inactif')->count();
                    @endphp
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-green-600">Actifs</span>
                            <span class="font-semibold">{{ $actifs }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-red-600">Inactifs</span>
                            <span class="font-semibold">{{ $inactifs }}</span>
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
                    <a href="{{ route('roles.edit', $role->id_role) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier le rôle
                    </a>
                    
                    <a href="{{ route('utilisateurs.create') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Nouvel utilisateur
                    </a>
                    
                    <a href="{{ route('roles.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-list mr-2"></i>
                        Voir tous les rôles
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
</style>
@endsection
