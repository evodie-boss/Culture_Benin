@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-photo-video text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestion des Médias</h1>
            <p class="text-gray-600 mt-1">Médias associés aux contenus culturels du Bénin</p>
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
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-blue-600 font-medium">Médias</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <!-- En-tête de la carte - ESPACE RÉDUIT -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="mb-3 lg:mb-0">
                <h2 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-list-ul text-blue-600 mr-2 text-base"></i>
                    Liste des Médias
                </h2>
            </div>
            <a href="{{ route('admin.medias.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2 text-sm"></i>
                Nouveau Média
            </a>
        </div>
    </div>

    <!-- Contenu de la carte -->
    <div class="p-6">
        <!-- Message de succès -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-xl">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-green-800">Succès !</h3>
                    <p class="text-green-700 mt-1 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Tableau -->
        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
            <table id="mediasTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag mr-2 text-gray-500 text-xs"></i>
                                ID
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2 text-gray-500 text-xs"></i>
                                Type
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-file mr-2 text-gray-500 text-xs"></i>
                                Chemin/Fichier
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-align-left mr-2 text-gray-500 text-xs"></i>
                                Description
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-link mr-2 text-gray-500 text-xs"></i>
                                Contenu Associé
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-cogs mr-2 text-gray-500 text-xs"></i>
                                Actions
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($medias as $media)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="text-sm font-mono font-bold text-gray-900">#{{ $media->id_media }}</div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            @if($media->typeMedia->nom_media == 'Image')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-image mr-1 text-xs"></i>
                                    Image
                                </span>
                            @elseif($media->typeMedia->nom_media == 'Audio')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-music mr-1 text-xs"></i>
                                    Audio
                                </span>
                            @elseif($media->typeMedia->nom_media == 'Vidéo')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-video mr-1 text-xs"></i>
                                    Vidéo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-file mr-1 text-xs"></i>
                                    Document
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-lg mr-3">
                                    <i class="fas fa-file text-blue-600 text-xs"></i>
                                </div>
                                <code class="text-sm font-mono text-gray-900 max-w-xs truncate">{{ $media->chemin }}</code>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="text-sm text-gray-900 max-w-xs truncate">
                                {{ $media->description ?: 'Aucune description' }}
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            @if($media->contenu)
                                <a href="{{ route('contenus.show', $media->contenu->id_contenu) }}" 
                                   class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200">
                                    <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                                    {{ Str::limit($media->contenu->titre, 25) }}
                                </a>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    <i class="fas fa-minus mr-1 text-xs"></i>
                                    N/A
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <!-- Bouton Voir - ICÔNE SEULEMENT -->
                                <a href="{{ route('admin.medias.show', $media->id_media) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                   title="Voir les détails">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                
                                <!-- Bouton Modifier - ICÔNE SEULEMENT -->
                                <a href="{{ route('admin.medias.edit', $media->id_media) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 border border-transparent text-sm font-medium rounded-lg text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                   title="Modifier">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                
                                <!-- Bouton Supprimer - ICÔNE SEULEMENT -->
                                <form action="{{ route('admin.medias.destroy', $media->id_media) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center w-8 h-8 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?')"
                                            title="Supprimer">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Informations supplémentaires -->
        <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-600">
            <div class="flex items-center mb-3 sm:mb-0">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                <span class="font-medium">{{ $medias->count() }} média(s) enregistré(s)</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-database mr-2 text-green-500"></i>
                <span class="font-medium">Base de données culturelle du Bénin</span>
            </div>
        </div>
    </div>
</div>

<!-- Scripts DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Configuration DataTables SIMPLIFIÉE
    var table = $('#mediasTable').DataTable({
        "pageLength": 10,
        "responsive": true,
        "language": {
            "emptyTable": "Aucune donnée disponible dans le tableau",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
            "infoFiltered": "(filtrées depuis _MAX_ entrées totales)",
            "infoThousands": ",",
            "lengthMenu": "Afficher _MENU_ entrées",
            "loadingRecords": "Chargement...",
            "processing": "Traitement...",
            "search": "Rechercher:",
            "zeroRecords": "Aucun enregistrement correspondant trouvé",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            },
            "aria": {
                "sortAscending": ": activer pour trier la colonne par ordre croissant",
                "sortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        },
        "dom": '<"flex flex-col lg:flex-row lg:items-center lg:justify-between p-4"<"mb-4 lg:mb-0"l><"mb-4 lg:mb-0"f>><"overflow-x-auto"t><"flex flex-col lg:flex-row lg:items-center lg:justify-between p-4"<"mb-4 lg:mb-0"i><"mb-4 lg:mb-0"p>>'
    });

    console.log("DataTables médias initialisé avec succès !");
});
</script>

<!-- Styles personnalisés -->
<style>
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    transition: all 0.2s ease-in-out;
}

.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #3b82f6;
    ring-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.table-hover tbody tr:hover {
    background-color: #f9fafb;
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

/* Animation pour les boutons d'action */
.flex.items-center.space-x-2 a,
.flex.items-center.space-x-2 button {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Style pour la pagination DataTables */
.dataTables_paginate .paginate_button {
    border: 1px solid #d1d5db !important;
    border-radius: 10px !important;
    margin: 0 4px !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.875rem !important;
    transition: all 0.2s ease-in-out;
}

.dataTables_paginate .paginate_button:hover {
    background: linear-gradient(135deg, #3b82f6, #10b981) !important;
    color: white !important;
    border: none !important;
    transform: translateY(-1px);
}

.dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #3b82f6, #10b981) !important;
    color: white !important;
    border: none !important;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Amélioration de l'apparence du tableau */
#mediasTable {
    border-collapse: separate;
    border-spacing: 0;
}

#mediasTable th,
#mediasTable td {
    border-bottom: 1px solid #e5e7eb;
    padding: 0.75rem 1.5rem !important;
}

#mediasTable thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Badge amélioré */
.bg-blue-100 {
    background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%);
}

/* Style spécifique pour les boutons d'actions */
.flex.items-center.space-x-2 a,
.flex.items-center.space-x-2 button {
    width: 32px !important;
    height: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 8px !important;
}

/* Responsive amélioré */
@media (max-width: 768px) {
    .flex.items-center.space-x-2 {
        flex-direction: row !important;
        gap: 0.25rem !important;
        align-items: center !important;
    }
    
    .flex.items-center.space-x-2 a,
    .flex.items-center.space-x-2 button {
        min-width: auto !important;
        width: 28px !important;
        height: 28px !important;
    }
    
    #mediasTable th,
    #mediasTable td {
        padding: 0.5rem 1rem !important;
    }
}
</style>
@endsection