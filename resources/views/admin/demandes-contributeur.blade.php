@extends('layouts') <!-- ton layout admin existant -->
@section('title', 'Demandes contributeur')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-8">Demandes pour devenir contributeur</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($demandes->count() == 0)
        <p class="text-gray-600 text-center py-10">Aucune demande en attente</p>
    @else
        <div class="space-y-6">
            @foreach($demandes as $d)
                <div class="bg-white rounded-lg shadow p-6 border">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xl font-semibold">
                                {{ $d->utilisateur->prenom }} {{ $d->utilisateur->nom }}
                                <span class="text-gray-500">({{ $d->utilisateur->email }})</span>
                            </p>
                            @if($d->message)
                                <p class="text-gray-600 mt-2 italic">"{{ $d->message }}"</p>
                            @endif
                            <p class="text-sm text-gray-500 mt-2">
                                Demande du {{ $d->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <form method="POST" action="{{ route('admin.demandes.valider', $d) }}">
                                @csrf
                                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium">
                                    Valider
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.demandes.refuser', $d) }}">
                                @csrf
                                <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium">
                                    Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection