{{-- resources/views/paiement/show.blade.php --}}
@extends('layouts.guest')

@section('title', 'Paiement - ' . $contenu->titre)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Finaliser votre achat</h1>
            <p class="text-gray-600">Accédez au contenu exclusif : <span class="font-semibold text-orange-600">{{ $contenu->titre }}</span></p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Détails du contenu -->
            <div class="p-8 border-b border-gray-200">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $contenu->titre }}</h2>
                        <div class="flex items-center space-x-4 text-gray-600">
                            <span class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $contenu->region->nom_region ?? 'Région non spécifiée' }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-language mr-2"></i>
                                {{ $contenu->langue->nom_langue ?? 'Langue non spécifiée' }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-orange-600">
                            {{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            Accès {{ $contenu->duree_acces ? 'pour ' . $contenu->duree_acces : 'illimité' }}
                        </div>
                    </div>
                </div>
                
                <!-- Aperçu -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Aperçu du contenu :</h3>
                    <p class="text-gray-700">{{ $contenu->apercu }}</p>
                </div>
            </div>

            <!-- Formulaire de paiement -->
            <div class="p-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Informations de paiement</h3>
                
                <form action="{{ route('paiement.initier', $contenu) }}" method="POST">
                    @csrf
                    
                    <!-- Sélection opérateur -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Sélectionnez votre opérateur</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="operateur" value="MTN" class="sr-only peer" required>
                                <div class="p-4 border-2 border-gray-300 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold">M</span>
                                        </div>
                                        <div>
                                            <div class="font-semibold">MTN Mobile Money</div>
                                            <div class="text-sm text-gray-600">+229 XX XX XX XX</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" name="operateur" value="Moov" class="sr-only peer" required>
                                <div class="p-4 border-2 border-gray-300 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold">M</span>
                                        </div>
                                        <div>
                                            <div class="font-semibold">Moov Money</div>
                                            <div class="text-sm text-gray-600">+229 XX XX XX XX</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Numéro de téléphone -->
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Numéro de téléphone
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">+229</span>
                            </div>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone"
                                   placeholder="XX XX XX XX" 
                                   pattern="[0-9]{8,}"
                                   class="pl-16 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                   required>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Entrez votre numéro de téléphone mobile</p>
                    </div>

                    <!-- Informations utilisateur -->
                    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-user-circle text-blue-500 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-900">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</p>
                                <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex space-x-4">
                        <a href="{{ route('contenus.show', $contenu) }}" 
                           class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all text-center">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-red-600 transition-all shadow-md">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-lock mr-2"></i>
                                Payer {{ number_format($contenu->prix, 0, ',', ' ') }} {{ $contenu->devise }}
                            </div>
                        </button>
                    </div>
                </form>

                <!-- Informations supplémentaires -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-green-500 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-900">Paiement sécurisé</p>
                                <p class="text-sm text-gray-600">Transaction cryptée via FedaPay</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-clock text-blue-500 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-900">Accès immédiat</p>
                                <p class="text-sm text-gray-600">Contenu disponible après paiement</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Formater le numéro de téléphone
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            value = value.match(/.{1,2}/g).join(' ');
        }
        e.target.value = value;
    });
</script>
@endpush