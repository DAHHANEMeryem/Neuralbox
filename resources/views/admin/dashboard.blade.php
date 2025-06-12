@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')
<link href="{{asset('css/dashbordadmin.css')}}" rel="stylesheet">
<div class="mb-8">
<div class="admin-dashboard-header">
    <div class="admin-dashboard-title">
        <h1 class="admin-dashboard-heading">Tableau de bord Admin</h1>
        <p class="admin-dashboard-subtitle">Bienvenue ! Voici une vue d'ensemble de votre plateforme.</p>
    </div>
    <div class="admin-dashboard-actions">
        <button class="btn-filter">
            <i class="fas fa-filter mr-2"></i>
            Filtres
        </button>
        <button class="btn-export">
            <i class="fas fa-download mr-2"></i>
            Exporter
        </button>
    </div>
</div>


<div class="dashboard-cards-grid">
    <!-- Card 1 -->
    


    <!-- Card 2 -->
    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <div>
                <h3 class="dashboard-card-title">Total revenus</h3>
                <p class="dashboard-card-value">{{ $revenus_mois ?? '56,562' }}  DH</p>
            </div>
            <div class="dashboard-card-icon bg-green">
                <i class="fas fa-money-bill-wave text-green-500"></i>
            </div>
        </div>
        <div class="dashboard-progress">
    <div class="progress-bar">
        <div class="progress-fill bg-green" style="width: {{ $evolution_revenus ?? 0 }}%"></div>
    </div>
    <span class="progress-percentage text-green">+{{ $evolution_revenus ?? 0 }}%</span>
</div>

        <div class="dashboard-card-footer">
            <a href="/admin/paiements" class="dashboard-link">Voir tout <i class="fas fa-chevron-right ml-1 text-xs"></i></a>
            <span class="dashboard-subtext">Par rapport au mois dernier</span>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <div>
                <h3 class="dashboard-card-title">Total paiments</h3>
                <p class="dashboard-card-value">{{ $revenus_mois ?? '56,562' }} DH</p>
            </div>
            <div class="dashboard-card-icon bg-green">
                <i class="fas fa-money-bill-wave text-green-500"></i>
            </div>
        </div>
        <div class="dashboard-progress">
            <div class="progress-bar">
            <div class="progress-fill bg-green" style="width: {{ $evolution_revenus ?? 0 }}%"></div>
            </div>
            <span class="progress-percentage text-green">+{{ $evolution_revenus ?? 0 }}%</span>
        </div>
        <div class="dashboard-card-footer">
            <a href="/admin/paiements" class="dashboard-link">Voir tout <i class="fas fa-chevron-right ml-1 text-xs"></i></a>
            <span class="dashboard-subtext">Par rapport au mois dernier</span>
        </div>
    </div>

    <div class="dashboard-card">
    <!-- En-tête -->
    <div class="dashboard-card-header">
        <div>
            <h3 class="dashboard-card-title">Total Utilisateurs</h3>
            <p class="dashboard-card-value">{{ $nombre_utilisateurs }}</p>
        </div>
        <div class="dashboard-card-icon bg-blue">
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
<div class="dashboard-progress">
        <div class="progress-bar">
            <div class="progress-fill bg-blue" style="width: {{ abs($evolution_utilisateurs) }}%"></div>
        </div>
        <span class="progress-percentage {{ $evolution_utilisateurs >= 0 ? 'text-green' : 'text-red-500' }}">
            {{ $evolution_utilisateurs >= 0 ? '+' : '' }}{{ $evolution_utilisateurs }}%
        </span>
    </div>

    <!-- Footer -->
    <div class="dashboard-card-footer mt-4">
        <a href="{{ route('admin.utilisateurs') }}" class="dashboard-link">
            Voir tout <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
        <span class="dashboard-subtext">Par rapport au mois dernier</span>
    </div>
</div>


    </div>
</div>

 


<!-- Exemple avec Style 3: Arrondi et Coloré -->
<div class="flex grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Card 4 - Conversion Rate -->
    <div class="dashboard-card-rounded conversion-card-rounded">
    <div class="card-header-rounded">
        <div>
            <h3 class="card-title-rounded">Messages</h3>
            <p class="card-value-rounded conversion-value-rounded">
                Total : {{ $totalMessages }}
            </p>
        </div>
        <div class="card-icon-container-rounded conversion-icon-bg-rounded">
            <i class="fas fa-envelope conversion-icon-rounded"></i>
        </div>
    </div>

    <div class="flex justify-between px-4 py-2">
        <div class="flex flex-col items-center">
            <span class="text-sm text-gray-500">Non lus</span>
            <span class="text-lg font-bold text-red-500">{{ $messagesNonLus }}</span>
        </div>
        <div class="flex flex-col items-center">
            <span class="text-sm text-gray-500">Lus</span>
            <span class="text-lg font-bold text-green-600">{{ $messagesLus }}</span>
        </div>
    </div>

    <div class="card-chart">
    @php
    $total = $messagesNonLus + $messagesLus;
    $percentNonLus = $total > 0 ? round(($messagesNonLus / $total) * 100) : 0;
    $percentLus = $total > 0 ? round(($messagesLus / $total) * 100) : 0;
