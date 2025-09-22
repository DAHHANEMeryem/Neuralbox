<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RendezVous;
use App\Models\Paiement;
use App\Models\Message;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request)
    {



 $rdvs = RendezVous::all();

        $totalRDV = RendezVous::count();
 $nombre_utilisateurs = User::count();
    $nombre_parents =  User::where('email', '!=', 'admin@gmail.com')->count();
 $totalRdv = RendezVous::count();


        $moisActuel = Carbon::now()->month;


        $reussis = RendezVous::where('statut', 'confirme')->count();
        $enAttente = RendezVous::where('statut', 'attente')->count();
        $annules = RendezVous::where('statut', 'annule')->count();


        $total = $reussis + $enAttente + $annules ;
        $pourcentageReussis = $total > 0 ? ($reussis / $total) * 100 : 0;
        $rdvsMoisActuel = RendezVous::whereMonth('date', now()->month)->count();
        $rdvsMoisPrecedent = RendezVous::whereMonth('date', now()->subMonth()->month)->count();
        $pourcentage = $rdvsMoisPrecedent > 0
            ? number_format((($rdvsMoisActuel - $rdvsMoisPrecedent) / $rdvsMoisPrecedent) * 100, 0)
            : 0;

        // Évolution des utilisateurs par rapport au mois précédent
        $debutMoisActuel = Carbon::now()->startOfMonth();
        $finMoisActuel = Carbon::now()->endOfMonth();

        $debutMoisPrecedent = Carbon::now()->subMonth()->startOfMonth();
        $finMoisPrecedent = Carbon::now()->subMonth()->endOfMonth();
        $rdvMoisActuel = RendezVous::whereMonth('date', now()->month)->count();  // Compte les rendez-vous du mois actuel
        $rdvMoisPrecedent = RendezVous::whereMonth('date', now()->subMonth()->month)->count();  // Compte les rendez-vous du mois précédent
      

        // Système de palier pour l’évolution des revenus
        



 $filtre = $request->input('filtre', 'jour');

    // Dates centralisées
    $today = Carbon::today();
    $yesterday = Carbon::yesterday();
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();
    $startOfYear = Carbon::now()->startOfYear();
    $endOfYear = Carbon::now()->endOfYear();


    // Initialisation
    $rdvsParJours = collect();
    $total = 0;







    if ($filtre === 'jour') {
$phrase3='aujourd\'hui';
$phrase4='hier';

     $rdvsGeneraux = RendezVous::whereDate('date', '>=', Carbon::now()->subDays(6))
                ->get()
                ->groupBy(fn($rdv) => Carbon::parse($rdv->date)->format('Y-m-d'))
                ->map(fn($group, $date) => ['count' => $group->count(), 'date' => Carbon::parse($date)->format('d/m')]);




            $jours = collect();
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->format('Y-m-d');
                $jours->push([
                    'date' => Carbon::parse($date)->format('d/m'),
                    'count' => $rdvs->get($date)['count'] ?? 0
                ]);
            }
            $rdvs = $jours;


        $utilisateurs_hier = User::whereDate('created_at', $yesterday)->count();

           $jours = $request->input('jours', 1);

    $aujourdHui = Carbon::now();
    $dateDebut = Carbon::now()->subDays($jours);
    $periodePrecedenteDebut = Carbon::now()->subDays($jours * 2);
    $periodePrecedenteFin = Carbon::now()->subDays($jours);
    $nouveaux_utilisateurs = User::whereBetween('created_at', [$dateDebut, $aujourdHui])->count();

    $utilisateurs_periode_precedente = User::whereBetween('created_at', [$periodePrecedenteDebut, $periodePrecedenteFin])->count();

    $inactifs_utilisateurs = User::where(function ($query) use ($dateDebut) {
        $query->whereNull('last_seen')
              ->orWhere('last_seen', '<', $dateDebut);
    })->count();

    $evolution_utilisateurs = 0;
    if ($utilisateurs_periode_precedente > 0) {
        $evolution_utilisateurs = (($nouveaux_utilisateurs - $utilisateurs_periode_precedente) / $utilisateurs_periode_precedente) * 100;
    } elseif ($nouveaux_utilisateurs > 0) {
        $evolution_utilisateurs = 100;
    }


    $messagesDuJour = Message::whereDate('created_at', Carbon::today())->get();
$last1 = collect();
    $today = now();

    for ($i = 6; $i >= 0; $i--) {
        $date = $today->copy()->subDays($i)->format('Y-m-d');
        $count = Message::whereDate('created_at', $date)->count();

        $last1->push([
            'date' => \Carbon\Carbon::parse($date)->format('d/m'),
            'count' => $count,
            'height' => min(100, $count * 10), // Exemple d'échelle
            'color' => $count >= 5 ? 'bg-green-600' : ($count >= 2 ? 'bg-yellow-400' : 'bg-red-400')
        ]);
    }
    // Total
    $totalMessages = $messagesDuJour->count();

    // Lus et non lus
    $messagesLus = $messagesDuJour->where('is_read', true)->count();
    $messagesNonLus = $messagesDuJour->where('is_read', false)->count();

    // Pourcentages (éviter division par 0)
    $percentLus = $totalMessages > 0 ? round(($messagesLus / $totalMessages) * 100) : 0;
    $percentNonLus = $totalMessages > 0 ? round(($messagesNonLus / $totalMessages) * 100) : 0;

     



     $totalRdv = Rendezvous::count();

    $last = collect();
    $today = now();

    for ($i = 6; $i >= 0; $i--) {
        $date = $today->copy()->subDays($i)->format('Y-m-d');
        $count = Rendezvous::whereDate('date', $date)->count();

        $last->push([
            'date' => \Carbon\Carbon::parse($date)->format('d/m'),
            'count' => $count,
            'height' => min(100, $count * 10), // Exemple d'échelle
            'color' => $count >= 5 ? 'bg-green-600' : ($count >= 2 ? 'bg-yellow-400' : 'bg-red-400')
        ]);
    }

    // Pourcentage d'évolution entre aujourd’hui et la veille
    $todayCount = Rendezvous::whereDate('date', now())->count();
    $yesterdayCount = Rendezvous::whereDate('date', now()->subDay())->count();
    $evolution = $yesterdayCount == 0 ? ($todayCount > 0 ? 100 : 0) : round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100);




   $rdvToday = RendezVous::whereDate('date', today())->count();
