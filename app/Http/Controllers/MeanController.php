<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MeanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function suivre()
    {
        // if(Auth::check())
        //     return view('neuralbox');

        return view('suivre');
    }

    public function index(Request $request)
    {
        $locale = session('locale', 'ar'); // Default to Arabic
        app()->setLocale($locale);

        return view('welcome');
    }



    public function getVideoUrl($filename)
    {
        $url = URL::temporarySignedRoute(
            'video.stream',
            now()->addMinutes(30),
            ['filename' => $filename]
        );
        return response()->json(['url' => $url]);
    }


    public function getVideo(string $video)
    {
        // dd($video);
        $name = $video;
        $fileContents = Storage::get("videos/{$name}");

        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cours $cours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        //
    }
}
