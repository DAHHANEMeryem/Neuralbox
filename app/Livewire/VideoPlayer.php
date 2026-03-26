<?php

namespace App\Livewire;

use App\Models\Rate;
use Livewire\Component;
use App\Models\Ressource;
use App\Models\Subscription;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    public $manual_steps_respect, $focus_and_memory, $family_involvement,
        $motor_and_emotional_stability, $enjoyment, $digital_addiction_avoidance,
        $challenge_and_persistence, $attached_docs_usage;

    public $game_strengths, $observed_results, $difficulties, $general_notes;

    protected $rules = [
        'manual_steps_respect' => 'required',
        'focus_and_memory' => 'required',
    ];

    // ===========================
    // Méthodes du composant
    // ===========================
    public function mount($page)
    {
        Log::info('[VideoPlayer] mount()', [
            'page' => $page,
            'currentVideoId' => $this->currentVideoId,
            'user_id' => Auth::id(),
        ]);

        $this->page = $page;
        $this->loadCompletedVideos();
        $this->checkIfSubscribed();
        $this->loadInitialVideo();
        $this->checkIfSubmitted();
    }

    public function checkIfSubscribed()
    {
        if (!Auth::check()) {
            Log::info('[VideoPlayer] checkIfSubscribed() — guest user, isSubscribed = false');
            $this->isSubscribed = false;
            return;
        }

        $user = Auth::user();

        if ($user->is_admin) {
            Log::info('[VideoPlayer] checkIfSubscribed() — admin user, isSubscribed = true', ['user_id' => $user->id]);
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

        Log::info('[VideoPlayer] checkIfSubscribed()', [
            'user_id' => $user->id,
            'page' => $this->page,
            'isSubscribed' => $this->isSubscribed,
        ]);
    }

    public function loadCompletedVideos()
    {
        if (Auth::check()) {
            $this->completedVideoIds = Auth::user()->rates()
                ->pluck('ressource_id')
                ->map(fn($id) => (int) $id)
                ->toArray();

            Log::info('[VideoPlayer] loadCompletedVideos()', [
                'user_id' => Auth::id(),
                'count' => count($this->completedVideoIds),
                'ids' => $this->completedVideoIds,
            ]);
        } else {
            Log::info('[VideoPlayer] loadCompletedVideos() — skipped, user not authenticated');
        }
    }

    public function selectVideo($videoId)
    {
        Log::info('[VideoPlayer] selectVideo()', ['videoId' => $videoId]);

        $video = Ressource::find($videoId);
        if (!$video) {
            Log::warning('[VideoPlayer] selectVideo() — video not found', ['videoId' => $videoId]);
            return;
        }

        $isPremium = $video->visibilite != 'tous';
        if ($isPremium && !$this->isSubscribed) {
            Log::info('[VideoPlayer] selectVideo() — access denied, opening subscription modal', [
                'videoId' => $videoId,
                'visibilite' => $video->visibilite,
                'user_id' => Auth::id(),
            ]);
            $this->dispatch('open-sub-modal');
            return;
        }

        $this->currentVideoId = (int) $video->id;
        $this->videoTitle = $video->titre;
        $this->videoDescription = $video->description;
        $this->videoUrl = route('video-link', ['videoName' => $video->video_url]);

        Log::info('[VideoPlayer] selectVideo() — video loaded', [
            'videoId' => $this->currentVideoId,
            'title' => $this->videoTitle,
            'visibilite' => $video->visibilite,
        ]);

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

            Log::info('[VideoPlayer] markVideoCompleted() — marked as completed', [
                'user_id' => Auth::id(),
                'videoId' => $videoId,
            ]);

            $this->loadCompletedVideos();
        } else {
            Log::info('[VideoPlayer] markVideoCompleted() — skipped (already completed or guest)', [
                'videoId' => $videoId,
                'user_id' => Auth::id(),
            ]);
        }
    }

    public function loadInitialVideo()
    {
        Log::info('[VideoPlayer] loadInitialVideo()', ['page' => $this->page, 'currentVideoId' => $this->currentVideoId]);

        $ressources = $this->getFilteredRessources();
        if ($this->page === 'pedagogie') {
            $ressources = $ressources->flatten();
        }

        $startingVideo = $ressources->where('id', $this->currentVideoId)->first();
        if (!$startingVideo || ($startingVideo->visibilite != 'tous' && !$this->isSubscribed)) {
            Log::info('[VideoPlayer] loadInitialVideo() — falling back to first public video', [
                'requestedId' => $this->currentVideoId,
            ]);
            $startingVideo = $ressources->where('visibilite', 'tous')->first();
            $this->currentVideoId = $startingVideo;
        }

        if ($startingVideo) {
            Log::info('[VideoPlayer] loadInitialVideo() — starting video selected', ['videoId' => $startingVideo->id]);
            $this->selectVideo($startingVideo->id);
        } else {
            Log::warning('[VideoPlayer] loadInitialVideo() — no video found to load', ['page' => $this->page]);
        }
    }

    public function checkIfSubmitted()
    {
        if (Auth::check() && $this->currentVideoId) {
            $this->isSubmitted = Auth::user()->rates()
                ->where('ressource_id', $this->currentVideoId)
                ->exists();

            Log::info('[VideoPlayer] checkIfSubmitted()', [
                'user_id' => Auth::id(),
                'videoId' => $this->currentVideoId,
                'isSubmitted' => $this->isSubmitted,
            ]);
        }
    }

    protected function getFilteredRessources()
    {
        $query = Ressource::with('category')
            ->where('categorie', $this->page)
            ->orderBy('ordre', 'asc');

        $results = ($this->page == 'neuralbox')
            ? $query->get()
            : $query->get()->groupBy(fn($item) => $item->category->name ?? 'Unité');

        Log::info('[VideoPlayer] getFilteredRessources()', [
            'page' => $this->page,
            'count' => $results->count(),
        ]);

        return $results;
    }

    public function saveEvaluation()
    {
        Log::info('[VideoPlayer] saveEvaluation() — attempting', [
            'user_id' => Auth::id(),
            'videoId' => $this->currentVideoId,
        ]);

        $this->validate();

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

        Log::info('[VideoPlayer] saveEvaluation() — saved successfully', [
            'user_id' => Auth::id(),
            'videoId' => $this->currentVideoId,
        ]);

        $this->isSubmitted = true;
        session()->flash('message', 'تم إرسال التقييم بنجاح!');
    }

    public function render()
    {
        return view('livewire.video-player', [
            'ressources' => $this->getFilteredRessources()
        ]);
    }
}
