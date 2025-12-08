@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-language text-white text-2xl"></i>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Détails de la Langue</h1>
            <p class="text-gray-600 mt-1">Informations complètes sur cette langue</p>
        </div>
    </div>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('admin.langues.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2">Langues</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-sm font-medium text-blue-600 md:ml-2">Détails</span>
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
                            <i class="fas fa-language text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $langue->nom_langue }}</h2>
                            <div class="flex items-center mt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-code mr-1"></i>
                                    {{ $langue->code_langue }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm border">
                        <span class="text-sm text-gray-600">ID: </span>
                        <span class="font-mono font-bold text-gray-900">#{{ $langue->id_langue }}</span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations de base -->
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-font text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Nom de la langue</h3>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $langue->nom_langue }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-code text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Code langue</h3>
                                <p class="text-lg font-bold text-gray-900 mt-1 font-mono">{{ $langue->code_langue }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="bg-purple-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-align-left text-purple-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Description</h3>
                            @if($langue->description)
                                <div class="bg-white p-4 rounded-lg border-l-4 border-blue-500 shadow-sm">
                                    <p class="text-gray-700 leading-relaxed">{{ $langue->description }}</p>
                                </div>
                            @else
                                <div class="text-center py-6 text-gray-500 bg-white rounded-lg border-2 border-dashed border-gray-300">
                                    <i class="fas fa-inbox text-3xl mb-3 opacity-50"></i>
                                    <p class="font-medium">Aucune description disponible</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Carte Actions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-cogs text-blue-600 mr-2"></i>
                    Actions
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.langues.edit', $langue->id_langue) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier la langue
                    </a>
                    
                    <a href="{{ route('admin.langues.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>

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
                            {{ $langue->created_at ? $langue->created_at->format('d/m/Y à H:i') : 'N/A' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Modifié le :</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $langue->updated_at ? $langue->updated_at->format('d/m/Y à H:i') : 'Non modifié' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm font-medium text-gray-500">Statut :</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Active
                        </span>
                    </div>
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

    // Effet de hover sur les cartes
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
            this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});
</script>
@endsection