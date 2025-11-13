<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(Storage::get("videos/home.mp4"));
    }


    public function getVideoUrl($filename,Request $request)
    {
        $url = URL::temporarySignedRoute(
            'video.stream',
            now()->addMinutes(30),
            ['filename' => $filename]
        );
        if($request->expectsJson()){
            return response()->json(['success' => true,'url' => $url]);
        }
        return redirect($url);
        
    }



    // public function getVideo(string $video)
    // {
    //     $name = $video;
    //     $fileContents = Storage::get("videos/{$name}");

    //     $response = Response::make($fileContents, 200);
    //     $response->header('Content-Type', "video/mp4");
    //     return $response;
    // }
    public function getVideo(string $videoName)
    {
        $path = "videos/{$videoName}_hls/index.m3u8";
        $fullPath = storage_path("app/private/{$path}");

        if (!file_exists($fullPath)) {
            abort(404, 'Video not found');
        }

        // ✅ Rewrite .m3u8 file to use secure route URLs
        $content = file_get_contents($fullPath);
        $baseUrl = route('secure.video', ['path' => "videos/{$videoName}_hls"]);

        // Replace segment names with secure URLs
        $content = preg_replace(
            '/^((?!#).+\.ts)$/m',
            "{$baseUrl}/$1",
            $content
        );

        return response($content, 200, [
            'Content-Type' => 'application/vnd.apple.mpegurl',
            'Cache-Control' => 'no-cache',
        ]);
    }


    public function serveSecureVideo($path)
    {
        $fullPath = storage_path("app/private/{$path}");

        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath, [
            'Content-Type' => mime_content_type($fullPath),
            'Cache-Control' => 'no-cache',
        ]);
    }


    //     public function getVideo($video)
    // {
    //     // Make sure only authorized users can access
    //     $filePath = "videos/{$video}";
    //     if (!Storage::disk('private')->exists($filePath)) {
    //         abort(404);
    //     }

    //     $fileContents = Storage::disk('private')->get($filePath);
    //     $mime = Storage::disk('private')->mimeType($filePath);

    //     return Response::make($fileContents, 200, [
    //         'Content-Type' => $mime,
    //         'Content-Disposition' => 'inline; filename="'.$video.'"',
    //     ]);
    // }

    // // Signed URL generation example
    // public function getSignedVideoUrl($video)
    // {
    //     $url = URL::temporarySignedRoute(
    //         'video.show', // named route
    //         now()->addMinutes(5),
    //         ['video' => $video]
    //     );

    //     return response()->json(['url' => $url]);
    // }
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
