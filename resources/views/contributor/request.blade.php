@extends('layouts.guest')
@section('title', 'Devenir contributeur')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-stone-50 to-stone-100 flex items-center justify-center py-12">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl p-10">
        <div class="text-center mb-10">
            <i data-lucide="user-plus" class="w-20 h-20 text-taupe-600 mx-auto mb-6"></i>
            <h1 class="text-4xl font-bold text-stone-800">Devenir contributeur</h1>
            <p class="text-xl text-stone-600 mt-4">
                Publiez vos propres contenus et enrichissez le patrimoine culturel béninois !
            </p>
        </div>

        <form method="POST" action="{{ route('devenir-contributeur') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-lg font-medium text-stone-700 mb-3">
                    Pourquoi voulez-vous devenir contributeur ?
                </label>
                <textarea name="message" rows="6" class="w-full rounded-xl border-stone-300 focus:ring-taupe-500 focus:border-taupe-500" 
                          placeholder="Je souhaite partager mes connaissances sur la culture Fon, mes recettes traditionnelles, etc.">{{ old('message') }}</textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ url('/') }}" class="flex-1 text-center py-4 border border-stone-300 rounded-xl text-stone-700 hover:bg-stone-50">
                    Retour
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-taupe-600 to-taupe-700 text-white font-bold py-4 rounded-xl hover:from-taupe-700 hover:to-taupe-800 shadow-lg">
                    Envoyer la demande
                </button>
            </div>
        </form>
    </div>
</div>
@endsection