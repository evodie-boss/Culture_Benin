@extends('layout')

@section('title')
<!-- CDN Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 p-3 rounded-2xl shadow-lg mr-4">
            <i class="fas fa-tachometer-alt text-white text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tableau de Bord Admin</h1>
            <p class="text-gray-600 mt-1">Aperçu général de votre plateforme culturelle</p>
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
                    <span class="ml-1 text-blue-600 font-medium">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Cartes de Statistiques Principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Carte Utilisateurs -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Utilisateurs</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            12%
                        </span>
                        <span class="text-gray-500 text-sm ml-2">vs mois dernier</span>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 rounded-2xl">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Carte Contenus -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Contenus Culturels</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_contents'] ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            8%
                        </span>
                        <span class="text-gray-500 text-sm ml-2">vs mois dernier</span>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4 rounded-2xl">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- AJOUT: Carte Contenus Premium -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Contenus Premium</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['premium_contents'] ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-amber-500 text-sm font-medium flex items-center">
                            <i class="fas fa-crown mr-1 text-xs"></i>
                            {{ $stats['premium_percentage'] ?? 0 }}%
                        </span>
                        <span class="text-gray-500 text-sm ml-2">du total</span>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-4 rounded-2xl">
                    <i class="fas fa-crown text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- AJOUT: Carte Transactions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Transactions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_transactions'] ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            {{ $stats['transactions_payees'] ?? 0 }} payées
                        </span>
                        <span class="text-gray-500 text-sm ml-2">/ {{ $stats['total_transactions'] ?? 0 }} total</span>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4 rounded-2xl">
                    <i class="fas fa-credit-card text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Deuxième ligne : Graphiques et Statistiques détaillées -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Graphique des contenus par type -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Contenus par Type</h3>
                <div class="bg-blue-50 px-3 py-1 rounded-lg">
                    <span class="text-blue-600 text-sm font-medium">Mensuel</span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="contentTypeChart"></canvas>
            </div>
        </div>

        <!-- Statistiques des utilisateurs et transactions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Statistiques Transactions</h3>
                <div class="bg-green-50 px-3 py-1 rounded-lg">
                    <span class="text-green-600 text-sm font-medium">FedaPay</span>
                </div>
            </div>
            <div class="space-y-4">
                <!-- Stat Transactions payées -->
                <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                    <div class="flex items-center">
                        <div class="bg-green-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Transactions payées</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['transactions_payees'] ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $stats['transactions_payees_percentage'] ?? 0 }}%
                        </span>
                    </div>
                </div>

                <!-- Stat Revenu total -->
                <div class="flex items-center justify-between p-4 bg-amber-50 rounded-xl">
                    <div class="flex items-center">
                        <div class="bg-amber-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-money-bill-wave text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Revenu total</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_revenue'] ?? 0, 0, ',', ' ') }} XOF</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                            <i class="fas fa-trend-up mr-1"></i>
                            {{ $stats['revenue_growth'] ?? 0 }}%
                        </span>
                    </div>
                </div>

                <!-- Stat Contenus premium vs gratuits -->
                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                    <div class="flex items-center">
                        <div class="bg-blue-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-chart-pie text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Premium vs Gratuit</p>
                            <p class="text-lg font-bold text-gray-900">
                                {{ $stats['premium_contents'] ?? 0 }} premium / {{ $stats['free_contents'] ?? 0 }} gratuit
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $stats['premium_percentage'] ?? 0 }}% premium
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Troisième ligne : Activité récente et accès rapide -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Activité récente -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Activité Récente</h3>
                <div class="bg-purple-50 px-3 py-1 rounded-lg">
                    <span class="text-purple-600 text-sm font-medium">24h</span>
                </div>
            </div>
            <div class="space-y-4">
                @if($recentActivities && count($recentActivities) > 0)
                    @foreach($recentActivities as $activity)
                    <div class="flex items-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <div class="bg-{{ $activity['color'] }}-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-{{ $activity['icon'] }} text-{{ $activity['color'] }}-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $activity['title'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activity['description'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-history text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Aucune activité récente</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Accès rapide -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Accès Rapide</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all duration-200 group">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4 group-hover:bg-blue-200 transition-colors duration-200">
                        <i class="fas fa-users text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Gestion Utilisateurs</p>
                        <p class="text-xs text-gray-500">Gérer les comptes utilisateurs</p>
                    </div>
                </a>

                <a href="{{ route('admin.contenus.index') }}" class="flex items-center p-4 border border-gray-100 rounded-xl hover:bg-green-50 hover:border-green-200 transition-all duration-200 group">
                    <div class="bg-green-100 p-3 rounded-lg mr-4 group-hover:bg-green-200 transition-colors duration-200">
                        <i class="fas fa-file-alt text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Contenus Culturels</p>
                        <p class="text-xs text-gray-500">Gérer les contenus</p>
                    </div>
                </a>

                <!-- AJOUT: Accès rapide aux transactions -->
                <a href="{{ route('admin.contenus.index') }}?premium=1" class="flex items-center p-4 border border-gray-100 rounded-xl hover:bg-amber-50 hover:border-amber-200 transition-all duration-200 group">
                    <div class="bg-amber-100 p-3 rounded-lg mr-4 group-hover:bg-amber-200 transition-colors duration-200">
                        <i class="fas fa-crown text-amber-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Contenus Premium</p>
                        <p class="text-xs text-gray-500">Gérer les contenus payants</p>
                    </div>
                </a>

                <!-- AJOUT: Accès rapide aux transactions -->
                <a href="#" onclick="alert('Page transactions à implémenter')" class="flex items-center p-4 border border-gray-100 rounded-xl hover:bg-purple-50 hover:border-purple-200 transition-all duration-200 group">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4 group-hover:bg-purple-200 transition-colors duration-200">
                        <i class="fas fa-credit-card text-purple-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Transactions</p>
                        <p class="text-xs text-gray-500">Voir les paiements</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique des types de contenu
    const contentTypeCtx = document.getElementById('contentTypeChart').getContext('2d');
    const contentTypeChart = new Chart(contentTypeCtx, {
        type: 'doughnut',
        data: {
            labels: ['Gratuit', 'Premium', 'En attente', 'Validés', 'Brouillons'],
            datasets: [{
                data: [
                    {{ $stats['free_contents'] ?? 0 }},
                    {{ $stats['premium_contents'] ?? 0 }},
                    {{ $stats['pending_contents'] ?? 0 }},
                    {{ $stats['validated_contents'] ?? 0 }},
                    {{ $stats['draft_contents'] ?? 0 }}
                ],
                backgroundColor: [
                    '#10b981', // Vert pour gratuit
                    '#f59e0b', // Orange pour premium
                    '#6b7280', // Gris pour en attente
                    '#3b82f6', // Bleu pour validés
                    '#ef4444'  // Rouge pour brouillons
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw + ' contenus';
                            return label;
                        }
                    }
                }
            },
            cutout: '65%'
        }
    });

    // Animation des cartes au chargement
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

<style>
/* Animations personnalisées */
.bg-white {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
}

/* Styles pour les graphiques */
.chart-container {
    position: relative;
    height: 300px;
}

/* Effet de brillance sur les cartes */
.bg-gradient-to-r {
    position: relative;
    overflow: hidden;
}

.bg-gradient-to-r::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.bg-gradient-to-r:hover::before {
    left: 100%;
}

/* Animation pour les cartes premium */
@keyframes premium-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.3); }
    50% { box-shadow: 0 0 30px rgba(245, 158, 11, 0.5); }
}

.bg-gradient-to-r.from-amber-500 {
    animation: premium-glow 2s infinite;
}
</style>
@endsection