$rdvYesterday = RendezVous::whereDate('date', today()->subDay())->count();
$rdvlast=$rdvYesterday;
$totalRDV=$rdvToday;
$totalEvolution = $rdvYesterday > 0
    ? round((($rdvToday - $rdvYesterday) / $rdvYesterday) * 100, 1)
    : 100;

$evolutionPrefix = $totalEvolution > 0 ? '+' : '';
$evolutionColor = $totalEvolution > 0 ? 'text-green-500' : 'text-red-500';
$progressColor = $totalEvolution > 0 ? 'from-green-400 to-green-600' : 'from-red-400 to-red-600';



// Rendez-vous du jour
$reussisToday = RendezVous::whereDate('date', today())->where('statut', 'confirme')->count();
$attenteToday = RendezVous::whereDate('date', today())->where('statut', 'attente')->count();
$annulesToday = RendezVous::whereDate('date', today())->where('statut', 'annule')->count();
$reussis = $reussisToday;
    $enAttente =$attenteToday;
    $annules = $annulesToday;
// Rendez-vous d’hier
$reussisYesterday = RendezVous::whereDate('date', today()->subDay())->where('statut', 'confirme')->count();
$attenteYesterday = RendezVous::whereDate('date', today()->subDay())->where('statut', 'attente')->count();
$annulesYesterday = RendezVous::whereDate('date', today()->subDay())->where('statut', 'annule')->count();

// Pourcentage d'évolution
function getEvolution($today, $yesterday) {
    if ($yesterday === 0) return $today > 0 ? 100 : 0;
    return round((($today - $yesterday) / $yesterday) * 100, 1);
}

$pctReussis = getEvolution($reussisToday, $reussisYesterday);
$pctAttente = getEvolution($attenteToday, $attenteYesterday);
$pctAnnules = getEvolution($annulesToday, $annulesYesterday);



        $phrase= 'par rapport aux jours derniers';
        $phrase1= 'jour dernier';








   $abonneToday = Paiement::whereDate('created_at', today())->where('status', 'reussi')->count();
    $abonne_total=$abonneToday;
       


    $abonne_hier = Paiement::whereDate('created_at', Carbon::yesterday())->where('status', 'reussi')->count();

   

  if ( $abonne_hier  > 0) {
    $evolution_paiments = round((($abonne_total - $abonne_hier ) /  $abonne_hier ) * 100);
    // Plafonner à 100%
    $evolution_paiments = min($evolution_paiments, 100);
    // Pas de négatif
    if ($evolution_paiments < 0) {
        $evolution_paiments = 0;
    }
} else {
    $evolution_paiments = $abonne_total > 0 ? 100 : 0;
}

    // Revenus aujourd'hui
   $today = Carbon::today();
    $revenus_total = Paiement::whereDate('created_at', $today)
        ->where('status', 'reussi')
        ->sum('amount');

    // Hier
    $yesterday = Carbon::yesterday();
    $revenus_hier = Paiement::whereDate('created_at', $yesterday)
        ->where('status', 'reussi')
        ->sum('amount');

    // Calcul de l'évolution en %
   




    if ($revenus_hier > 0) {
    $evolution_revenus = (($revenus_total - $revenus_hier) / $revenus_hier) * 100;
    // Limiter à 100%
    $evolution_revenus = min($evolution_revenus, 100);
    // Pas de négatif
    if ($evolution_revenus < 0) {
        $evolution_revenus = 0;
    }
} elseif ($revenus_total > 0) {
    $evolution_revenus = 100;
} else {
    $evolution_revenus = 0;
}

$evolution_revenus = round($evolution_revenus, 2);

