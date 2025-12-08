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
            <h1 class="text-2xl font-bold text-gray-900">Ajouter un Média</h1>
            <p class="text-gray-600 mt-1">Nouveau média culturel</p>
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
                <i class="fas fa-photo-video text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nouveau Média Culturel</h2>
                <p class="text-gray-600 mt-2">Ajoutez un nouveau média à la plateforme culturelle</p>
            </div>
        </div>
    </div>
    
   <form action="{{ route('admin.medias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Upload du fichier -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Fichier média <span class="text-red-500">*</span>
        </label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-500 transition">
            <div class="space-y-1 text-center">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                <div class="flex text-sm text-gray-600">
                    <label for="fichier" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                        <span>Choisir un fichier</span>
                        <input id="fichier" name="fichier" type="file" class="sr-only" accept="image/*,audio/*,video/*,.pdf" required>
                    </label>
                    <p class="pl-1">ou glisser-déposer</p>
                </div>
                <p class="text-xs text-gray-500">JPG, PNG, MP4, MP3, PDF jusqu'à 50 Mo</p>
            </div>
        </div>
        @error('fichier')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Aperçu du fichier sélectionné -->
    <div id="preview" class="hidden mt-4">
        <p class="text-sm font-medium text-gray-700 mb-2">Aperçu :</p>
        <div class="flex justify-center">
            <img id="preview-img" class="max-h-64 rounded-lg shadow-lg hidden" src="" alt="Aperçu">
            <div id="preview-file" class="hidden text-center">
                <i class="fas fa-file text-6xl text-gray-400"></i>
                <p id="file-name" class="mt-2 text-gray-600"></p>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-semibold text-gray-700">
            Description <span class="text-gray-400">(facultatif)</span>
        </label>
        <textarea name="description" id="description" rows="3" class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
    </div>

    <!-- Contenu + Type -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="id_contenu" class="block text-sm font-semibold text-gray-700">Contenu associé <span class="text-red-500">*</span></label>
            <select name="id_contenu" id="id_contenu" required class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Choisir un contenu</option>
                @foreach($contenus as $c)
                    <option value="{{ $c->id_contenu }}" {{ old('id_contenu') == $c->id_contenu ? 'selected' : '' }}>
                        {{ $c->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_type_media" class="block text-sm font-semibold text-gray-700">Type de média <span class="text-red-500">*</span></label>
            <select name="id_type_media" id="id_type_media" required class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Choisir un type</option>
                @foreach($typeMedias as $t)
                    <option value="{{ $t->id_type_media }}">{{ $t->nom_media }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-end gap-4 pt-6">
        <a href="{{ route('admin.medias.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50">
            Annuler
        </a>
        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-green-500 text-white font-bold rounded-xl hover:from-blue-700 hover:to-green-600 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition">
            Enregistrer le média
        </button>
    </div>
</form>

<script>
document.getElementById('fichier').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const previewImg = document.getElementById('preview-img');
    const previewFile = document.getElementById('preview-file');
    const fileName = document.getElementById('file-name');

    if (file) {
        preview.classList.remove('hidden');
        if (file.type.startsWith('image/')) {
            previewImg.src = URL.createObjectURL(file);
            previewImg.classList.remove('hidden');
            previewFile.classList.add('hidden');
        } else {
            previewImg.classList.add('hidden');
            previewFile.classList.remove('hidden');
            fileName.textContent = file.name;
        }
    }
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
    min-height: 100px;
}
</style>
@endsection