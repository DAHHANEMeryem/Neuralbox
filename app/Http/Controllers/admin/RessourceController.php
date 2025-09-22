<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Paiement;

class RessourceController extends Controller
{

    public function pedagogie()
    {
        // $ressources = Ressource::where('categorie', 'pedagogie')->get();
        //  $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();

        // $visibilite = $estAbonne ? 'abonne' : 'tous';

        // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        $ressourcesGratuites = Ressource::getRessources('pedagogie', 'tous');
        $ressourcesPremium = Ressource::getRessources('pedagogie', 'abonne');
        return view('peda', compact('ressourcesGratuites', 'ressourcesPremium'));
    }

    public function neuralbox()
    {
        $ressources = Ressource::where('categorie', 'neuralbox')->get();
        $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();
        $visibilite = $estAbonne ? 'abonne' : 'tous';

        // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        $ressourcesGratuites = Ressource::getRessources('neuralbox', 'tous');
        $ressourcesPremium = Ressource::getRessources('neuralbox', 'abonne');

        return view('neuralbox', compact('ressources', 'estAbonne', 'visibilite', 'ressourcesGratuites', 'ressourcesPremium'));
    }
    public function showPedagogie()
    {
        // Détermine si l'utilisateur est abonné
        $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();
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
        $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();
        $visibilite = $estAbonne ? 'abonne' : 'tous';

        // Récupère les ressources
        $ressourcesGratuites = Ressource::getRessources('neuralbox', 'tous');
        $ressourcesPremium = Ressource::getRessources('neuralbox', 'abonne');

        return view('neuralbox1', [
            'ressourcesGratuites' => $ressourcesGratuites,
            'ressourcesPremium' => $ressourcesPremium,
            'estAbonne' => $estAbonne,
            'visibilite' => $visibilite,
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
            'categorie' => 'required|in:pedagogie,neuralbox',
            'description' => 'required|string|max:255',
            'visibilite' => 'required|in:abonne,tous',
            'video_url' => 'nullable|file|mimes:mp4|max:1012000', // max ~100MB
            'ordre' => 'nullable|integer|min:0',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // max ~2MB
        ]);

        $data = $request->only(['titre', 'categorie', 'description', 'visibilite', 'ordre']);

        // Gestion de l'image
        if ($request->hasFile('preview_image')) {
            $imagePath = $request->file('preview_image')->store('images', 'private');
            $data['preview_image'] = $imagePath;
        }

        // Gestion de la vidéo
        if ($request->hasFile('video_url')) {
            $videoPath = $request->file('video_url')->store('videos', 'private');
            $data['video_url'] = $videoPath;
        }

        Ressource::create($data);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $ressource = Ressource::findOrFail($id);
        return view('admin.ressource.edit', compact('ressource'));
    }
    public function update(Request $request, $id)
    {
        $ressource = Ressource::findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string',
            'visibilite' => 'required|string',
            'ordre' => 'nullable|integer|min:0',
            'video_url' => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg|max:102400',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Mise à jour des champs texte
        $ressource->titre = $request->input('titre');
        $ressource->description = $request->input('description');
        $ressource->categorie = $request->input('categorie');
        $ressource->visibilite = $request->input('visibilite');
        $ressource->ordre = $request->input('ordre');

        // Mise à jour de la vidéo
        if ($request->hasFile('video_url')) {
            if ($ressource->video_url) {
                $videoPath = str_replace('/storage/', 'public/', $ressource->video_url);
                if (Storage::exists($videoPath)) {
                    Storage::delete($videoPath);
                }
            }



            $videoPath = $request->file('video_url')->store('videos', 'public');
            $ressource->video_url =  $videoPath;
            // /storage/videos/...
        }

        // Mise à jour de l'image
        if ($request->hasFile('preview_image')) {
            if ($ressource->preview_image && Storage::exists($ressource->preview_image)) {
                Storage::delete($ressource->preview_image);
            }

            $imagePath = $request->file('preview_image')->store('images', 'private');
            $data['preview_image'] = $imagePath;
        }


        $ressource->save();

        return redirect()->route('admin.ressources.index')->with('success', 'Ressource modifiée avec succès.');
    }


    public function destroy(Ressource $ressource)
    {
        $ressource->delete();
        return back()->with('success', 'Ressource supprimée.');
    }
}