// app/Http/Controllers/PaiementController.php

 $startDate = Carbon::now()->subDays(6)->startOfDay(); // 7 jours inclu aujourd'hui

    // Revenus journaliers
    $revenusParJour = DB::table('paiements')
        ->select(
            DB::raw('DATE(created_at) as jour'),
            DB::raw('SUM(amount) as total_revenus'),
            DB::raw('COUNT(DISTINCT user_id) as total_abonnes')
        )
        ->where('created_at', '>=', $startDate)
         ->where('status', 'reussi')  
        ->groupBy('jour')
        ->orderBy('jour')
        ->get();

    // Pour s'assurer d'avoir une entrée par jour même sans données, on complète le tableau
    $jours = [];
    for ($i = 0; $i < 7; $i++) {
        $date = $startDate->copy()->addDays($i)->format('Y-m-d');
        $jours[$date] = ['total_revenus' => 0, 'total_abonnes' => 0];
    }

    foreach ($revenusParJour as $data) {
        $jours[$data->jour] = [
            'total_revenus' => $data->total_revenus,
            'total_abonnes' => $data->total_abonnes,
        ];
    }

    // Préparer les données pour la vue
    $dates = array_keys($jours);
    $revenus = array_column($jours, 'total_revenus');
    $abonnes = array_column($jours, 'total_abonnes');

    }





    


    

    if ($filtre === 'semaine') {
        $phrase4='dernier semaine ';
        $phrase3='cette semaine';
        $rdvs = RendezVous::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
         $rdvsGeneraux = RendezVous::whereDate('date', '>=', Carbon::now()->subWeeks(3))
                ->get()
                ->groupBy(fn($rdv) => Carbon::parse($rdv->created_at)->startOfWeek()->format('Y-m-d'))
                ->map(fn($group, $date) => [
                    'count' => $group->count(),
                    'date' => 'Semaine du ' . Carbon::parse($date)->format('d/m')
                ])->values();

                 $phrase= 'par rapport aux semaines derniers';
                 $phrase1= 'semaine dernier';





                  $nouveaux_utilisateurs = User::whereDate('created_at', $startOfWeek)->count();
        $utilisateurs_hier = User::whereDate('created_at', $endOfWeek)->count();

           $week = $request->input('week', 3); // Par défaut, les 30 derniers jours

    $aujourdHui = Carbon::now();
    $dateDebut = Carbon::now()->subWeek($week);
    $periodePrecedenteDebut = Carbon::now()->subWeek($week * 2);
    $periodePrecedenteFin = Carbon::now()->subWeek($week);



    // Nouveaux utilisateurs sur les $jours derniers jours
    $nouveaux_utilisateurs = User::whereBetween('created_at', [$dateDebut, $aujourdHui])->count();

    // Nouveaux utilisateurs durant la période précédente
    $utilisateurs_periode_precedente = User::whereBetween('created_at', [$periodePrecedenteDebut, $periodePrecedenteFin])->count();

    // Utilisateurs inactifs (pas vus depuis plus de $jours)
    $inactifs_utilisateurs = User::where(function ($query) use ($dateDebut) {
        $query->whereNull('last_seen')
              ->orWhere('last_seen', '<', $dateDebut);
    })->count();

    // Calcul de l’évolution
    $evolution_utilisateurs = 0;
    if ($utilisateurs_periode_precedente > 0) {
        $evolution_utilisateurs = (($nouveaux_utilisateurs - $utilisateurs_periode_precedente) / $utilisateurs_periode_precedente) * 100;
    } elseif ($nouveaux_utilisateurs > 0) {
        $evolution_utilisateurs = 100;
    }
    
  
   $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();
  $semaineActuel = Carbon::now();
     $debutSemaineActuel = $semaineActuel->copy()->startOfWeek();
 $messagesSemaine = Message::whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->get();
    $totalMessages = $messagesSemaine->count();
    $messagesLus = $messagesSemaine->where('is_read', true)->count();
    $messagesNonLus = $messagesSemaine->where('is_read', false)->count();

    $percentLus = $totalMessages > 0 ? round(($messagesLus / $totalMessages) * 100) : 0;
    $percentNonLus = $totalMessages > 0 ? round(($messagesNonLus / $totalMessages) * 100) : 0;
    // Total
      $last1 = collect();
    for ($i = 3; $i >= 0; $i--) {
        $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
         $date = $debutSemaineActuel->copy()->subWeek($i);
        $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

        $count = Message::whereBetween('date', [$startOfWeek, $endOfWeek])->count();
        $label = 'Semaine ' . $startOfWeek->format('W'); // Numéro de semaine

        $last1->push([
            'date' => $date->format('d/m'),
            'week' => $label,
            'count' => $count,
            'height' => min(100, $count * 5), // bar height proportional (adjust as needed)
            'color' => $count >= 15 ? 'bg-green-600' : ($count >= 5 ? 'bg-yellow-400' : 'bg-red-400'),
        ]);
    }
 $totalRdv = Rendezvous::count();


   
    $finSemaineActuel = $semaineActuel->copy()->endOfWeek();

    $SemainePrecedent = $semaineActuel->copy()->subWeek();
    $debutSemainePrecedent = $SemainePrecedent->copy()->startOfWeek();
    $finSemainePrecedent = $SemainePrecedent->copy()->endOfWeek();

    // RDV par semaine (4 dernières semaines)
    $last = collect();
    for ($i = 3; $i >= 0; $i--) {
        $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
         $date = $debutSemaineActuel->copy()->subWeek($i);
        $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

        $count = Rendezvous::whereBetween('date', [$startOfWeek, $endOfWeek])->count();
        $label = 'Semaine ' . $startOfWeek->format('W'); // Numéro de semaine

        $last->push([
            'date' => $date->format('d/m'),
            'week' => $label,
            'count' => $count,
            'height' => min(100, $count * 5), // bar height proportional (adjust as needed)
            'color' => $count >= 15 ? 'bg-green-600' : ($count >= 5 ? 'bg-yellow-400' : 'bg-red-400'),
        ]);
    }


    // Évolution entre la semaine actuelle et la semaine précédente
    $thisWeek = Rendezvous::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count();
    $lastWeek = Rendezvous::whereBetween('date', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();

    $evolution = $lastWeek == 0 ? ($thisWeek > 0 ? 100 : 0) : round((($thisWeek - $lastWeek) / $lastWeek) * 100);






$rdvThisWeek = RendezVous::whereBetween('date', [
    Carbon::now()->startOfWeek(),
    Carbon::now()->endOfWeek(),
])->count();

$rdvlastweek = RendezVous::whereBetween('date', [
    Carbon::now()->subWeek()->startOfWeek(),
    Carbon::now()->subWeek()->endOfWeek(),
])->count();

$totalRDV=$rdvThisWeek;
$rdvlast=$rdvlastweek;
$totalEvolution = $rdvlastweek > 0
    ? round((($rdvThisWeek - $rdvlastweek) / $rdvlastweek) * 100, 1)
    : 100;

$evolutionPrefix = $totalEvolution > 0 ? '+' : '';
$evolutionColor = $totalEvolution > 0 ? 'text-green-500' : 'text-red-500';
$progressColor = $totalEvolution > 0 ? 'from-green-400 to-green-600' : 'from-red-400 to-red-600';



// Rendez-vous du jour
$reussisThisWeek = RendezVous::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()])->where('statut', 'confirme')->count();
$attenteThisWeek = RendezVous::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()])->where('statut', 'attente')->count();
$annulesThisWeek = RendezVous::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()])->where('statut', 'annule')->count();
$reussis = $reussisThisWeek;
    $enAttente =$attenteThisWeek;
    $annules = $annulesThisWeek;
// Rendez-vous d’hier
$reussisLastWeek = RendezVous::whereDate('date', today()->subWeek())->where('statut', 'confirme')->count();
$attenteLastWeek = RendezVous::whereDate('date', today()->subWeek())->where('statut', 'attente')->count();
$annulesLastWeek = RendezVous::whereDate('date', today()->subWeek())->where('statut', 'annule')->count();

// Pourcentage d'évolution
function getEvolution($thisWeek,$lastWeek) {
    if ($lastWeek === 0) return $thisWeek > 0 ? 100 : 0;
    return round((($thisWeek - $lastWeek) / $lastWeek) * 100, 1);
}

