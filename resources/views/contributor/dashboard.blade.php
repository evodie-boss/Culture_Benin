@extends('layouts.guest')
@section('title', 'Mon espace contributeur')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-stone-50 to-stone-100 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-stone-800 mb-4">
                Bienvenue, {{ Auth::user()->prenom ?? Auth::user()->nom }} !
            </h1>
            <p class="text-xl text-stone-600">
                Vous êtes <span class="font-bold text-taupe-600">Contributeur</span> • Merci pour votre engagement !
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-stone-800">Mes contenus</h2>
                <a href="{{ route('contenus.create') }}" 
                   class="bg-taupe-600 hover:bg-taupe-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition">
                    + Créer un nouveau contenu
                </a>
            </div>

            @if($contenus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($contenus as $contenu)
                        <x-content.content-card :contenu="$contenu" class="hover-lift" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $contenus->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <i data-lucide="file-text" class="w-24 h-24 text-stone-300 mx-auto mb-6"></i>
                    <p class="text-2xl text-stone-600">Vous n’avez encore publié aucun contenu</p>
                    <a href="{{ route('contenus.create') }}" 
                       class="mt-6 inline-block bg-taupe-600 text-white px-8 py-4 rounded-xl font-bold">
                        Commencer maintenant
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
    lucide.createIcons();
</script>