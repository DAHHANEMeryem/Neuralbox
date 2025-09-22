<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RendezVous;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminRendezVousController extends Controller
{
    public function index(Request $request)
    {
        $query = RendezVous::query();
        




        // Filtrage par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Recherche par nom
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        // Tri par date
        $query->orderBy('date', 'desc');

        // Pagination
        $rendezvous = $query->with('user')->paginate(10);

        // Statistiques
        $totalToday = RendezVous::whereDate('date', Carbon::today())->count();
        $totalWeek = RendezVous::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalmonth = RendezVous::whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $totalAttente = RendezVous::where('statut', 'attente')->count();
        $totalRdv = RendezVous::count();

        return view('admin.rendezvous.index', compact(
            'rendezvous', 
            'totalToday', 
            'totalWeek',
            'totalmonth',
            'totalAttente',
            'totalRdv'
        ));
    }

    public function updateStatus(Request $request, $id)
{
    $rendezvous = RendezVous::findOrFail($id);
    
    // Validation du statut
    $validated = $request->validate([
        'statut' => 'required|in:attente,confirme,refuse', // Vous pouvez avoir 'annule' ou 'refuse' en fonction de votre logique
    ]);

    // Si le statut est "refuse" ou "annule"
    if ($validated['statut'] == 'refuse') {
        $rendezvous->statut = 'annule'; // Mettre à jour le statut du rendez-vous en "annule"
    } else {
        $rendezvous->statut = $validated['statut'];
    }

    $rendezvous->save();

    return redirect()->route('admin.rendezvous.index')->with('success', 'Rendez-vous annulé avec succès');
}


    public function getDetails($id)
    {
        $rendezvous = RendezVous::with('user')->findOrFail($id);
        
        // Formater les dates pour l'affichage
        $data = $rendezvous->toArray();
        $data['date_formatted'] = Carbon::parse($rendezvous->date)->format('d/m/Y H:i');
        $data['created_at_formatted'] = Carbon::parse($rendezvous->created_at)->format('d/m/Y H:i');
        
        // Formater le statut
        $statuses = [
            'attente' => '<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">En attente</span>',
            'confirme' => '<span class="bg-green-100 text-green-800 px-2 py-1 rounded">Confirmé</span>',
            'annule' => '<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">Refusé</span>',
        ];
        
        $data['statut_formatted'] = $statuses[$rendezvous->statut] ?? ucfirst($rendezvous->statut);
        
        return response()->json($data);
    }

    public function editStatutArrive($id)
    {
        // Récupérer le rendez-vous par son id
        $rendezvous = RendezVous::findOrFail($id);
        
    
        // Retourner une vue pour modifier le statut
        return view('admin.rendezvous.edit-statut', compact('rendezvous'));
    }
    
    
    public function updateStatutArrive(Request $request, $id)
    {
        $rdv = RendezVous::findOrFail($id);
    
        $request->validate([
            'statut' => 'required|in:attente,confirme,refuse,annule',
            
        ]);
    
        $rdv->statut = $request->statut;
        $rdv->save();
    
        return redirect()->route('admin.rendezvous.index')->with('success', 'Le statut  ont été mis à jour.');
    }
    public function destroy($id)
{
    $rdv = RendezVous::findOrFail($id);
    $rdv->delete();

    return redirect()->route('admin.rendezvous.index')->with('success', 'Rendez-vous supprimé avec succès.');
}

    /*
    // Méthodes pour l'envoi d'emails (à implémenter selon vos besoins)
    private function sendConfirmationEmail(RendezVous $rendezvous)
    {
        // Logique d'envoi d'email de confirmation
    }
    
    private function sendRefusalEmail(RendezVous $rendezvous)
    {
        // Logique d'envoi d'email de refus
    }
    */
}