$pctReussis = getEvolution($reussisThisWeek, $reussisLastWeek);
$pctAttente = getEvolution($attenteThisWeek, $attenteLastWeek);
$pctAnnules = getEvolution($annulesThisWeek, $annulesLastWeek);
$debut_semaine = Carbon::now()->startOfWeek(); // Lundi
    $fin_semaine = Carbon::now(); // Maintenant

    // Semaine dernière (lundi -> dimanche)
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    // Début et fin de la semaine précédente
    $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
    $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

    // Revenus cette semaine
    $revenus_total = Paiement::whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->where('status', 'reussi')
        ->sum('amount');

    // Revenus la semaine dernière
    $revenus_last_week = Paiement::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
        ->where('status', 'reussi')
        ->sum('amount');

    // Calcul de l'évolution


    if ($revenus_last_week > 0) {
    $evolution_revenus = (($revenus_total - $revenus_last_week) / $revenus_last_week) * 100;
    // Limiter à 100%
    $evolution_revenus = min($evolution_revenus, 100);
    // Pas de négatif
    if ($evolution_revenus < 0) {
        $evolution_revenus = 0;
    }
} elseif ($revenus_total > 0) {
    $evolution_revenus = 100;
} else {
    $evolution_revenus = 0;
}

$evolution_revenus = round($evolution_revenus, 2);



        $debut_semaine = Carbon::now()->startOfWeek();
    $fin_semaine = Carbon::now()->endOfWeek();
 
    // Paiements de cette semaine
    $abonne_total = Paiement::whereBetween('created_at', [$debut_semaine, $fin_semaine])->where('status', 'reussi')->count();

    // Début / Fin de la semaine précédente
    $debut_semaine_prec = Carbon::now()->subWeek()->startOfWeek();
    $fin_semaine_prec = Carbon::now()->subWeek()->endOfWeek();

    // Paiements de la semaine précédente
    $total_semaine_prec = Paiement::whereBetween('created_at', [$debut_semaine_prec, $fin_semaine_prec])->where('status', 'reussi')->count();

    // Calcul de l’évolution
  if ($total_semaine_prec > 0) {
    $evolution_paiments = round((($abonne_total - $total_semaine_prec) / $total_semaine_prec) * 100);
    // Plafonner à 100%
    $evolution_paiments = min($evolution_paiments, 100);
    // Pas de négatif
    if ($evolution_paiments < 0) {
        $evolution_paiments = 0;
    }
} else {
    $evolution_paiments = $abonne_total > 0 ? 100 : 0;
}


$startDate = Carbon::now()->subWeeks(6)->startOfWeek(); // début de la semaine il y a 6 semaines

// Revenus hebdomadaires
$revenusParSemaine = DB::table('paiements')
    ->select(
        DB::raw('YEARWEEK(created_at, 1) as semaine'), // 1 = semaine commence le lundi
        DB::raw('MIN(DATE(created_at)) as debut_semaine'),
        DB::raw('SUM(amount) as total_revenus'),
        DB::raw('COUNT(DISTINCT user_id) as total_abonnes')
    )
    ->where('created_at', '>=', $startDate)
     ->where('status', 'reussi')  
    ->groupBy('semaine')
    ->orderBy('semaine')
    ->get();

// Compléter les 7 semaines même sans données
$semaines = [];
for ($i = 0; $i < 7; $i++) {
    $debutSemaine = $startDate->copy()->addWeeks($i)->startOfWeek();
    $label = $debutSemaine->format('Y-m-d');
    $cle = $debutSemaine->format('oW'); // o = année ISO, W = semaine ISO
    $semaines[$cle] = [
        'label' => $label,
        'total_revenus' => 0,
        'total_abonnes' => 0,
    ];
}

// Remplir les semaines avec les vraies données
foreach ($revenusParSemaine as $data) {
    $cle = $data->semaine;
    if (isset($semaines[$cle])) {
        $semaines[$cle]['total_revenus'] = $data->total_revenus;
        $semaines[$cle]['total_abonnes'] = $data->total_abonnes;
    }
}

