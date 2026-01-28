@extends('layouts.admin')

@section('title', 'نيورال بوكس | الرئيسية')


@section('content')
<link href="{{asset('assets/css/dashbordadmin.css')}}" rel="stylesheet">
<div class="mb-8 ">
    <div class="justify-between gap-4 flex flex-col mb-2 md:flex-row">
        <div class="">
            <h1 class="admin-dashboard-heading font-semibold text-xl md:text-3xl ">Tableau de bord Admin</h1>
            <p class="admin-dashboard-subtitle text-sm md:text-lg">Bienvenue ! Voici une vue d'ensemble de votre plateforme.</p>
        </div>
        <div class="admin-dashboard-actions">
            <form id="formFiltre" method="GET">
                <input type="hidden" name="filtre" id="filtreInput" value="{{ $filtre }}">
                <button type="button" class="btn-filter md:flex text-sm py-2 md:px-4 px-2" onclick="changerMode()">Filtrer par <span id="filtreLabel">{{ ucfirst($filtre) }}</span></button>
            </form>

            <a href="{{ route('admin.export.dashboard.pdf') }}" class="py-2 md:px-4 px-2 text-sm md:text-base bg-blue-500 text-white rounded">
                Exporter en PDF
            </a>

        </div>

    </div>


    <div class="dashboard-cards-grid">
        <!-- Card 1 -->



        <!-- Card 2 -->
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <div>
                    <h3 class="dashboard-card-title">Total revenus</h3>
                    <p class="dashboard-card-value">{{ $revenus_total ?? '00.00' }}DH </p>
                </div>
                <div class="dashboard-card-icon bg-green-100">
                    <i class="fas fa-money-bill-wave text-green-500"></i>
                </div>
            </div>
            <div class="dashboard-progress">
                <div class="progress-bar">
                    <div class="progress-fill bg-green" style="width: {{ $evolution_revenus }}%"></div>
                </div>
                <span class="progress-percentage text-green">+{{ $evolution_revenus }}%</span>
            </div>

            <div class="dashboard-card-footer">
                <a href="/admin/paiements" class="dashboard-link">Voir tout <i class="fas fa-chevron-right ml-1 text-xs"></i></a>
                <span class="dashboard-subtext">{{ $phrase}}</span>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <div>
                    <h3 class="dashboard-card-title">Total Abonnements</h3>
                    <p class="dashboard-card-value">{{ $abonne_total ?? '00.00' }} </p>
                </div>
                <div class="dashboard-card-icon bg-green-100">

                    <i class="fas fa-user text-green-500"></i>
                </div>
            </div>
            <div class="dashboard-progress">
                <div class="progress-bar">
                    <div class="progress-fill bg-green" style="width: {{ $evolution_paiments ?? 0 }}%"></div>
                </div>
                <span class="progress-percentage text-green">+{{$evolution_paiments ?? 0 }}%</span>
            </div>
            <div class="dashboard-card-footer">
                <a href="/admin/paiements" class="dashboard-link">Voir tout <i class="fas fa-chevron-right ml-1 text-xs"></i></a>
                <span class="dashboard-subtext">{{ $phrase}}</span>
            </div>
        </div>

        <div class="dashboard-card">
            <!-- En-tête -->
            <div class="dashboard-card-header">
                <div>
                    <h3 class="dashboard-card-title">Total Utilisateurs</h3>
                    <p class="dashboard-card-value">{{ $nombre_utilisateurs }}</p>
                </div>
                <div class="dashboard-card-icon bg-blue-100">
                    <i class="fas fa-users text-blue-500"></i>
                </div>
            </div>

            <!-- Barre de progression -->

            <!-- Détail utilisateurs -->
            <div class="user-chart-wrapper mt-4">
                <div class="user-chart-circle">
                    <span class="dashboard-card-value">{{ $nombre_utilisateurs }}</span>
                </div>
                <div class="user-chart-legend">
                    <div class="legend-item">
                        <div class="legend-color bg-indigo-500"></div>
                        <span>Parents: {{ $nombre_parents }}</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color bg-yellow-500"></div>
                        <span>Nouveaux: {{ $nouveaux_utilisateurs }}</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color bg-red-500"></div>
                        <span>Inactifs: {{ $inactifs_utilisateurs }}</span>
                    </div>
                </div>
            </div>
            <div class="dashboard-progress mt-4">
                <div class="progress-bar h-3 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="progress-fill h-full transition-all duration-300
            {{ $evolution_utilisateurs >= 0 ? 'bg-green-500' : 'bg-red-500' }}"
                        style="width: {{ min(abs($evolution_utilisateurs), 100) }}%">
                    </div>
                </div>

                <span class="progress-percentage mt-1 block text-sm font-semibold
        {{ $evolution_utilisateurs >= 0 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $evolution_utilisateurs >= 0 ? '+' : '' }}{{ number_format($evolution_utilisateurs, 1) }}%
                </span>
            </div>


            <!-- Footer -->
            <div class="dashboard-card-footer mt-4">
                <a href="{{ route('admin.utilisateurs') }}" class="dashboard-link">
                    Voir tout <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
                <span class="dashboard-subtext">{{$phrase}}</span>
            </div>
        </div>


    </div>
