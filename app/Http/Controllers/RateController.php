<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Ressource;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validated = $request->validate([
                'signed_ressource_id' => 'required',

                'manual_steps_respect' => 'required|in:fully,partially,not_at_all',
                'focus_and_memory' => 'required|in:good,average,weak',
                'family_involvement' => 'required|in:good,average,weak',
                'motor_and_emotional_stability' => 'required|in:good,average,weak',
                'enjoyment' => 'required|in:good,average,weak',
                'challenge_and_persistence' => 'required|in:good,average,weak',
                'digital_addiction_avoidance' => 'required|in:fully,partially,not_at_all',
                'attached_docs_usage' => 'required|in:fully,partially,not_at_all',

                'game_strengths' => 'nullable|string|max:1000',
                'observed_results' => 'nullable|string|max:1000',
                'difficulties' => 'nullable|string|max:1000',
                'general_notes' => 'nullable|string|max:1000',
            ]);

            $encryptedId = $request->input('signed_ressource_id');

            // Decrypt the ID securely
            $decryptedId = Crypt::decryptString($encryptedId);

            $validated['user_id'] = Auth::id();
            $validated['ressource_id'] = $decryptedId;

            $rate = Rate::create($validated);

            $ressource = Ressource::find($validated['ressource_id']);
            $ressourceNext = Ressource::where('categorie',$ressource->categorie)->where('ordre',($ressource->ordre+1))->select('id', 'video_url', 'titre')->first();
            return response()->json([
                'success' => true,
                'videoData'=>[
                    'id' => $ressourceNext->id,
                    'title' => $ressourceNext->titre,
                    'video_url' => route('video-link', ['videoName' => $ressourceNext->video_url]),
                ],
                'message' => __('rate.add_success'),
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => __($e->getMessage()),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function alreadyRated(Request $request)
    {
        // 1. Handle Decryption Errors
        try {
            $ressouceId = Crypt::decryptString($request->ressource_id);
        } catch (DecryptException $e) {
            // Log the error and return an appropriate JSON response
            report($e); // Logs the error for debugging
            return response()->json([
                'success' => false,
                'message' => 'Invalid resource identifier.',
                'isSubmittedBefore' => false, // Default to false if we can't trust the ID
            ], 400); // HTTP 400 Bad Request
        }

        // 2. Execute the Check
        // Using a strict boolean check is usually best practice
        $isSubmittedBefore = Rate::where('ressource_id', $ressouceId)
            ->where('user_id', Auth::id())
            ->exists();

        // 3. Return Success Response
        return response()->json([
            'success' => true,
            // The exists() method returns a boolean, but will be cast to 1 or 0 in the JSON response
            'isSubmittedBefore' => $isSubmittedBefore,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