@endphp



<div class="flex items-end h-16 space-x-1 px-4 bg-green-100 rounded-md">
    <div class="w-1/2 bg-red-400 rounded-t-lg transition-all duration-300" style="height: {{ $percentNonLus }}%;" title="Non lus"></div>
    <div class="w-1/2 bg-green-500 rounded-t-lg transition-all duration-300" style="height: {{ $percentLus }}%;" title="Lus"></div>
</div>


    </div>
    
    <div class="card-footer-rounded flex justify-between items-center">
    
        <a href="{{ route('admin.messages.index') }}" class="card-link-rounded conversion-link-rounded">
            Voir tous les messages
            <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
        <span class="card-status-rounded status-positive-rounded">
           Non lus : {{ $percentNonLus }}% | Lus : {{ $percentLus }}%
        </span>
    </div>
</div>
@php
    $total = $reussis + $enAttente + $annules ;
    
@endphp

    <!-- Card 5 - Total Deals -->
    <div class="dashboard-card-rounded deals-card-rounded"> 
    <div class="card-header-rounded">
        <div>
            <h3 class="card-title-rounded">Total Rendez-vous</h3>
            <p class="card-value-rounded deals-value-rounded">{{$total}}</p>
        </div>
        <div class="card-icon-container-rounded deals-icon-bg-rounded">
            <i class="fas fa-calendar-check deals-icon-rounded"></i>
        </div>
    </div>
  
    <br>
    
    <div class="card-chart">
        @foreach($rdvsParMois as $count)
            @php
                $max = max($rdvsParMois) ?: 1;
                $height = ($count / $max) * 100;
            @endphp
            <div class="chart-bar deals-bar" style="height: {{ $height }}%;"></div>
        @endforeach
    </div>
<br>
    <div class="card-footer-rounded">
        <a href="/admin/rendezvous" class="card-link-rounded deals-link-rounded">
            Voir tout
            <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
        

<!-- Affichage du pourcentage basé sur l'évolution des rendez-vous -->
<span class="card-status-rounded status-positive-rounded">
    @if($rdvMoisActuel > 0)
        {{ $pourcentageRdv }}% ce mois
    @else
        0% ce mois
    @endif
</span>

    </div>
</div>

</div>



    <!-- Third Row - Revenue Analytics Card -->
    <div class="revenus-analytics-container">
    <div class="analytics-card">
        <div class="card-header">
            <h3 class="header-title">Revenus Analytics</h3>
            <div class="period-selector">
                <button class="period-button">Jour</button>
                <button class="period-button">Semaine</button>
                <button class="period-button period-button-active">Mois</button>
                <button class="period-button">Année</button>
            </div>
        </div>
        <div class="chart-container">
            <!-- Placeholder for analytics chart -->
            <div class="chart-visualization">
                <!-- <div class="chart-placeholder">
                    <i class="fas fa-chart-line chart-icon"></i>
                </div> -->
                <!-- Creating a simple line chart visualization -->
                <svg viewBox="0 0 1000 200" class="chart-svg">
                    <path d="M0,150 Q100,100 200,130 T400,90 T600,140 T800,60 T1000,100" class="revenue-line" />
                    <path d="M0,170 Q100,120 200,150 T400,130 T600,160 T800,100 T1000,130" class="profit-line" />
                </svg>
            </div>
        </div>
        <div class="chart-footer">
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color revenue-color"></div>
                    <span class="legend-text">Revenus</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color profit-color"></div>
                    <span class="legend-text">Profit</span>
                </div>
            </div>
            <a href="#" class="view-all-link">
                Voir tout
                <i class="fas fa-chevron-right link-icon"></i>
            </a>
        </div>
    </div>
</div>
    <!-- Fourth Row - Two Cards -->
    @php
    $total = $reussis + $enAttente + $annules ;
    $pctReussis = $total > 0 ? ($reussis / $total) * 100 : 0;
    $pctAttente = $total > 0 ? ($enAttente / $total) * 100 : 0;
    $pctAnnules = $total > 0 ? ($annules / $total) * 100 : 0;
   
    $totalEvolution = $evolution ?? 0;
@endphp