// Préparer pour la vue
$dates = array_column($semaines, 'label'); // Date de début de semaine
$revenus = array_column($semaines, 'total_revenus');
$abonnes = array_column($semaines, 'total_abonnes');

    }
  elseif ($filtre === 'mois') {
    $phrase4='derniers mois';
$phrase3='ce mois ';
 $phrase= 'par rapport aux mois derniers';
$phrase1= 'mois dernier';
     $rdvsGeneraux = RendezVous::whereDate('created_at', '>=', Carbon::now()->subMonths(11))
                ->get()
                ->groupBy(fn($rdv) => Carbon::parse($rdv->created_at)->format('Y-m'))
                ->map(fn($group, $date) => [
                    'count' => $group->count(),
                    'date' => Carbon::parse($date . '-01')->translatedFormat('F Y')
                ])->values();

$month = $request->input('month', 1);

    $debutMois = Carbon::now()->startOfMonth();
    $finMois = Carbon::now()->endOfMonth();

    $debutMoisDernier = Carbon::now()->subMonth()->startOfMonth();
    $finMoisDernier = Carbon::now()->subMonth()->endOfMonth();

        $utilisateurs_hier = User::whereDate('created_at', $endOfMonth)->count();



     $debutMois = Carbon::now()->startOfMonth();
    $finMois = Carbon::now()->endOfMonth();


    $debutMoisPrecedent = Carbon::now()->subMonth()->startOfMonth();
    $finMoisPrecedent = Carbon::now()->subMonth()->endOfMonth();


    $nouveaux_utilisateurs = User::whereBetween('created_at', [$debutMois, $finMois])->count();

    $utilisateurs_mois_precedent = User::whereBetween('created_at', [$debutMoisPrecedent, $finMoisPrecedent])->count();

    $inactifs_utilisateurs = User::where(function ($query) use ($debutMoisPrecedent) {
        $query->whereNull('last_seen')
              ->orWhere('last_seen', '<', $debutMoisPrecedent);
    })->count();

    $evolution_utilisateurs = 0;
    if ($utilisateurs_mois_precedent > 0) {
        $evolution_utilisateurs = (($nouveaux_utilisateurs - $utilisateurs_mois_precedent) / $utilisateurs_mois_precedent) * 100;
    } elseif ($nouveaux_utilisateurs > 0) {
        $evolution_utilisateurs = 100;
    }


    

    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $messagesMonth = Message::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->get();

    $totalMessages = $messagesMonth->count();
    
    $messagesLus = $messagesMonth->where('is_read', true)->count();
    $messagesNonLus = $messagesMonth->where('is_read', false)->count();

    $percentLus = $totalMessages > 0 ? round(($messagesLus / $totalMessages) * 100) : 0;
    $percentNonLus = $totalMessages > 0 ? round(($messagesNonLus / $totalMessages) * 100) : 0;


$last1 = collect();
  
for ($i = 4; $i >= 0; $i--) {
    $startOfMonth = Carbon::now()->subMonths($i)->startOfMonth();
    $endOfMonth = Carbon::now()->subMonths($i)->endOfMonth();

    $count = Message::whereBetween('date', [$startOfMonth, $endOfMonth])->count();

    $last1->push([
        'month' => $startOfMonth->format('M Y'),   // Exemple : "Jan 2025"
        'count' => $count,
        'date' => $startOfMonth->format('d/m'),    // Exemple : "01/01"
        'height' => min(100, $count * 5),          // Limite la hauteur max à 100
        'color' => $count >= 15 ? 'bg-green-600' :
                  ($count >= 5 ? 'bg-yellow-400' : 'bg-red-400'),
    ]);
}




    // Rendez-vous
    $moisActuel = Carbon::now();
    $debutMoisActuel = $moisActuel->copy()->startOfMonth();
    $finMoisActuel = $moisActuel->copy()->endOfMonth();

    $moisPrecedent = $moisActuel->copy()->subMonth();
    $debutMoisPrecedent = $moisPrecedent->copy()->startOfMonth();
    $finMoisPrecedent = $moisPrecedent->copy()->endOfMonth();






$totalRdv = Rendezvous::count();

    // RDV par semaine (4 dernières semaines)
    $last = collect();
    for ($i = 11; $i >= 0; $i--) {
        $startOfMonth = Carbon::now()->subMonth($i)->startOfMonth();
        $endOfMonth = Carbon::now()->subMonth($i)->endOfMonth();
         $date = $debutMoisActuel->copy()->subMonth($i);
        $count = Rendezvous::whereBetween('date', [$startOfMonth, $endOfMonth])->count();
        $label = 'Mois' . $startOfMonth->format('M'); // Numéro de semaine

        $last->push([
            'Month' => $label,
            'count' => $count,
            'date' => $date->format('d/m'),
            'height' => min(100, $count * 5), // bar height proportional (adjust as needed)
            'color' => $count >= 15 ? 'bg-green-600' : ($count >= 5 ? 'bg-yellow-400' : 'bg-red-400'),
        ]);
    }

    // Évolution entre la semaine actuelle et la semaine précédente
    $thisMonth    = Rendezvous::whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])->count();
    $lastMonth = Rendezvous::whereBetween('date', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->count();

    $evolution = $lastMonth == 0 ? ($thisMonth > 0 ? 100 : 0) : round((($thisMonth - $lastMonth) / $lastMonth) * 100);




$rdvThisMonth = RendezVous::whereBetween('date', [
    Carbon::now()->startOfMonth(),
    Carbon::now()->endOfMonth(),
])->count();

$rdvlastMonth = RendezVous::whereBetween('date', [
    Carbon::now()->subMonth()->startOfMonth(),
    Carbon::now()->subMonth()->endOfMonth(),
])->count();

$totalRDV=$rdvThisMonth;
$rdvlast=$rdvlastMonth;
$totalEvolution = $rdvlastMonth > 0
    ? round((($rdvThisMonth- $rdvlastMonth) / $rdvlastMonth) * 100, 1)
    : 100;

$evolutionPrefix = $totalEvolution > 0 ? '+' : '';
$evolutionColor = $totalEvolution > 0 ? 'text-green-500' : 'text-red-500';
$progressColor = $totalEvolution > 0 ? 'from-green-400 to-green-600' : 'from-red-400 to-red-600';



// Rendez-vous du jour
$reussisThisMonth = RendezVous::whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()])->where('statut', 'confirme')->count();
$attenteThisMonth = RendezVous::whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()])->where('statut', 'attente')->count();
$annulesThisMonth = RendezVous::whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()])->where('statut', 'annule')->count();
$reussis = $reussisThisMonth;
    $enAttente =$attenteThisMonth;
    $annules = $annulesThisMonth;
// Rendez-vous d’hier
$reussisLastMonth = RendezVous::whereDate('date', today()->subMonth())->where('statut', 'confirme')->count();
$attenteLastMonth = RendezVous::whereDate('date', today()->subMonth())->where('statut', 'attente')->count();
$annulesLastMonth = RendezVous::whereDate('date', today()->subMonth())->where('statut', 'annule')->count();

// Pourcentage d'évolution
function getEvolution($thisMonth,$lastMonth) {
    if ($lastMonth === 0) return $thisMonth > 0 ? 100 : 0;
    return round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1);
}

$pctReussis = getEvolution($reussisThisMonth, $reussisLastMonth);
$pctAttente = getEvolution($attenteThisMonth, $attenteLastMonth);
$pctAnnules = getEvolution($annulesThisMonth, $annulesLastMonth);


 $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    // Début et fin de la semaine précédente
    $startOfLastMonth = Carbon::now()->subWeek()->startOfWeek();
    $endOfLastMonth = Carbon::now()->subWeek()->endOfWeek();

    // Revenus cette semaine
    $revenus_total = Paiement::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->where('status', 'reussi')
        ->sum('amount');

    // Revenus la semaine dernière
    $revenus_last_Month = Paiement::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
        ->where('status', 'reussi')
        ->sum('amount');

    

    if ($revenus_last_Month > 0) {
    $evolution_revenus = (($revenus_total - $revenus_last_Month) / $revenus_last_Month) * 100;
    // Limiter à 100%
    $evolution_revenus = min($evolution_revenus, 100);
    // Pas de négatif
    if ($evolution_revenus < 0) {
        $evolution_revenus = 0;
    }
} elseif ($revenus_total > 0) {
    $evolution_revenus = 100;
} else {
    $evolution_revenus = 0;
}

