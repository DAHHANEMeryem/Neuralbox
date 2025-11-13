<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller

{
    public function create()
    {
        return view('admin.rendezvous.create');
    }
    public function index()
    {
        $rdvs = RendezVous::with(['user'])->latest()->paginate(10);
        return view('admin.rendezvous.index', compact('rdvs'));
    }
    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date|after:now',
        'numero' => 'required|string|max:20',
        'email' => 'required|email',
       
    ]);

    $user_id =  Auth::check() ? auth()->id() : null; 

    RendezVous::create([
        'user_id' => $user_id ,
        'date' => $request->date,
        'statut' => 'attente',
        'numero' => $request->numero,
        'email' => $request->email,
        'message'=>$request->message
    ]);

    return redirect()->route('rendezvous.create')->with('success', __('responses.date_success'));
}


    public function destroy($id)
    {
        RendezVous::destroy($id);
        return back()->with('success', 'Rendez-vous supprimé.');
    }
    public function show($id)
    {
        $rdv = RendezVous::findOrFail($id); // Fetch the rendezvous by its ID
        return view('admin.rendezvous.show', compact('rdv')); // Pass it to the view
    }
    public function edit($id)
{
    $rdv = RendezVous::findOrFail($id);
    return view('admin.rendezvous.edit', compact('rdv'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'statut' => 'required|in:attente,confirme,annule',
      
    ]);

    $rdv = RendezVous::findOrFail($id);
    $rdv->statut = $request->statut;
   
    $rdv->save();

    return redirect()->route('admin.rendezvous.index')->with('success', 'Rendez-vous mis à jour avec succès.');
}


}
