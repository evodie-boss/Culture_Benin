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
            <i class="fas fa-user-shield text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestion des Rôles</h1>
            <p class="text-gray-600 mt-1">Rôles et permissions des utilisateurs</p>
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
                    <span class="ml-1 text-blue-600 font-medium">Rôles</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="mb-3 lg:mb-0">
                <h2 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-list-ul text-blue-600 mr-2 text-base"></i>
                    Liste des Rôles
                </h2>
            </div>
            <a href="{{ route('admin.roles.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2 text-sm"></i>
                Nouveau Rôle
            </a>
        </div>
    </div>

    <div class="p-6">

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

        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
            <table id="rolesTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nom du Rôle</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Permissions</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Utilisateurs</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date Création</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($roles as $role)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">

                        <td class="px-6 py-3">#{{ $role->id_role }}</td>

                        <td class="px-6 py-3">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-lg mr-3">
                                    <i class="fas fa-user-shield text-blue-600 text-xs"></i>
                                </div>
                                <span class="font-semibold">{{ $role->nom_role }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex flex-wrap gap-1">

                                @php
                                    $permissions = $role->permissions ?? collect();
                                @endphp

                                @if($permissions->count() > 0)
                                    @foreach($permissions->take(3) as $permission)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                                            {{ $permission->nom_permission }}
                                        </span>
                                    @endforeach

                                    @if($permissions->count() > 3)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            +{{ $permissions->count() - 3 }}
                                        </span>
                                    @endif

                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        Aucune permission
                                    </span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ optional($role->utilisateurs)->count() ?? 0 }} utilisateur(s)
                            </span>
                        </td>

                        <td class="px-6 py-3">
                            {{ $role->created_at ? $role->created_at->format('d/m/Y') : '---' }}
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.roles.show', $role->id_role) }}" 
                                   class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded"
                                   title="Voir">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>

                                <a href="{{ route('admin.roles.edit', $role->id_role) }}" 
                                   class="w-8 h-8 flex items-center justify-center bg-yellow-500 text-white rounded"
                                   title="Modifier">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>

                                <form action="{{ route('admin.roles.destroy', $role->id_role) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center bg-red-600 text-white rounded"
                                            onclick="return confirm('Supprimer ?')" 
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

        <div class="mt-6 flex justify-between text-sm text-gray-600">
            <span>{{ $roles->count() }} rôle(s) enregistré(s)</span>
            <span>Base culturelle du Bénin</span>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#rolesTable').DataTable({
        "pageLength": 10,
        "responsive": true
    });
});
</script>
@endsection