$evolution_revenus = round($evolution_revenus, 2);


        
        $debut_mois = Carbon::now()->startOfMonth();
    $fin_mois = Carbon::now()->endOfMonth();
 
    // Paiements de cette semaine
    $abonne_total = Paiement::whereBetween('created_at', [$debut_mois, $fin_mois]) ->where('status', 'reussi')->count();

    // Début / Fin de la semaine précédente
    $debut_mois_prec = Carbon::now()->subMonth()->startOfMonth();
    $fin_mois_prec = Carbon::now()->subMonth()->endOfMonth();

    // Paiements de la semaine précédente
    $total_mois_prec = Paiement::whereBetween('created_at', [$debut_mois_prec, $fin_mois_prec]) ->where('status', 'reussi')->count();

    // Calcul de l’évolution
   

if ($total_mois_prec > 0) {
    $evolution_paiments = round((($abonne_total - $total_mois_prec) / $total_mois_prec) * 100);
    // Plafonner à 100%
    $evolution_paiments = min($evolution_paiments, 100);
    // Pas de négatif
    if ($evolution_paiments < 0) {
        $evolution_paiments = 0;
    }
} else {
    $evolution_paiments = $abonne_total > 0 ? 100 : 0;
}

$startDate = Carbon::now()->subMonths(5)->startOfMonth(); // début du mois il y a 5 mois

// Revenus par mois
$revenusParMois = DB::table('paiements')
    ->select(
        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mois'),
        DB::raw('SUM(amount) as total_revenus'),
        DB::raw('COUNT(DISTINCT user_id) as total_abonnes')
    )
    ->where('created_at', '>=', $startDate)
     ->where('status', 'reussi')  
    ->groupBy('mois')
    ->orderBy('mois')
    ->get();

// Compléter les 6 mois même sans données
$moisData = [];
for ($i = 0; $i < 6; $i++) {
    $mois = $startDate->copy()->addMonths($i)->format('Y-m');
    $moisData[$mois] = [
        'total_revenus' => 0,
        'total_abonnes' => 0,
    ];
}

// Remplir les mois avec les données réelles
foreach ($revenusParMois as $data) {
    if (isset($moisData[$data->mois])) {
        $moisData[$data->mois] = [
            'total_revenus' => $data->total_revenus,
            'total_abonnes' => $data->total_abonnes,
        ];
    }
}

// Préparer les données pour la vue
$dates = array_keys($moisData); // exemple : ['2025-01', '2025-02', ..., '2025-06']
$revenus = array_column($moisData, 'total_revenus');
$abonnes = array_column($moisData, 'total_abonnes');

} elseif ($filtre === 'annee') {
    $phrase4='dernier annee';
    $phrase3='cette annee';
 $phrase= 'par rapport aux annees derniers';
 $phrase1= 'annee dernier';
    // --- Rendez-vous par année (4 dernières années) ---
    $rdvsGeneraux = RendezVous::whereDate('date', '>=', Carbon::now()->subYears(4))
        ->get()
        ->groupBy(fn($rdv) => Carbon::parse($rdv->created_at)->format('Y'))
        ->map(fn($group, $year) => [
            'count' => $group->count(),
            'date' => $year
        ])
        ->values();

$year = $request->input('years', 2);
       $nouveaux_utilisateurs = User::whereDate('created_at', $startOfYear)->count();
        $utilisateurs_hier = User::whereDate('created_at', $endOfYear)->count();


    $aujourdHui = Carbon::now();
    $dateDebut = Carbon::now()->subYear($year);
    $periodePrecedenteDebut = Carbon::now()->subYear($year * 2);
    $periodePrecedenteFin = Carbon::now()->subYear($year);
    $nouveaux_utilisateurs = User::whereBetween('created_at', [$dateDebut, $aujourdHui])->count();
    $utilisateurs_periode_precedente = User::whereBetween('created_at', [$periodePrecedenteDebut, $periodePrecedenteFin])->count();
    $inactifs_utilisateurs = User::where(function ($query) use ($dateDebut) {
        $query->whereNull('last_seen')
              ->orWhere('last_seen', '<', $dateDebut);
    })->count();

    $evolution_utilisateurs = 0;
    if ($utilisateurs_periode_precedente > 0) {
        $evolution_utilisateurs = (($nouveaux_utilisateurs - $utilisateurs_periode_precedente) / $utilisateurs_periode_precedente) * 100;
    } elseif ($nouveaux_utilisateurs > 0) {
        $evolution_utilisateurs = 100;
    }





    // --- Dates pour cette année et l’année dernière ---
    $debutAnnee = Carbon::now()->startOfYear();
    $finAnnee = Carbon::now()->endOfYear();

    $debutAnneeDerniere = Carbon::now()->subYear()->startOfYear();
    $finAnneeDerniere = Carbon::now()->subYear()->endOfYear();



     
    $startOfYear = Carbon::now()->startOfYear();
    $endOfYear = Carbon::now()->endOfYear();

    $messagesYear = DB::table('messages')
        ->whereBetween('created_at', [$startOfYear, $endOfYear])
        ->get();

    $totalMessages = $messagesYear->count();
    $messagesLus = $messagesYear->where('is_read', true)->count();
    $messagesNonLus = $messagesYear->where('is_read', false)->count();

    $percentLus = $totalMessages > 0 ? round(($messagesLus / $totalMessages) * 100) : 0;
    $percentNonLus = $totalMessages > 0 ? round(($messagesNonLus / $totalMessages) * 100) : 0;






     $anneeActuel = Carbon::now();
    $debutAnneeActuel = $anneeActuel->copy()->startOfYear();


    // RDV par semaine (4 dernières semaines)
    $last1 = collect();
    for ($i = 4; $i >= 0; $i--) {
        $startOfYear = Carbon::now()->subYear($i)->startOfYear();
        $endOfYear = Carbon::now()->subYear($i)->endOfYear();
         $date = $debutAnneeActuel->copy()->subYear($i);
        $count = Message::whereBetween('date', [$startOfYear, $endOfYear])->count();
        $label = 'Annee' . $startOfYear->format('Y'); // Numéro de semaine
        $last1->push([
            'Year' => $label,
            'count' => $count,
            'date' => $date->format('m/y'),
            'height' => min(100, $count * 5), // bar height proportional (adjust as needed)
            'color' => $count >= 15 ? 'bg-green-600' : ($count >= 5 ? 'bg-yellow-400' : 'bg-red-400'),
        ]);
    }



    // --- Statistiques RDV actuels et précédents ---
    $anneeActuel = Carbon::now();
    $debutAnneeActuel = $anneeActuel->copy()->startOfYear();
    $finAnneeActuel = $anneeActuel->copy()->endOfYear();

    $anneePrecedente = $anneeActuel->copy()->subYear();
    $debutAnneePrecedente = $anneePrecedente->copy()->startOfYear();
    $finAnneePrecedente = $anneePrecedente->copy()->endOfYear();

$totalRdv = Rendezvous::count();

    // RDV par semaine (4 dernières semaines)
    $last = collect();
    for ($i = 4; $i >= 0; $i--) {
        $startOfYear = Carbon::now()->subYear($i)->startOfYear();
        $endOfYear = Carbon::now()->subYear($i)->endOfYear();
         $date = $debutAnneeActuel->copy()->subYear($i);
        $count = Rendezvous::whereBetween('date', [$startOfYear, $endOfYear])->count();
        $label = 'Annee' . $startOfYear->format('Y'); // Numéro de semaine

        $last->push([
            'Year' => $label,
            'count' => $count,
            'date' => $date->format('m/y'),
            'height' => min(100, $count * 5), // bar height proportional (adjust as needed)
            'color' => $count >= 15 ? 'bg-green-600' : ($count >= 5 ? 'bg-yellow-400' : 'bg-red-400'),
        ]);
    }

    // Évolution entre la semaine actuelle et la semaine précédente
    $thisYear    = Rendezvous::whereBetween('date', [now()->startOfYear(), now()->endOfYear()])->count();
    $lastYear = Rendezvous::whereBetween('date', [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()])->count();

    $evolution = $lastYear == 0 ? ($thisYear > 0 ? 100 : 0) : round((($thisYear - $lastYear) / $lastYear) * 100);




$totalRDV=$thisYear;
$rdvlast=$lastYear;
$totalEvolution = $rdvlast > 0
    ? round((($totalRDV- $rdvlast) / $rdvlast) * 100, 1)
    : 100;

$evolutionPrefix = $totalEvolution > 0 ? '+' : '';
$evolutionColor = $totalEvolution > 0 ? 'text-green-500' : 'text-red-500';
$progressColor = $totalEvolution > 0 ? 'from-green-400 to-green-600' : 'from-red-400 to-red-600';



// Rendez-vous du jour
$reussisThisYear = RendezVous::whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()])->where('statut', 'confirme')->count();
$attenteThisYear = RendezVous::whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()])->where('statut', 'attente')->count();
$annulesThisYear = RendezVous::whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()])->where('statut', 'annule')->count();
$reussis = $reussisThisYear;
    $enAttente =$attenteThisYear;
    $annules = $annulesThisYear;