<!-- Fourth Row - Two Cards -->
 <div  class="revenus-analytics-container">
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
    <span class="text-2xl font-bold">{{ $total }}</span>

    @php
        // Conditions personnalisées basées sur le total
        if ($total == 0) {
            $totalEvolution = 0;
        } elseif ($total <= 10) {
            $totalEvolution = 10;
        } elseif ($total <= 20) {
            $totalEvolution = 20;
        } elseif ($total <= 30) {
            $totalEvolution = 30;
        } elseif ($total <= 50) {
            $totalEvolution = 50;
        } elseif ($total <= 100) {
            $totalEvolution = 75;
        } else {
            $totalEvolution = 100;
        }

        // Choisir la couleur selon le pourcentage
        $evolutionColor = $totalEvolution === 0 ? 'text-gray-500'
                        : ($totalEvolution <= 30 ? 'text-yellow-500'
                        : ($totalEvolution <= 75 ? 'text-orange-500'
                        : 'text-green-500'));

        $evolutionPrefix = $totalEvolution > 0 ? '+' : '';
    @endphp

    <span class="{{ $evolutionColor }} text-sm">
        {{ $evolutionPrefix }}{{ $totalEvolution }}%
    </span>
</div>


    <!-- Barre de progression globale -->
    @php
        $progressPercent = $total > 0 ? round((($reussis  ) / $total) * 100) : 0;
        $progressColor = $progressPercent >= 75 ? 'from-green-500 to-indigo-500'
                       : ($progressPercent >= 50 ? 'from-yellow-400 to-yellow-600'
                       : ($progressPercent >= 25 ? 'from-orange-400 to-orange-600'
                       : 'from-red-400 to-red-600'));
    @endphp

    <div class="w-full h-2 bg-gray-200 rounded-full">
        <div class="h-2 rounded-full bg-gradient-to-r {{ $progressColor }}" style="width: {{ $progressPercent }}%"></div>
    </div>

    <div class="text-xs text-gray-500 mt-1">
        Comparé au mois dernier
    </div>
</div>
    

        <!-- Détails par statut -->
        <div class="space-y-4">
            <!-- Réussis -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Accepte</span>
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

            <!-- À venir -->
           
        </div>
    </div>
</div>
</div>
<div class="p-6 ">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-gray-800 font-medium">Activité Récente</h3>
                <a href="#" class="text-blue-500 text-sm flex items-center">
                    Voir tout
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            <div class="space-y-4">
                <div class="border-l-2 border-blue-500 pl-4 pb-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">Mise à jour du calendrier</span>
                        <span class="text-xs text-gray-500 ml-auto">12:00</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Ajout de nouveaux événements au système</p>
                </div>
                <div class="border-l-2 border-green-500 pl-4 pb-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">Nouveau thème pour le site web</span>
                        <span class="text-xs text-gray-500 ml-auto">09:45</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Complétion et ajout du nouveau design</p>
                </div>
                <div class="border-l-2 border-yellow-500 pl-4 pb-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">Nouveau task créé</span>
                        <span class="text-xs text-gray-500 ml-auto">Hier</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Ajout d'une nouvelle tâche dans le système</p>
                </div>
                <div class="border-l-2 border-indigo-500 pl-4 pb-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">32 nouveaux utilisateurs</span>
                        <span class="text-xs text-gray-500 ml-auto">Hier</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Nouveaux membres rejoignant la plateforme</p>
                </div>
                <div class="border-l-2 border-red-500 pl-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">Réponse au support client</span>
                        <span class="text-xs text-gray-500 ml-auto">2 jours</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Résolution d'une demande de support</p>
                </div>
            </div>
        </div>
</div>
</div>

    <!-- Fifth Row - Upcoming Appointments Table -->
  <!-- Fifth Row - Upcoming Appointments Table -->
   <div class="p-8">

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-gray-800 font-medium">Prochains rendez-vous</h3>
            <div class="relative">
                <input type="text" placeholder="Rechercher ici..." class="px-3 py-1 pr-8 text-sm rounded-md border border-gray-300 focus:outline-none focus:border-indigo-500">
                <i class="fas fa-search text-gray-400 absolute right-3 top-2 text-xs"></i>
            </div>
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
                                    <div class="w-8 h-8 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-semibold mr-3">
                                        {{ substr($rdv->user->name ?? 'P', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $rdv->user->name ?? 'Parent inconnu' }}</p>
                                        <p class="text-xs text-gray-500">{{ $rdv->user->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Spécialiste -->
                           
                            <!-- Type -->
                           

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


    <!-- Sixth Row - Objectives Card -->
    <div class="mt-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
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
                <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
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
                </div>
                
                <!-- Objectif 6 -->
                <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="bg-red-100 p-2 rounded-md mr-3">
                            <i class="fas fa-chart-bar text-red-600"></i>
                        </div>
                        <h4 class="font-medium">📊 Statistiques</h4>
                    </div>
                    <ul class="text-sm text-gray-600 space-y-2 ml-4">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                            Évolution utilisateurs/paiements
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                            Rapports hebdomadaires
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right text-indigo-500 mr-2 text-xs"></i>
                            <a href="/admin/statistiques" class="text-indigo-500 hover:underline">Voir les statistiques</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection