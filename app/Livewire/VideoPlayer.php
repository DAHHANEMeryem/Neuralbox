<?php

namespace App\Livewire;

use App\Models\Rate;
use Livewire\Component;
use App\Models\Ressource;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;

class VideoPlayer extends Component
{

    #[Url(as: 'v')]
    public $currentVideoId;
    public $videoDescription; // <-- nouvelle propriété
    public $videoTitle;
    public $videoUrl;

    #[Locked]
    public $groupedRessources;
    public $page;
    public $isSubmitted = false;
    public $isSubscribed = false;

   public function mount($page)
{
    $this->page = $page;

    $ressources = $this->getFilteredRessources();

    // Si c'est groupé (pedagogie) → on "aplati"
    if ($ressources instanceof \Illuminate\Support\Collection && $ressources->first() instanceof \Illuminate\Support\Collection) {
        $ressources = $ressources->flatten();
    }

    // Chercher la vidéo demandée dans l’URL si elle est publique
    $startingVideo = $ressources
        ->where('visibilite', 'tous')
        ->where('id', $this->currentVideoId)
        ->first()
        ?? $ressources->where('visibilite', 'tous')->first();

    if ($startingVideo) {
        $this->selectVideo($startingVideo->id);
    }

    $this->checkIfSubscribed();
    $this->checkIfSubmitted();
}

    protected function getFilteredRessources()
    {
        if($this->page == 'neuralbox'){
            return Ressource::where('categorie', $this->page)
                ->orderBy('ordre', 'asc')
                ->with('category')
                ->get();}
        else{
            return Ressource::with('category')
            ->where('categorie', $this->page)
            ->orderBy('ordre', 'asc')->get()
            ->groupBy(
                function ($item) {
                    return $item->category->name ?? 'بدون فئة';
            });
        }
    
    }

    public function selectVideo($videoId)
{
    $video = Ressource::find($videoId);

    if ($video) {
        $this->currentVideoId = $video->id;
        $this->videoTitle = $video->titre;
        $this->videoDescription = $video->description; // <-- ajouter ça
        $this->videoUrl = route('video-link', ['videoName' => $video->video_url]);
        $this->checkIfSubmitted();

        // Dispatch event to refresh HLS.js player in JS
        $this->dispatch('videoChanged', url: route('video-link', ['videoName' => $video->video_url]));
    }
}

    public function checkIfSubmitted()
    {
        if (Auth::check() && $this->currentVideoId) {
            $this->isSubmitted = Auth::user()->rates()
                ->where('ressource_id', $this->currentVideoId)
                ->exists();
        }
    }
    public function checkIfSubscribed()
    {
        if(Auth::check())
            $this->isSubscribed = $this->page === 'pedagogie' ? (Auth::user()->subscription_type == 'golden' || Auth::user()->is_admin) : (Auth::user()->subscription_type || Auth::user()->is_admin);
    }





    // Form Properties
    public $manual_steps_respect, $focus_and_memory, $family_involvement,
        $motor_and_emotional_stability, $enjoyment, $digital_addiction_avoidance,
        $challenge_and_persistence, $attached_docs_usage;

    public $game_strengths, $observed_results, $difficulties, $general_notes;

    protected $rules = [
        'manual_steps_respect' => 'required',
        'focus_and_memory' => 'required',
        // Add other required rules here...
    ];

    public function saveEvaluation()
    {
        $this->validate();

        // Save to database
        Rate::create([
            'user_id' => auth()->id(),
            'ressource_id' => $this->currentVideoId,
            'manual_steps_respect' => $this->manual_steps_respect,
            'focus_and_memory' => $this->focus_and_memory,
            'family_involvement' => $this->family_involvement,
            'motor_and_emotional_stability' => $this->motor_and_emotional_stability,
            'enjoyment' => $this->enjoyment,
            'digital_addiction_avoidance' => $this->digital_addiction_avoidance,
            'challenge_and_persistence' => $this->challenge_and_persistence,
            'attached_docs_usage' => $this->attached_docs_usage,
            'game_strengths' => $this->game_strengths,
            'observed_results' => $this->observed_results,
            'difficulties' => $this->difficulties,
            'general_notes' => $this->general_notes,
        ]);

        $this->isSubmitted = true;
        session()->flash('message', 'تم إرسال التقييم بنجاح!');
    }



    public function render()
    {
        $ressources = $this->getFilteredRessources();
        return view('livewire.video-player', [
            'ressources' => $ressources,
        ]);
    }
}