@extends('layout')

@section('title', 'Détail demande')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Détail de la demande #{{ $demande->id_demande }}</h1>
        <a href="{{ route('admin.demandes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Informations utilisateur -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Informations utilisateur
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nom :</strong> {{ $demande->utilisateur->nom }}</p>
                            <p><strong>Email :</strong> {{ $demande->utilisateur->email }}</p>
                            <p><strong>Rôle actuel :</strong> {{ $demande->utilisateur->role->nom_role }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date inscription :</strong> {{ $demande->utilisateur->date_inscription->format('d/m/Y') }}</p>
                            <p><strong>Statut :</strong> 
                                <span class="badge bg-{{ $demande->utilisateur->statut == 'actif' ? 'success' : 'warning' }}">
                                    {{ $demande->utilisateur->statut }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message de l'utilisateur -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-envelope me-1"></i>
                    Message de motivation
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        {{ $demande->message }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Statut et actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-cogs me-1"></i>
                    Statut et actions
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($demande->statut == 'en_attente')
                            <span class="badge bg-warning fs-6 p-2">En attente</span>
                        @elseif($demande->statut == 'validée')
                            <span class="badge bg-success fs-6 p-2">Validée</span>
                        @else
                            <span class="badge bg-danger fs-6 p-2">Refusée</span>
                        @endif
                        
                        <p class="mt-3 mb-0">
                            <small class="text-muted">
                                Demandé le {{ $demande->created_at->format('d/m/Y à H:i') }}
                            </small>
                        </p>
                    </div>

                    @if($demande->statut == 'en_attente')
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.demandes.valider', $demande->id_demande) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg w-100"
                                    onclick="return confirm('Valider cette demande ?')">
                                <i class="fas fa-check"></i> Valider la demande
                            </button>
                        </form>
                        
                        <button type="button" class="btn btn-danger btn-lg w-100"
                                data-bs-toggle="modal" data-bs-target="#refuserModal">
                            <i class="fas fa-times"></i> Refuser la demande
                        </button>
                    </div>
                    @endif

                    @if($demande->commentaire_admin)
                    <div class="mt-4">
                        <h6>Commentaire admin :</h6>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            {{ $demande->commentaire_admin }}
                            @if($demande->adminTraitant)
                            <p class="mb-0 mt-2 text-muted">
                                <small>Par {{ $demande->adminTraitant->nom }} le {{ $demande->traitee_le->format('d/m/Y') }}</small>
                            </p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de refus -->
<div class="modal fade" id="refuserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.demandes.refuser', $demande->id_demande) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Refuser la demande #{{ $demande->id_demande }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Commentaire (obligatoire)</label>
                        <textarea name="commentaire" class="form-control" rows="4" required
                                placeholder="Expliquez pourquoi vous refusez cette demande..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Confirmer le refus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection