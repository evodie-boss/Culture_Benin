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
            <i class="fas fa-comments text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestion des Commentaires</h1>
            <p class="text-gray-600 mt-1">Commentaires des utilisateurs sur les contenus culturels</p>
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
                    <span class="ml-1 text-blue-600 font-medium">Commentaires</span>
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
                    Liste des Commentaires
                </h2>
            </div>
            <a href="{{ route('admin.commentaires.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2 text-sm"></i>
                Nouveau Commentaire
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
            <table id="commentairesTable" class="min-w-full divide-y divide-gray-200">
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
                                <i class="fas fa-user mr-2 text-gray-500 text-xs"></i>
                                Utilisateur
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt mr-2 text-gray-500 text-xs"></i>
                                Contenu
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-comment mr-2 text-gray-500 text-xs"></i>
                                Commentaire
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-star mr-2 text-gray-500 text-xs"></i>
                                Note
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-gray-500 text-xs"></i>
                                Date
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
                    @foreach($commentaires as $commentaire)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="text-sm font-mono font-bold text-gray-900">#{{ $commentaire->id_commentaire }}</div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-lg mr-3">
                                    <i class="fas fa-user text-blue-600 text-xs"></i>
                                </div>
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ $commentaire->utilisateur->prenom ?? 'N/A' }} {{ $commentaire->utilisateur->nom ?? '' }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <a href="{{ route('contenus.show', $commentaire->contenu->id_contenu) }}" 
                               class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200">
                                <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                                {{ Str::limit($commentaire->contenu->titre, 25) }}
                            </a>
                        </td>
                        <td class="px-6 py-3">
                            <div class="text-sm text-gray-900 max-w-xs truncate">
                                {{ $commentaire->texte }}
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            @if($commentaire->note)
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $commentaire->note ? '' : '-half-alt' }} text-xs"></i>
                                        @endfor
                                    </div>
                                    <span class="text-xs font-medium text-gray-600">({{ $commentaire->note }}/5)</span>
                                </div>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    <i class="fas fa-minus mr-1 text-xs"></i>
                                    Aucune note
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($commentaire->date)->format('d/m/Y H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <!-- Bouton Voir - ICÔNE SEULEMENT -->
                                <a href="{{ route('admin.commentaires.show', $commentaire->id_commentaire) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                   title="Voir les détails">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                
                                <!-- Bouton Modifier - ICÔNE SEULEMENT -->
                                <a href="{{ route('admin.commentaires.edit', $commentaire->id_commentaire) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 border border-transparent text-sm font-medium rounded-lg text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                   title="Modifier">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                
                                <!-- Bouton Supprimer - ICÔNE SEULEMENT -->
                                <form action="{{ route('admin.commentaires.destroy', $commentaire->id_commentaire) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center w-8 h-8 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"
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
                <span class="font-medium">{{ $commentaires->count() }} commentaire(s) enregistré(s)</span>
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
    var table = $('#commentairesTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "responsive": true,
        "order": [[5, 'desc']], // Tri par date décroissante
        "dom": '<"flex flex-col lg:flex-row lg:items-center lg:justify-between p-4"<"mb-4 lg:mb-0"l><"mb-4 lg:mb-0"f>><"overflow-x-auto"t><"flex flex-col lg:flex-row lg:items-center lg:justify-between p-4"<"mb-4 lg:mb-0"i><"mb-4 lg:mb-0"p>>',
        "drawCallback": function(settings) {
            // Animation des lignes
            $('tbody tr').each(function(index) {
                $(this).delay(index * 100).css({
                    'opacity': '0',
                    'transform': 'translateX(-20px)'
                }).animate({
                    'opacity': '1',
                    'transform': 'translateX(0)'
                }, 300);
            });
        },
        "initComplete": function(settings, json) {
            // Animation d'entrée pour la carte principale
            $('.bg-white').css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            }).animate({
                'opacity': '1',
                'transform': 'translateY(0)'
            }, 600);
        }
    });

    // Amélioration de l'apparence des contrôles DataTables
    $('.dataTables_length select, .dataTables_filter input').addClass('rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500');

    console.log("DataTables commentaires initialisé avec succès !");
    console.log("Nombre de commentaires chargés : " + table.rows().count());
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
#commentairesTable {
    border-collapse: separate;
    border-spacing: 0;
}

#commentairesTable th,
#commentairesTable td {
    border-bottom: 1px solid #e5e7eb;
    padding: 0.75rem 1.5rem !important;
}

#commentairesTable thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Badge amélioré */
.bg-blue-100 {
    background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%);
}

/* Étoiles de notation */
.text-yellow-400 {
    color: #fbbf24;
}

/* Responsive amélioré */
@media (max-width: 768px) {
    .flex.items-center.space-x-2 {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
    
    .flex.items-center.space-x-2 a,
    .flex.items-center.space-x-2 button {
        min-width: auto;
        width: 100%;
        justify-content: flex-start;
    }
    
    #commentairesTable th,
    #commentairesTable td {
        padding: 0.5rem 1rem !important;
    }
}
</style>
@endsection