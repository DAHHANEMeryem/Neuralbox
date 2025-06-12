<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Paiement;
use App\Models\RendezVous;
use App\Models\Message;
use App\Models\Ressource;

class DashboardExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $filtre = $request->get('filtre', 'mois');
        $format = $request->get('format', 'complet'); // complet, resume, personnalise
        $sections = $request->get('sections', []); // sections spécifiques à exporter
        
        // Récupérer les données selon le filtre
        $data = $this->getDashboardData($filtre);
        
        // Ajouter les métadonnées d'export
        $data['export_info'] = [
            'date_export' => Carbon::now()->format('d/m/Y H:i'),
            'filtre' => $filtre,
            'format' => $format,
            'periode' => $this->getPeriodeLabel($filtre)
        ];
        
        // Sélectionner le template selon le format
        $template = $this->getTemplate($format);
        
        // Filtrer les données selon les sections demandées
        if ($format === 'personnalise' && !empty($sections)) {
            $data = $this->filterDataBySections($data, $sections);
        }
        
        $pdf = Pdf::loadView($template, $data)
                 ->setPaper('a4', 'portrait')
                 ->setOptions([
                     'defaultFont' => 'DejaVu Sans',
                     'isHtml5ParserEnabled' => true,
                     'isPhpEnabled' => true
                 ]);
        
        $filename = "dashboard-rapport-{$filtre}-" . Carbon::now()->format('Y-m-d') . ".pdf";
        
        return $pdf->download($filename);
    }
    
    private function getDashboardData($filtre)
    {
        $dates = $this->getDateRange($filtre);
        $startDate = $dates['start'];
        $endDate = $dates['end'];
        $previousStart = $dates['previous_start'];
        $previousEnd = $dates['previous_end'];
        
        // Statistiques utilisateurs
        $utilisateurs = User::whereBetween('created_at', [$startDate, $endDate])->get();
        $utilisateurs_precedent = User::whereBetween('created_at', [$previousStart, $previousEnd])->count();
        $nombre_utilisateurs = $utilisateurs->count();
        $evolution_utilisateurs = $utilisateurs_precedent > 0 
            ? (($nombre_utilisateurs - $utilisateurs_precedent) / $utilisateurs_precedent) * 100 
            : 0;
            
        // Statistiques revenus
        $paiements = Paiement::whereBetween('created_at', [$startDate, $endDate])->get();
        $paiements_precedent = Paiement::whereBetween('created_at', [$previousStart, $previousEnd]);
        $revenus_total = $paiements->sum('montant');
        $revenus_precedent = $paiements_precedent->sum('montant');
        $evolution_revenus = $revenus_precedent > 0 
            ? (($revenus_total - $revenus_precedent) / $revenus_precedent) * 100 
            : 0;
            
        // Statistiques abonnements
        $abonne_total = $paiements->where('status', 'confirme')->count();
        $abonne_precedent = $paiements_precedent->where('status', 'confirme')->count();
        $evolution_abonnements = $abonne_precedent > 0 
            ? (($abonne_total - $abonne_precedent) / $abonne_precedent) * 100 
            : 0;
            
        // Statistiques rendez-vous
        $rdv = RendezVous::whereBetween('created_at', [$startDate, $endDate])->get();
        $rdv_precedent = RendezVous::whereBetween('created_at', [$previousStart, $previousEnd])->count();
        $total_rdv = $rdv->count();
        $evolution_rdv = $rdv_precedent > 0 
            ? (($total_rdv - $rdv_precedent) / $rdv_precedent) * 100 
            : 0;
            
        $rdv_acceptes = $rdv->where('statut', 'confirme')->count();
        $rdv_attente = $rdv->where('statut', 'attente')->count();
        $rdv_annules = $rdv->where('statut', 'annule')->count();
        
        // Statistiques messages
        $messages = Message::whereBetween('created_at', [$startDate, $endDate])->get();
        $total_messages = $messages->count();
        $messages_non_lus = $messages->where('is_read', false)->count();
        $messages_lus = $messages->where('is_read', true)->count();
        
        // Données pour graphiques
        $chartData = $this->getChartData($filtre, $startDate, $endDate);
        
        return [
            'periode' => [
                'filtre' => $filtre,
                'debut' => $startDate->format('d/m/Y'),
                'fin' => $endDate->format('d/m/Y'),
                'phrase' => $this->getPeriodePhrase($filtre)
            ],
            'utilisateurs' => [
                'total' => $nombre_utilisateurs,
                'evolution' => round($evolution_utilisateurs, 1),
                'nouveaux' => $utilisateurs->where('created_at', '>=', Carbon::now()->subDays(7))->count(),
                'parents' => $utilisateurs->where('email', '!=', 'admin@gmail.com')->count(),
                'inactifs' => User::whereNull('last_seen')
              ->orWhere('last_seen', '<', Carbon::now()->subMonth())->count()
               
            ],
            'revenus' => [
                'total' => $revenus_total,
                'evolution' => round($evolution_revenus, 1),
                'moyenne_par_jour' => $revenus_total / max(1, $startDate->diffInDays($endDate)),
                'top_paiements' => $paiements->sortByDesc('montant')->take(5)
            ],
            'abonnements' => [
                'total' => $abonne_total,
                'evolution' => round($evolution_abonnements, 1),
                'actifs' => $paiements->where('status', 'confirme')->where('expires_at', '>', Carbon::now())->count(),
                'expires_bientot' => $paiements->where('expires_at', '<=', Carbon::now()->addDays(7))->count()
            ],
            'rendezvous' => [
                'total' => $total_rdv,
                'evolution' => round($evolution_rdv, 1),
                'acceptes' => $rdv_acceptes,
                'attente' => $rdv_attente,
                'annules' => $rdv_annules,
                'taux_acceptation' => $total_rdv > 0 ? round(($rdv_acceptes / $total_rdv) * 100, 1) : 0
            ],
            'messages' => [
                'total' => $total_messages,
                'non_lus' => $messages_non_lus,
                'lus' => $messages_lus,
                'taux_reponse' => $total_messages > 0 ? round(($messages_lus / $total_messages) * 100, 1) : 0
            ],
            'graphiques' => $chartData,
            'top_utilisateurs' => User::withCount('paiements')->orderBy('paiements_count', 'desc')->take(10)->get(),
            'activite_recente' => $this->getRecentActivity($startDate, $endDate)
        ];
    }
    
    private function getDateRange($filtre)
    {
        $now = Carbon::now();
        
        switch ($filtre) {
            case 'jour':
                return [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay(),
                    'previous_start' => $now->copy()->subDay()->startOfDay(),
                    'previous_end' => $now->copy()->subDay()->endOfDay()
                ];
                
            case 'semaine':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek(),
                    'previous_start' => $now->copy()->subWeek()->startOfWeek(),
                    'previous_end' => $now->copy()->subWeek()->endOfWeek()
                ];
                
            case 'mois':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth(),
                    'previous_start' => $now->copy()->subMonth()->startOfMonth(),
                    'previous_end' => $now->copy()->subMonth()->endOfMonth()
                ];
                
            case 'annee':
                return [
                    'start' => $now->copy()->startOfYear(),
                    'end' => $now->copy()->endOfYear(),
                    'previous_start' => $now->copy()->subYear()->startOfYear(),
                    'previous_end' => $now->copy()->subYear()->endOfYear()
                ];
                
            default:
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth(),
                    'previous_start' => $now->copy()->subMonth()->startOfMonth(),
                    'previous_end' => $now->copy()->subMonth()->endOfMonth()
                ];
        }
    }
    
    private function getChartData($filtre, $startDate, $endDate)
    {
        $dates = [];
        $revenus = [];
        $abonnes = [];
        $rdv = [];
        
        $current = $startDate->copy();
        
        while ($current <= $endDate) {
            $nextDate = $this->getNextPeriod($current, $filtre);
            
            $dates[] = $current->format($this->getDateFormat($filtre));
            
            $revenus[] = Paiement::whereBetween('created_at', [$current, $nextDate])
                                ->sum('montant');
                                
            $abonnes[] = Paiement::whereBetween('created_at', [$current, $nextDate])
                               ->where('status', 'confirme')
                               ->count();
                               
            $rdv[] = RendezVous::whereBetween('created_at', [$current, $nextDate])
                              ->count();
            
            $current = $nextDate->copy()->addSecond();
        }
        
        return compact('dates', 'revenus', 'abonnes', 'rdv');
    }
    
    private function getNextPeriod($date, $filtre)
    {
        switch ($filtre) {
            case 'jour':
                return $date->copy()->endOfHour();
            case 'semaine':
                return $date->copy()->endOfDay();
            case 'mois':
                return $date->copy()->endOfDay();
            case 'annee':
                return $date->copy()->endOfMonth();
            default:
                return $date->copy()->endOfDay();
        }
    }
    
    private function getDateFormat($filtre)
    {
        switch ($filtre) {
            case 'jour':
                return 'H:i';
            case 'semaine':
                return 'd/m';
            case 'mois':
                return 'd/m';
            case 'annee':
                return 'M Y';
            default:
                return 'd/m';
        }
    }
    
    private function getPeriodeLabel($filtre)
    {
        switch ($filtre) {
            case 'jour':
                return "Aujourd'hui";
            case 'semaine':
                return "Cette semaine";
            case 'mois':
                return "Ce mois";
            case 'annee':
                return "Cette année";
            default:
                return "Ce mois";
        }
    }
    
    private function getPeriodePhrase($filtre)
    {
        switch ($filtre) {
            case 'jour':
                return "par rapport à hier";
            case 'semaine':
                return "par rapport à la semaine dernière";
            case 'mois':
                return "par rapport au mois dernier";
            case 'annee':
                return "par rapport à l'année dernière";
            default:
                return "par rapport au mois dernier";
        }
    }
    
    private function getTemplate($format)
    {
        switch ($format) {
            case 'resume':
                return 'admin.exports.dashboard-resume';
            case 'personnalise':
                return 'admin.exports.dashboard-personnalise';
            case 'complet':
            default:
                return 'admin.exports.dashboard-complet';
        }
    }
    
    private function filterDataBySections($data, $sections)
    {
        $filteredData = ['export_info' => $data['export_info'], 'periode' => $data['periode']];
        
        foreach ($sections as $section) {
            if (isset($data[$section])) {
                $filteredData[$section] = $data[$section];
            }
        }
        
        return $filteredData;
    }
    
    private function getRecentActivity($startDate, $endDate)
    {
        $activities = collect();
        
        // Nouveaux utilisateurs
        $newUsers = User::whereBetween('created_at', [$startDate, $endDate])
                       ->latest()
                       ->take(5)
                       ->get();
        
        foreach ($newUsers as $user) {
            $activities->push([
                'type' => 'user',
                'message' => "Nouvel utilisateur: {$user->name}",
                'date' => $user->created_at,
                'icon' => 'fa-user-plus',
                'color' => 'text-blue-500'
            ]);
        }
        
        // Nouveaux paiements
        $newPayments = Paiement::whereBetween('created_at', [$startDate, $endDate])
                              ->with('user')
                              ->latest()
                              ->take(5)
                              ->get();
        
        foreach ($newPayments as $payment) {
            $activities->push([
                'type' => 'payment',
                'message' => "Paiement de {$payment->montant} MAD par {$payment->user->name}",
                'date' => $payment->created_at,
                'icon' => 'fa-credit-card',
                'color' => 'text-green-500'
            ]);
        }
        
        // Nouveaux RDV
        $newRdv = RendezVous::whereBetween('created_at', [$startDate, $endDate])
                           ->with('user')
                           ->latest()
                           ->take(5)
                           ->get();
        
        foreach ($newRdv as $rdv) {
            $activities->push([
                'type' => 'rdv',
                'message' => "Nouveau RDV avec {$rdv->user->name}",
                'date' => $rdv->created_at,
                'icon' => 'fa-calendar',
                'color' => 'text-purple-500'
            ]);
        }
        
        return $activities->sortByDesc('date')->take(10)->values()->all();
    }
    
    public function showExportForm()
    {
        return view('admin.exports.form');
    }
}