<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
class RessourceController extends Controller
{
    
public function pedagogie()
{
    $ressources = Ressource::where('categorie', 'pedagogie')->get();
     $estAbonne = Auth::check() && Auth::user()->is_admin;
        $visibilite = $estAbonne ? 'abonne' : 'tous';
        
        // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        $ressourcesGratuites = Ressource::getRessources('pedagogie', 'tous');
        $ressourcesPremium = Ressource::getRessources('pedagogie', 'abonne');
    return view('pedagogie', compact('ressources','estAbonne','visibilite','ressourcesGratuites','ressourcesPremium'));
}

public function neuralbox()
{
    $ressources = Ressource::where('categorie', 'neuralbox')->get();
      $estAbonne = Auth::check() && Auth::user()->is_admin;
        $visibilite = $estAbonne ? 'abonne' : 'tous';
        
        // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        $ressourcesGratuites = Ressource::getRessources('neuralbox', 'tous');
        $ressourcesPremium = Ressource::getRessources('neuralbox', 'abonne');
    return view('neuralbox1', compact('ressources','estAbonne','visibilite','ressourcesGratuites','ressourcesPremium'));
}
    public function showPedagogie()
    {
        // Détermine si l'utilisateur est abonné
        $estAbonne = Auth::check() && Auth::user()->is_admin;
        $visibilite = $estAbonne ? 'abonne' : 'tous';
        
        // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        $ressourcesGratuites = Ressource::getRessources('pedagogie', 'tous');
        $ressourcesPremium = Ressource::getRessources('pedagogie', 'abonne');
        
        return view('pedagogie', [
            'ressourcesGratuites' => $ressourcesGratuites,
            'ressourcesPremium' => $ressourcesPremium,
            'estAbonne' => $estAbonne,
            'visibilite' => $visibilite,
        ]);
    }
    
    /**
     * Affiche la page des ressources NeuralBox
     */
    public function showNeuralBox()
    {
        // Détermine si l'utilisateur est abonné
        $estAbonne = Auth::check() && Auth::user()->is_admin;
        $visibilite = $estAbonne ? 'abonne' : 'tous';
        
        // Récupère les ressources
        $ressourcesGratuites = Ressource::getRessources('neuralbox', 'tous');
        $ressourcesPremium = Ressource::getRessources('neuralbox', 'abonne');
        
        return view('neuralbox1', [
            'ressourcesGratuites' => $ressourcesGratuites,
            'ressourcesPremium' => $ressourcesPremium,
            'estAbonne' => $estAbonne,
            'visibilite' =>$visibilite,
        ]);
    } 
public function index()
{
    $ressources = Ressource::latest()->get();
    return view('admin.ressource.index', compact('ressources'));
}

public function create()
{
    return view('admin.ressource.create');
}

public function store(Request $request)
{
    $request->validate([
        'titre' => 'required',
        'categorie' => 'required|in:pedagogie,محتوى نيورال بوكس',
        'description' => 'required|string|max:255',
        'visibilite' => 'required|in:abonne,tous',
        'video_url' => 'required|url',
        'ordre' => 'nullable|integer|min:0',
        'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->only(['titre', 'categorie', 'description', 'visibilite', 'video_url', 'ordre']);

    // Gestion de l'image
    if ($request->hasFile('preview_image')) {
        $path = $request->file('preview_image')->store('ressources', 'public');
        $data['preview_image'] = $path;
    }

    Ressource::create($data);

    return redirect()->route('admin.ressources.index')->with('success', 'Ressource ajoutée.');
}

public function edit(Ressource $ressource)
{
    return view('admin.ressource.edit', compact('ressource'));
}
public function update(Request $request, Ressource $ressource)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'categorie' => 'required|in:pedagogie,محتوى نيورال بوكس',
        'visibilite' => 'required|in:tous,abonne',
        'video_url' => 'required|url',
        'ordre' => 'nullable|integer|min:0',
        'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->only(['titre', 'description', 'categorie', 'visibilite', 'video_url', 'ordre']);

    if ($request->hasFile('preview_image')) {
        // Supprimer l'ancienne image si elle existe
        if ($ressource->preview_image && Storage::disk('public')->exists($ressource->preview_image)) {
            Storage::disk('public')->delete($ressource->preview_image);
        }

        $data['preview_image'] = $request->file('preview_image')->store('ressources', 'public');
    }

    $ressource->update($data);

    return redirect()->route('admin.ressources.index')->with('success', 'Ressource modifiée.');
}



  

public function destroy(Ressource $ressource)
{
    $ressource->delete();
    return back()->with('success', 'Ressource supprimée.');
}
}