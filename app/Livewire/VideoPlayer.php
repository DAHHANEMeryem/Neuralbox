<?php

namespace App\Livewire;

use App\Models\Rate;
use Livewire\Component;
use App\Models\Ressource;
use App\Models\Subscription;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;

class VideoPlayer extends Component
{
    #[Url(as: 'v')]
    public $currentVideoId;
    public $videoDescription;
    public $videoTitle;
    public $videoUrl;

    #[Locked]
    public $page;

    public $isSubmitted = false;
    public $isSubscribed = false;
    public $completedVideoIds = [];

    // Champs du formulaire
    public $manual_steps_respect, $focus_and_memory, $family_involvement,
           $motor_and_emotional_stability, $enjoyment, $digital_addiction_avoidance,
           $challenge_and_persistence, $attached_docs_usage;
    public $game_strengths, $observed_results, $difficulties, $general_notes;

    // ===========================
    // Méthodes du composant
    // ===========================
    public function mount($page)
    {
        $this->page = $page;
        $this->loadCompletedVideos();
        $this->checkIfSubscribed();
        $this->loadInitialVideo();
    }

    public function checkIfSubscribed()
    {
        if (!Auth::check()) {
            $this->isSubscribed = false;
            return;
        }

        $user = Auth::user();

        if ($user->is_admin) {
            $this->isSubscribed = true;
            return;
        }

        if ($this->page === 'pedagogie') {
            $this->isSubscribed = Subscription::where('user_id', $user->id)
                ->where('type', 'golden')
                ->where('status', 'validated')
                ->exists();
        } else {
            $this->isSubscribed = (bool) $user->has_access;
        }
    }

    public function loadCompletedVideos()
    {
        if (Auth::check()) {
            $this->completedVideoIds = Auth::user()->rates()
                ->pluck('ressource_id')
                ->map(fn($id) => (int) $id)
                ->toArray();
        }
    }

    public function selectVideo($videoId)
    {
        $video = Ressource::find($videoId);
        if (!$video) return;

        $isPremium = $video->visibilite != 'tous';
        if ($isPremium && !$this->isSubscribed) {
            $this->dispatch('open-sub-modal');
            return;
        }

        $this->currentVideoId = (int) $video->id;
        $this->videoTitle = $video->titre;
        $this->videoDescription = $video->description;
        $this->videoUrl = route('video-link', ['videoName' => $video->video_url]);

        $this->checkIfSubmitted();

        $this->dispatch('videoChanged', [
            'url' => $this->videoUrl,
            'title' => $this->videoTitle,
            'description' => $this->videoDescription,
        ]);
    }

    public function markVideoCompleted($videoId)
    {
        if (Auth::check() && !in_array((int) $videoId, $this->completedVideoIds)) {
            Rate::firstOrCreate([
                'user_id' => Auth::id(),
                'ressource_id' => (int) $videoId
            ]);

            $this->loadCompletedVideos();
        }
    }

    public function loadInitialVideo()
    {
        $ressources = $this->getFilteredRessources();
        if ($this->page === 'pedagogie') {
            $ressources = $ressources->flatten();
        }

        $startingVideo = $ressources->where('id', $this->currentVideoId)->first();
        if (!$startingVideo || ($startingVideo->visibilite != 'tous' && !$this->isSubscribed)) {
            $startingVideo = $ressources->where('visibilite', 'tous')->first();
        }

        if ($startingVideo) {
            $this->selectVideo($startingVideo->id);
        }
    }

    public function checkIfSubmitted()
    {
        $this->isSubmitted = in_array((int) $this->currentVideoId, $this->completedVideoIds);
    }

    protected function getFilteredRessources()
    {
        $query = Ressource::with('category')
            ->where('categorie', $this->page)
            ->orderBy('ordre', 'asc');

        return ($this->page == 'neuralbox')
            ? $query->get()
            : $query->get()->groupBy(fn($item) => $item->category->name ?? 'Unité');
    }

    public function render()
    {
        return view('livewire.video-player', [
            'ressources' => $this->getFilteredRessources()
        ]);
    }
}