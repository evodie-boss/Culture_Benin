@extends('layout')

@section('title', 'Demandes contributeur')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Demandes contributeur</h1>
    
    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">En attente</div>
                            <div class="fs-5 fw-bold">{{ $stats['en_attente'] }}</div>
                        </div>
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Validées</div>
                            <div class="fs-5 fw-bold">{{ $stats['validees'] }}</div>
                        </div>
                        <i class="fas fa-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Refusées</div>
                            <div class="fs-5 fw-bold">{{ $stats['refusees'] }}</div>
                        </div>
                        <i class="fas fa-times fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des demandes -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Demandes en attente
        </div>
        <div class="card-body">
            @if($demandes->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date demande</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                        <tr>
                            <td>#{{ $demande->id_demande }}</td>
                            <td>{{ $demande->utilisateur->nom }}</td>
                            <td>{{ $demande->utilisateur->email }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" 
                                        data-bs-toggle="modal" data-bs-target="#messageModal{{ $demande->id_demande }}">
                                    Voir message
                                </button>
                            </td>
                            <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.demandes.show', $demande->id_demande) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.demandes.valider', $demande->id_demande) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('Valider cette demande ?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#refuserModal{{ $demande->id_demande }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal pour voir le message -->
                        <div class="modal fade" id="messageModal{{ $demande->id_demande }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Message de {{ $demande->utilisateur->nom }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $demande->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal pour refuser -->
                        <div class="modal fade" id="refuserModal{{ $demande->id_demande }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.demandes.refuser', $demande->id_demande) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Refuser la demande</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Commentaire (obligatoire)</label>
                                                <textarea name="commentaire" class="form-control" rows="3" required
                                                          placeholder="Pourquoi refusez-vous cette demande ?"></textarea>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $demandes->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucune demande en attente</h5>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection