@php
    $user = Auth::user();
    $isAdmin = $user && $user->is_admin;
    $resId = (int) $ressource->id;

    // Logique accès
    $hasSub = false;
    if ($user) {
        $hasSub = ($page === 'pedagogie') 
            ? ($isAdmin || \App\Models\Subscription::where('user_id', $user->id)
                ->where('type','golden')
                ->where('status','validated')
                ->exists())
            : ($isAdmin || $user->has_access);
    }

    $isPremium = $ressource->visibilite != 'tous';
    $previousRes = $flatList->where('ordre', '<', $ressource->ordre)
                            ->sortByDesc('ordre')
                            ->first();
    $progressionLocked = ($isPremium && $hasSub && !$isAdmin && $previousRes) 
                         ? !in_array((int)$previousRes->id, $completedVideoIds) 
                         : false;

    $isLocked = ($isPremium && !$hasSub) || $progressionLocked;

    // Action
    $action = "window.Livewire.find('".$_instance->getId()."').call('selectVideo', ".$resId.")";
    if ($isPremium && !$hasSub) $action = "showSubscriptionPopup()";
    if ($progressionLocked) $action = "showProgressionPopup()";
@endphp

<div wire:key="item-final-{{ $resId }}-{{ count($completedVideoIds) }}"
     onclick="{!! $action !!}"
     x-data
     :class="$wire.currentVideoId == {{ $resId }} ? 'shadow-lg border-white' : ''"
     class="playlist-item-container position-relative d-flex mb-3 shadow-sm p-3 rounded cursor-pointer"
     style="transition: all 0.3s ease; background-color: #775b9f; border: 2px solid rgba(255,255,255,0.1);">

    {{-- Overlay Cadenas --}}
    @if($isLocked)
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center rounded" 
             style="z-index: 5; background: rgba(0,0,0,0.3); pointer-events: none;">
            <i class="fas {{ (!$user || !$hasSub) ? 'fa-lock' : 'fa-play-circle' }} text-white fa-2x"></i>
        </div>
    @endif

    {{-- Thumbnail --}}
    <div class="thumbnail-container flex-shrink-0" style="width: 160px;">
        <img src="{{ route('secure.file',['type'=>'ressource','id'=>$resId]) }}" 
             class="img-fluid rounded shadow-sm" 
             style="height: 90px; width: 100%; object-fit: cover;">
    </div>

    {{-- Texte --}}
    <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-center">
        <h6 class="video-title mb-1 fw-bold text-white" 
            style="font-size: 1.05rem; text-shadow: 0px 1px 2px rgba(0,0,0,0.2);">
            {{ $ressource->titre }}
        </h6>
        
        <small class="video-desc opacity-75" 
               style="font-size: 0.85rem; display: block; color: #e9ecef; line-height: 1.2;">
            {{ Str::limit($ressource->description, 75) }}
        </small>
    </div>

    {{-- Indicateur de lecture --}}
    <template x-if="$wire.currentVideoId == {{ $resId }}">
        <div class="position-absolute end-0 top-50 translate-middle-y me-2">
            <div class="bg-white rounded-circle" style="width: 8px; height: 8px;"></div>
        </div>
    </template>
</div>