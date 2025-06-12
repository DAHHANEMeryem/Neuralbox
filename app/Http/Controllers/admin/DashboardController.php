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
    public function index()
    { 
 

      
        
        $moisActuel = Carbon::now()->month;
        $rdvsParMois = [];

    // Boucle sur les mois de l'année (1 à 12)
    for ($i = 1; $i <= 12; $i++) {
        // Récupérer le nombre de rendez-vous pour chaque mois
        $rdvsParMois[$i] = RendezVous::whereMonth('date', $i)->count();
    }

        $totalRdvMoisActuel = RendezVous::whereMonth('date', $moisActuel)->count();
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

        $utilisateursActuels = User::whereBetween('created_at', [$debutMoisActuel, $finMoisActuel])->count();
        $utilisateursPrecedents = User::whereBetween('created_at', [$debutMoisPrecedent, $finMoisPrecedent])->count();

        $nouveauxUtilisateurs = $utilisateursActuels;
        $rdvMoisActuel = RendezVous::whereMonth('date', now()->month)->count();  // Compte les rendez-vous du mois actuel
        $rdvMoisPrecedent = RendezVous::whereMonth('date', now()->subMonth()->month)->count();  // Compte les rendez-vous du mois précédent
        
        if ($nouveauxUtilisateurs == 0) {
            $evolution_utilisateurs = 0;
        } elseif ($nouveauxUtilisateurs <= 10) {
            $evolution_utilisateurs = 10;
        } elseif ($nouveauxUtilisateurs <= 20) {
            $evolution_utilisateurs = 20;
        } elseif ($nouveauxUtilisateurs <= 30) {
            $evolution_utilisateurs = 30;
        } elseif ($nouveauxUtilisateurs <= 50) {
            $evolution_utilisateurs = 50;
        } elseif ($nouveauxUtilisateurs <= 100) {
            $evolution_utilisateurs = 75;
        } else {
            $evolution_utilisateurs = 100;
        }

        $revenusMoisActuel = Paiement::whereMonth('created_at', now()->month)->sum('montant');
        $revenusMoisPrecedent = Paiement::whereMonth('created_at', now()->subMonth()->month)->sum('montant');

        // Système de palier pour l’évolution des revenus
        if ($revenusMoisActuel == 0) {
            $evolution_revenus = 0;
        } elseif ($revenusMoisActuel <= 1000) {
            $evolution_revenus = 10;
        } elseif ($revenusMoisActuel <= 5000) {
            $evolution_revenus = 20;
        } elseif ($revenusMoisActuel <= 10000) {
            $evolution_revenus = 30;
        } elseif ($revenusMoisActuel <= 20000) {
            $evolution_revenus = 50;
        } elseif ($revenusMoisActuel <= 50000) {
            $evolution_revenus = 75;
        } else {
            $evolution_revenus = 100;
        }

        // Calcul de l'évolution des rendez-vous
        if ($rdvMoisPrecedent > 0) {
            $evolutionRdv = round((($rdvMoisActuel - $rdvMoisPrecedent) / $rdvMoisPrecedent) * 100, 2);
        } else {
            $evolutionRdv = 100; // ou 0 selon ta logique
        }

        // Exemple simple pour "nouveaux" (utilisateurs inscrits ce mois)
        $nouveaux = User::whereMonth('created_at', now()->month)->count();

        // Exemple simple pour "inactifs" (aucune activité depuis 30 jours)
        $inactifs = User::all()->filter(function ($user) {
            return !$user->isOnline();
        })->count();
         // Nombre de rendez-vous pour ce mois
    $rdvMoisActuel = RendezVous::whereMonth('date', now()->month)->count();

    // Nombre de rendez-vous pour le mois précédent
    $rdvMoisPrecedent = RendezVous::whereMonth('date', now()->subMonth()->month)->count();

    // Calcul de l'évolution des rendez-vous par rapport au mois précédent
    if ($rdvMoisPrecedent > 0) {
        $evolutionRdv = round((($rdvMoisActuel - $rdvMoisPrecedent) / $rdvMoisPrecedent) * 100, 2);
    } else {
        $evolutionRdv = 0; // Si aucun rendez-vous le mois précédent, l'évolution est à 0%
    }

    // Calcul du pourcentage à afficher selon les paliers d'évolution
    if ($rdvMoisActuel > 0) {
        if ($rdvMoisActuel <= 10) {
            $pourcentageRdv = 10;
        } elseif ($rdvMoisActuel <= 20) {
            $pourcentageRdv = 20;
        } elseif ($rdvMoisActuel <= 30) {
            $pourcentageRdv = 30;
        } elseif ($rdvMoisActuel <= 50) {
            $pourcentageRdv = 50;
        } elseif ($rdvMoisActuel <= 100) {
            $pourcentageRdv = 75;
        } else {
            $pourcentageRdv = 100;
        }
    } else {
        $pourcentageRdv = 0; // Si aucun rendez-vous ce mois
    }
    $messagesNonLus = Message::where('is_read', false)->count();
    $messagesLus = Message::where('is_read', true)->count();
    $totalMessages = $messagesNonLus + $messagesLus;

        return view('admin.dashboard', [
            'nombre_utilisateurs' => User::count(),
            'nombre_parents' => User::where('email', '!=', 'admin@gmail.com')->count(),
            'rendezvous_auj' => RendezVous::whereDate('date', today())->count(),
            'revenus_mois' => Paiement::whereMonth('created_at', now()->month)->sum('montant'),
            'derniers_utilisateurs' => User::where('email', '!=', 'admin@gmail.com')
                ->latest()
                ->take(5)
                ->get(),
            'prochains_rdv' => RendezVous::with('user')
                ->where('date', '>=', Carbon::now())
                ->orderBy('date', 'asc')
                ->limit(5)
                ->get(),
                'messagesNonLus' => $messagesNonLus,
                'messagesLus' => $messagesLus,
                'totalMessages' =>$totalMessages,
            'ressources_recent' => Ressource::latest()->take(3)->get(),
            'evolution_utilisateurs' => $evolution_utilisateurs,
            'reussis' => $reussis,
            'enAttente' =>  $enAttente,
            'annules' => $annules,
            
            'pourcentageReussis' => $pourcentageReussis,
            'evolution' => $pourcentage,
            'evolution_revenus' => $evolution_revenus,
            'nouveaux_utilisateurs' => $nouveaux,
            'inactifs_utilisateurs' => $inactifs,
            'rdvsParMois' => $rdvsParMois ?? [],
            'totalRdvMoisActuel' => $totalRdvMoisActuel,
            'evolutionRdv' => $evolutionRdv, 
            'rdvsParMois' => $rdvsParMois,
            'total'=> $total,
            'evolutionRdv' => $evolutionRdv,
            'pourcentageRdv' => $pourcentageRdv,
            'rdvMoisActuel' => $rdvMoisActuel,// <-- AJOUTÉ ICI
           
        ]);
    }
}