// Rendez-vous d’hier
$reussisLastYear = RendezVous::whereDate('date', today()->subYear())->where('statut', 'confirme')->count();
$attenteLastYear = RendezVous::whereDate('date', today()->subYear())->where('statut', 'attente')->count();
$annulesLastYear = RendezVous::whereDate('date', today()->subYear())->where('statut', 'annule')->count();

// Pourcentage d'évolution
function getEvolution($thisYear,$lastYear) {
    if ($lastYear === 0) return $thisYear > 0 ? 100 : 0;
    return round((($thisYear - $lastYear) / $lastYear) * 100, 1);
}

$pctReussis = getEvolution($reussisThisYear, $reussisLastYear);
$pctAttente = getEvolution($attenteThisYear, $attenteLastYear);
$pctAnnules = getEvolution($annulesThisYear, $annulesLastYear);



    $reussis = RendezVous::where('statut', 'confirme')->count();
    $enAttente = RendezVous::where('statut', 'attente')->count();
    $annules = RendezVous::where('statut', 'annule')->count();

    $totalRDV = $reussis + $enAttente + $annules;

    $pctReussis = $totalRDV > 0 ? round(($reussis / $totalRDV) * 100) : 0;
    $pctAttente = $totalRDV > 0 ? round(($enAttente / $totalRDV) * 100) : 0;
    $pctAnnules = $totalRDV > 0 ? round(($annules / $totalRDV) * 100) : 0;


    $startOfYear = Carbon::now()->startOfYear();
    $endOfYear = Carbon::now()->endOfYear();

    // Début et fin de la semaine précédente
    $startOfLastYear = Carbon::now()->subYear()->startOfYear();
    $endOfLastYear = Carbon::now()->subYear()->endOfYear();

    // Revenus cette semaine
    $revenus_total = Paiement::whereBetween('created_at', [$startOfYear, $endOfYear])
        ->where('status', 'reussi')
        ->sum('amount');

    // Revenus la semaine dernière
    $revenus_last_Year = Paiement::whereBetween('created_at', [$startOfLastYear, $endOfLastYear])
        ->where('status', 'reussi')
        ->sum('amount');

    // Calcul de l'évolution
    


    if ($revenus_last_Year > 0) {
    $evolution_revenus = (($revenus_total - $revenus_last_Year) /$revenus_last_Year) * 100;
    // Limiter à 100%
    $evolution_revenus = min($evolution_revenus, 100);
    // Pas de négatif
    if ($evolution_revenus < 0) {
        $evolution_revenus = 0;
    }
} elseif ($revenus_total > 0) {
    $evolution_revenus = 100;
} else {
    $evolution_revenus = 0;
}

$evolution_revenus = round($evolution_revenus, 2);


        
        $debut_annee = Carbon::now()->startOfYear();
    $fin_annee = Carbon::now()->endOfYear();
 
    // Paiements de cette semaine
    $abonne_total = Paiement::whereBetween('created_at', [$debut_annee, $fin_annee]) ->where('status', 'reussi')->count();

    // Début / Fin de la semaine précédente
    $debut_annee_prec = Carbon::now()->subYear()->startOfYear();
    $fin_annee_prec = Carbon::now()->subYear()->endOfYear();

    // Paiements de la semaine précédente
    $total_annee_prec = Paiement::whereBetween('created_at', [$debut_annee_prec, $fin_annee_prec])->where('status', 'reussi')->count();

    // Calcul de l’évolution
    