</div>

{{-- <div class="revenus-analytics-container">
    <div class="analytics-card">
        <div class="card-header">
            <h3 class="header-title">Revenus Analytics</h3>
        </div>
        <div class="chart-container">
            <canvas id="revenusChart" width="1000" height="200"></canvas>
        </div>
        <div class="chart-footer">
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color revenue-color" style="background-color:#4ade80;"></div>
                    <span class="legend-text">Revenus</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color profit-color" style="background-color:#3b82f6;"></div>
                    <span class="legend-text">Abonnés</span>
                </div>
            </div>
            <a href="/admin/paiements" class="view-all-link">
                Voir tout
                <i class="fas fa-chevron-right link-icon"></i>
            </a>
        </div>
    </div>

    
</div> --}}



<!-- Exemple avec Style 3: Arrondi et Coloré -->
<div class="flex flex-col md:flex-row grid-cols-1 md:grid-cols-2 gap-6 mt-6">
   
    <div class="analytics-card md:w-1/2">
        <div class="card-header">
            <h3 class="header-title">Revenus Analytics</h3>
        </div>
        <div class="chart-container">
            <canvas id="revenusChart" width="1000" height="200"></canvas>
        </div>
        <div class="chart-footer">
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color revenue-color" style="background-color:#4ade80;"></div>
                    <span class="legend-text">Revenus</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color profit-color" style="background-color:#3b82f6;"></div>
                    <span class="legend-text">Abonnés</span>
                </div>
            </div>
            <a href="/admin/paiements" class="view-all-link">
                Voir tout
                <i class="fas fa-chevron-right link-icon"></i>
            </a>
        </div>
    </div>

    <div class="dashboard-card-rounded deals-card-rounded">
        <div class="card-header-rounded">
            <div>
                <h3 class="card-title-rounded">Total Rendez-vous</h3>
                <p class="card-value-rounded deals-value-rounded">{{ $totalRdv }}</p>
            </div>
            <div class="card-icon-container-rounded deals-icon-bg-rounded">
                <i class="fas fa-calendar-check deals-icon-rounded"></i>
            </div>
        </div>



        <br>

        <!-- <span class="hidden bg-green-600 bg-yellow-400 bg-red-400"></span> -->

        <!-- Graphique des 7 derniers jours -->
        <div class="card-chart flex items-end justify-between h-24 px-4 rounded-md">
            @foreach($last as $data)
            <div class="relative flex items-end justify-center h-24">
                <div
                    class="w-4 rounded-t-md shadow-md transform transition-transform duration-500 hover:scale-105"
                    style="
                height: {{ $data['height'] }}%;
                background: linear-gradient(to top, {{ $data['color'] === 'bg-green-600' ? '#16a34a' : ($data['color'] === 'bg-yellow-400' ? '#facc15' : '#f87171') }}, #fff);"
                    title="{{ $data['count'] }} RDV">
                </div>
                <span class="absolute bottom-[-1.5rem] text-xs text-gray-600">{{ $data['date'] }}</span>
            </div>

            @endforeach
        </div>

        <br>

        <div class="card-footer-rounded flex flex-col-reverse md:flex-row items-center justify-between">
            <a href="{{ route('admin.rendezvous.index') }}" class="card-link-rounded deals-link-rounded">
                Voir tout
                <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>

            <span class="card-status-rounded {{ $evolution >= 0 ? 'status-positive-rounded' : 'status-negative-rounded' }}">
                Évolution : {{ $evolution >= 0 ? '+' : '' }}{{ $evolution }}% depuis {{ $phrase1 }}
            </span>
        </div>
    </div>
</div>



<!-- Fourth Row - Two Cards -->


<!-- Fourth Row - Two Cards -->
<div class="revenus-analytics-container">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Card - État des Rendez-vous -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-gray-800 font-medium text-lg">État des Rendez-vous</h3>
                <a href="/admin/rendezvous" class="text-blue-500 text-sm flex items-center hover:underline">
                    Voir tout
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>

            <!-- Résumé global -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-2xl font-bold">{{ $totalRDV }} <span class="text-sm text-gray-500">{{$phrase3}}</span></span>
                    <span class="{{ $evolutionColor }} text-sm">
                        {{ $evolutionPrefix }}{{ $totalEvolution }}%
                    </span>
                </div>
                @php
                // Conditions personnalisées basées sur le total
                if ($totalRDV == 0) {
                $totalEvolution = 0;
                } elseif ($totalRDV <= 10) {
                    $totalEvolution=10;
                    } elseif ($totalRDV <=20) {
                    $totalEvolution=20;
                    } elseif ($totalRDV <=30) {
                    $totalEvolution=30;
                    } elseif ($totalRDV <=50) {
                    $totalEvolution=50;
                    } elseif ($totalRDV <=100) {
                    $totalEvolution=75;
                    } else {
                    $totalEvolution=100;
                    }

                    // Choisir la couleur selon le pourcentage
                    $evolutionColor=$totalEvolution===0 ? 'text-gray-500'
                    : ($totalEvolution <=30 ? 'text-yellow-500'
                    : ($totalEvolution <=75 ? 'text-pu-500'
                    : 'text-green-500' ));

                    $evolutionPrefix=$totalEvolution> 0 ? '+' : '';
                    @endphp

                    <div class="w-full h-2 bg-gray-200 rounded-full">
                        <div class="h-2 rounded-full bg-gradient-to-r  {{ $progressColor }}" style="width: {{ $progressPercent }}%"></div>
                    </div>

                    <div class="text-xs text-gray-500 mt-1">
                        {{ $phrase }}
                        <br>
                        <span class="text-[11px] italic text-gray-400">
                            {{$phrase4}}: {{ $rdvlast }} rendez-vous
                        </span>
                    </div>
            </div>

            <!-- Détails par statut -->
            <div class="space-y-4">
                <!-- Acceptés -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Acceptés</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm font-medium mr-2">{{ $reussis }}</span>
                        <div class="w-16 h-1 bg-gray-200 rounded-full">
                            <div class="h-1 rounded-full bg-green-500" style="width: {{ $pctReussis }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- En attente -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">En attente</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm font-medium mr-2">{{ $enAttente }}</span>
                        <div class="w-16 h-1 bg-gray-200 rounded-full">
                            <div class="h-1 rounded-full bg-yellow-500" style="width: {{ $pctAttente }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Annulés -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Annulés</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm font-medium mr-2">{{ $annules }}</span>
                        <div class="w-16 h-1 bg-gray-200 rounded-full">
                            <div class="h-1 rounded-full bg-red-500" style="width: {{ $pctAnnules }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>





<!-- Fifth Row - Upcoming Appointments Table -->
<!-- Fifth Row - Upcoming Appointments Table -->
<div class="md:p-8 p-2">

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-gray-800 font-medium">Prochains rendez-vous</h3>
            <!-- <div class="relative">
                <input type="text" placeholder="Rechercher ici..." class="px-3 py-1 pr-8 text-sm rounded-md border border-gray-300 focus:outline-none focus:border-indigo-500">
                <i class="fas fa-search text-gray-400 absolute right-3 top-2 text-xs"></i>
            </div> -->
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <th class="px-4 py-2">Parent</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($prochains_rdv as $rdv)
                    <tr class="border-t border-gray-200">
                        <!-- Parent -->
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="hidden w-8 h-8 rounded-full bg-indigo-200 md:flex items-center justify-center text-indigo-700 font-semibold mr-3">
                                    {{ substr($rdv->email ?? 'P', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-medium">{{ $rdv->email }}</p>
                                    {{-- <p class="text-xs text-gray-500">{{ $rdv->numero ?? '' }}</p> --}}
                                </div>
                            </div>
                        </td>
                        <!-- Date -->
                        <td class="px-4 py-3">
                            {{ $rdv->numero }}
                        </td>

                        <!-- Lieu -->


                        <!-- Date -->
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y H:i') }}
                        </td>

                        <!-- Action -->
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('rendezvous.show', $rdv->id) }}" class="p-1 text-blue-500 hover:bg-blue-100 rounded" title="Voir">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="p-1 text-green-500 hover:bg-green-100 rounded" title="Modifier">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="border-t border-gray-200">
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 italic">Aucun rendez-vous à venir.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-gray-500">Affichant {{ $prochains_rdv->count() }} entrées</div>
        </div>
    </div>

</div>


<div class="p-2 md:p-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-gray-800 font-medium">Activité Récente</h3>
            <!-- <a href="#" class="text-blue-500 text-sm flex items-center">Voir tout
                <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a> -->
        </div>
        <div class="space-y-4">

            @if($recentRdv)
            <div class="border-l-2 border-blue-500 pl-4 pb-4">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                    <span class="text-sm font-medium">Nouveau rendez-vous réservé</span>
                    <span class="text-xs text-gray-500 ml-auto">{{ $recentRdv->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $recentRdv->user->name ?? 'Utilisateur inconnu' }} a pris un rendez-vous
                </p>
            </div>
            @endif

            {{-- @if($recentMessage)
            <div class="border-l-2 border-green-500 pl-4 pb-4">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm font-medium">Nouveau message reçu</span>
                    <span class="text-xs text-gray-500 ml-auto">{{ $recentMessage->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            Message de {{ $recentMessage->user->name ?? 'Inconnu' }}
        </p>
    </div>
    @endif --}}

    @if($recentPaiement)
    <div class="border-l-2 border-yellow-500 pl-4 pb-4">
        <div class="flex items-center">
            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
            <span class="text-sm font-medium">Paiement confirmé</span>
            <span class="text-xs text-gray-500 ml-auto">{{ $recentPaiement->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            Paiement de {{ $recentPaiement->montant }} MAD par {{ $recentPaiement->user->name ?? 'Client inconnu' }}
        </p>
    </div>
    @endif

    @if($recentRessource)
    <div class="border-l-2 border-indigo-500 pl-4 pb-4">
        <div class="flex items-center">
            <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
            <span class="text-sm font-medium">Nouvelle ressource ajoutée</span>
            <span class="text-xs text-gray-500 ml-auto">{{ $recentRessource->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            Ressource : {{ Str::limit($recentRessource->titre, 30) }}
        </p>
    </div>
    @endif

    @if($recentUser)
    <div class="border-l-2 border-red-500 pl-4">
        <div class="flex items-center">
            <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
            <span class="text-sm font-medium">Nouvel utilisateur inscrit</span>
            <span class="text-xs text-gray-500 ml-auto">{{ $recentUser->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            Bienvenue à {{ $recentUser->name }}
        </p>
    </div>
    @endif

</div>
</div>
</div>
<!-- Sixth Row - Objectives Card -->
<div class="p-2 md:p-6">
    <div class="bg-white rounded-lg shadow-sm p-2 md:p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">🎯 Objectifs</h3>
        <p class="text-gray-800 mb-6">Avoir une vision complète du fonctionnement de la plateforme.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Objectif 1 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                <div class="flex items-center mb-3">
                    <div class="bg-indigo-100 p-2 rounded-md mr-3">
                        <i class="fas fa-users text-indigo-600"></i>
                    </div>
                    <h4 class="font-medium">👥 Utilisateurs</h4>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-4">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Le nombre total d'utilisateurs
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        liste infos utilisateurs
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                        <a href="/admin/utilisateurs" class="text-indigo-500 hover:underline">Gérer les utilisateurs</a>
                    </li>
                </ul>
            </div>

            <!-- Objectif 2 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                <div class="flex items-center mb-3">
                    <div class="bg-green-100 p-2 rounded-md mr-3">
                        <i class="fas fa-calendar-alt text-green-600"></i>
                    </div>
                    <h4 class="font-medium">📆 Rendez-vous</h4>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-4">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Total RDV aujourd'hui/semaine
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Statuts: attente, confirmés, annulés
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                        <a href="/admin/rendezvous" class="text-indigo-500 hover:underline">Gérer les rendez-vous</a>
                    </li>
                </ul>
            </div>

            <!-- Objectif 3 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                <div class="flex items-center mb-3">
                    <div class="bg-yellow-100 p-2 rounded-md mr-3">
                        <i class="fas fa-credit-card text-yellow-600"></i>
                    </div>
                    <h4 class="font-medium">💳 Paiements</h4>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-4">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Nombre d'abonnés actifs
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Derniers paiements reçus
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                        <a href="/admin/paiements" class="text-indigo-500 hover:underline">Gérer les paiements</a>
                    </li>
                </ul>
            </div>

            <!-- Objectif 4 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                <div class="flex items-center mb-3">
                    <div class="bg-blue-100 p-2 rounded-md mr-3">
                        <i class="fas fa-book text-blue-600"></i>
                    </div>
                    <h4 class="font-medium">📚 Ressources</h4>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-4">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Nombre total de ressources publiées
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-plus text-blue-500 mr-2 text-xs"></i>
                        <a href="/admin/ressources/create" class="text-indigo-500 hover:underline">Ajouter un article/vidéo</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                        <a href="/admin/ressources" class="text-indigo-500 hover:underline">Gérer les ressources</a>
                    </li>
                </ul>
            </div>

            <!-- Objectif 5 -->
            <!-- <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                <div class="flex items-center mb-3">
                    <div class="bg-purple-100 p-2 rounded-md mr-3">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <h4 class="font-medium">📩 Messagerie</h4>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-4">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        {{$messagesNonLus ?? 0 }} messages non lus
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Alertes ou requêtes en attente
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                        <a href="/admin/messages" class="text-indigo-500 hover:underline">Gérer la messagerie</a>
                    </li>
                </ul>
            </div> -->

            <!-- Objectif 6 - Messagerie -->

            <!-- <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">

                <div class="flex items-center mb-3">

                    <div class="bg-blue-100 p-2 rounded-md mr-3">

                        <i class="fas fa-comments text-blue-600"></i>

                    </div>

                    <h4 class="font-medium">💬 Messagerie</h4>

                </div>

                <ul class="text-sm text-gray-600 space-y-2 ml-4">

                    <li class="flex items-center">

                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>

                        Conversation avec les utilisateurs

                    </li>

                    <li class="flex items-center">

                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>

                        Réponses des administrateurs

                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                        <a href="/messagerie" class="text-indigo-500 hover:underline">Accéder à la messagerie</a>
                    </li>
                </ul>
            </div> -->

        </div>
    </div>
</div>
</div>
<script>

    let modes = ['jour', 'semaine', 'mois', 'annee'];
    let currentIndex = modes.indexOf("{{ $filtre }}");

    function changerMode() {
        currentIndex = (currentIndex + 1) % modes.length;
        document.getElementById('filtreLabel').innerText = modes[currentIndex].charAt(0).toUpperCase() + modes[currentIndex].slice(1);
        document.getElementById('filtreInput').value = modes[currentIndex];
        document.getElementById('formFiltre').submit();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

console.log(window.innerWidth);

    if(window.innerWidth < 768)
        document.getElementById('revenusChart').setAttribute('width',250);

    const ctx = document.getElementById('revenusChart').getContext('2d');

    const revenusChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!!json_encode($dates) !!},
            datasets: [{
                    label: 'Revenus (MAD)',
                    data: {!!json_encode($revenus) !!},
                    borderColor: '#4ade80',
                    backgroundColor: 'rgba(74, 222, 128, 0.2)',
                    fill: true,
                    tension: 0.3,
                    yAxisID: 'y1',
                },
                {
                    label: 'Abonnés',
                    data: {!!json_encode($abonnes) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.3,
                    yAxisID: 'y2',
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y1: {
                    type: 'linear',
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Revenus (MAD)',
                    },
                    beginAtZero: true,
                },
                y2: {
                    type: 'linear',
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Abonnés',
                    },
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false,
                    },
                },
            },
        },
    });
</script>

@endsection