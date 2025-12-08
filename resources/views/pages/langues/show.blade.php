@extends('layouts.guest')
@section('title', $langue->nom_langue)

@section('content')
    <x-partials.hero
        title="{{ $langue->nom_langue }}"
        subtitle="{{ $langue->code_langue ?? '' }}"
        description="{{ $langue->description ?? 'Langue parlée au Bénin' }}"
        image="https://placehold.co/1600x900/8b7355/ffffff?text={{ urlencode($langue->nom_langue) }}"
    />

    <section class="py-12 bg-stone-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <x-ui.stat-card number="{{ $langue->regions->count() }}">Régions</x-ui.stat-card>
                <x-ui.stat-card number="{{ $langue->contenus_count ?? '0' }}">Contenus</x-ui.stat-card>
                <x-ui.stat-card number="—">Locuteurs</x-ui.stat-card>
                <x-ui.stat-card number="{{ $langue->famille ?? '—' }}">Famille</x-ui.stat-card>
            </div>
        </div>
    </section>

    @if($langue->contenus->count() > 0)
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12">
                    Contenus en {{ $langue->nom_langue }}
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($langue->contenus as $contenu)
                        <x-content.content-card :contenu="$contenu" />
                    @endforeach
                </div>
            </div>
            </div>
        </section>
    @endif

    <x-partials.newsletter />
@endsection