if ($total_annee_prec > 0) {
    $evolution_paiments = round((($abonne_total - $total_annee_prec) / $total_annee_prec) * 100);
    // Plafonner à 100%
    $evolution_paiments = min($evolution_paiments, 100);
    // Pas de négatif
    if ($evolution_paiments < 0) {
        $evolution_paiments = 0;
    }
} else {
    $evolution_paiments = $abonne_total > 0 ? 100 : 0;
}


$startDate = Carbon::now()->subYears(4)->startOfYear();

// Revenus par année
$revenusParAnnee = DB::table('paiements')
    ->select(
        DB::raw('YEAR(created_at) as annee'),
        DB::raw('SUM(amount) as total_revenus'),
        DB::raw('COUNT(DISTINCT user_id) as total_abonnes')
    )
    ->where('created_at', '>=', $startDate)
     ->where('status', 'reussi')  
    ->groupBy('annee')
    ->orderBy('annee')
    ->get();

// Préparer les 5 années même sans données
$anneesData = [];
$currentYear = Carbon::now()->year;

for ($i = 0; $i < 5; $i++) {
    $annee = $startDate->copy()->addYears($i)->year;
    $anneesData[$annee] = [
        'total_revenus' => 0,
        'total_abonnes' => 0,
    ];
}

// Remplir les années avec les données réelles
foreach ($revenusParAnnee as $data) {
    if (isset($anneesData[$data->annee])) {
        $anneesData[$data->annee] = [
            'total_revenus' => $data->total_revenus,
            'total_abonnes' => $data->total_abonnes,
        ];
    }
}

// Préparer les données pour la vue
$dates = array_keys($anneesData); // exemple : [2021, 2022, 2023, 2024, 2025]
$revenus = array_column($anneesData, 'total_revenus');
$abonnes = array_column($anneesData, 'total_abonnes');



}

 else {
        $rdvs = RendezVous::all();
    }













    $recentRdv = Rendezvous::latest()->first();
    $recentMessage = Message::latest()->first();
    $recentPaiement = Paiement::latest()->first();
    $recentUser = User::latest()->first();
    $recentRessource = Ressource::latest()->first();
        return view('admin.dashboard', [
            'phrase' => $phrase,
            'phrase1' => $phrase1,
            'nombre_utilisateurs' => $nombre_utilisateurs,
            'nombre_parents' => $nombre_parents,
             'nouveaux_utilisateurs' => $nouveaux_utilisateurs,


            'inactifs_utilisateurs'=>$inactifs_utilisateurs,
           'evolution_utilisateurs' =>$evolution_utilisateurs,


           'totalRdv'=>$totalRdv,

          'last'=>$last,
          'last1'=>$last1,

           'evolution'=>$evolution,

           'rdvMoisActuel'=>$rdvMoisActuel,
           'rdvMoisPrecedent'=>$rdvMoisPrecedent,
           'rdvsParJours'=>$rdvsParJours,

           'totalRDV'=>$totalRDV,
           'reussis'=>$reussis,
           'enAttente'=>$enAttente,
           'annules'=>$annules,
           'pctReussis'=>$pctReussis,
           'pctAttente'=> $pctAttente,
           'pctAnnules'=>$pctAnnules,

            'rendezvous_auj' => RendezVous::whereDate('date', today())->count(),
            'revenus_mois' => Paiement::whereMonth('created_at', now()->month)->where('status', 'reussi')->sum('montant'),

            'prochains_rdv' => RendezVous::with('user')
                ->where('date', '>=', Carbon::now())
                ->orderBy('date', 'asc')
                ->limit(5)
                ->get(),
                'messagesNonLus' => $messagesNonLus,
                'messagesLus' => $messagesLus,
                'totalMessages' =>$totalMessages,
                'percentLus'=> $percentLus,
                'percentNonLus'=>  $percentNonLus,
            'ressources_recent' => Ressource::latest()->take(3)->get(),

            'reussis' => $reussis,
            'enAttente' =>  $enAttente,
            'annules' => $annules,

            'pourcentageReussis' => $pourcentageReussis,
            'evolution' => $pourcentage,
            'evolution_revenus' => $evolution_revenus,

            'rdvsParMois' => $rdvsParMois ?? [],


            'total'=> $total,

            'rdvMoisActuel' => $rdvMoisActuel,
            'recentRdv'=>$recentRdv,
            'recentMessage'=>  $recentMessage,
            'recentPaiement'=>  $recentPaiement,
            'recentUser'=>  $recentUser,
            'recentRessource'=>$recentRessource,
            'rdvs' => $rdvs,
        'filtre' => $filtre,

 'revenus_total' => number_format($revenus_total, 2),
      



'filtre' => $filtre,
        'nouveaux_utilisateurs' => $nouveaux_utilisateurs ?? null,
        'evolution_utilisateurs' => $evolution_utilisateurs ?? null,
        'inactifs_utilisateurs' => $inactifs_utilisateurs ?? null,
        
        'rdvToday' => $rdvToday ?? null,
        'rdvYesterday' => $rdvYesterday ?? null,
        'evolution' => $evolution ?? null,
        'rdvsParJours' => $rdvsParJours,
        'total' => $total,
        'pctReussis' => $pctReussis ?? null,
        'pctAttente' => $pctAttente ?? null,
        'pctAnnules' => $pctAnnules ?? null,
        'rdvs' => $rdvs,
        'rdvsGeneraux' => $rdvsGeneraux,
        'evolutionPrefix'=>$evolutionPrefix,
        'evolutionColor'=>$evolutionColor,
        'progressColor'=>$progressColor,
      'phrase3'=>$phrase3,
    'rdvlast' => $rdvlast,
    'totalEvolution' => $totalEvolution,
    'progressPercent' => abs($totalEvolution),
    'phrase4'=>$phrase4,
    'evolution_paiments'=>$evolution_paiments,
    'abonne_total'=>$abonne_total,
    'revenus_total'=>$revenus_total,
    'dates'=>$dates,
    'revenus'=> $revenus,
    'abonnes'=>$abonnes, 
   
       ]);
    }}
