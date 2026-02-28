<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Rate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

//$ffmpegPath = '/home/u948188746/ffmpeg/ffmpeg-7.0.2-amd64-static/ffmpeg';
class RessourceController extends Controller
{

    //private $ffmpegPath = '/home/u948188746/ffmpeg/ffmpeg-7.0.2-amd64-static/ffmpeg';

    public function pedagogie()
    {
        // $ressources = Ressource::where('categorie', 'pedagogie')->get();
        //  $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();

        // $visibilite = $estAbonne ? 'abonne' : 'tous';

        // $ressourcesGratuites = Ressource::getRessources('pedagogie', 'tous');
        $ressources = Ressource::with('category')
            ->where('categorie', 'pedagogie')
            ->orderBy('ordre', 'asc')
            ->get();

        // $ressourcesGrouped = $ressources->groupBy(function ($item) {
        //     return $item->category->name ?? 'بدون فئة';
        // });
        // $ressourcesPremium = Ressource::getRessources('pedagogie', 'abonne');

        return view('peda', compact('ressources'));
    }

    public function neuralbox()
    {

        $originRessources = Ressource::where('categorie', 'neuralbox')
            ->orderBy('ordre', 'asc')
            ->get();

        // 2. Map the collection to encrypt the ID of each resource
        $ressources = $originRessources->map(function ($ressource) {
            // Check if the model has an 'id' attribute to encrypt
            if (isset($ressource->id)) {
                // Create a new attribute called 'encrypted_id' on the model
                $ressource->encrypted_id = Crypt::encryptString($ressource->id);
            }

            // Return the modified Ressource model object
            return $ressource;
        });
        // $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();
        // $visibilite = $estAbonne ? 'abonne' : 'tous';

        // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        // $ressourcesGratuites = Ressource::getRessources('neuralbox', 'tous');
        // $ressourcesPremium = Ressource::getRessources('neuralbox', 'abonne');

        return view('neuralbox', compact('ressources'));
    }
    // public function showPedagogie()
        // {
        //     // Détermine si l'utilisateur est abonné
        //     $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();
        //     $visibilite = $estAbonne ? 'abonne' : 'tous';

        //     // Récupère les ressources gratuites et premium si l'utilisateur est abonné
        //     // $ressourcesGratuites = Ressource::getRessources('pedagogie', 'tous');
        //     // $ressourcesPremium = Ressource::getRessources('pedagogie', 'abonne');
        //     $ressources = Ressource::with('category')
        //         ->where('categorie', 'pedagogie')
        //         ->groupBy('category_id')
        //         ->get();

        //     return view('pedagogie', [
        //         // 'ressourcesGratuites' => $ressourcesGratuites,
        //         // 'ressourcesPremium' => $ressourcesPremium,
        //         'estAbonne' => $estAbonne,
        //         'visibilite' => $visibilite,
        //     ]);
        // }

        // /**
        //  * Affiche la page des ressources NeuralBox
        //  */
        // public function showNeuralBox()
        // {
        //     // Détermine si l'utilisateur est abonné
        //     $estAbonne = Auth::check() && Auth::user()->is_admin || Paiement::where('user_id', Auth::id())->exists();
        //     $visibilite = $estAbonne ? 'abonne' : 'tous';

        //     // Récupère les ressources
        //     $ressourcesGratuites = Ressource::getRessources('neuralbox', 'tous');
        //     $ressourcesPremium = Ressource::getRessources('neuralbox', 'abonne');

        //     return view('neuralbox1', [
        //         'ressourcesGratuites' => $ressourcesGratuites,
        //         'ressourcesPremium' => $ressourcesPremium,
        //         'estAbonne' => $estAbonne,
        //         'visibilite' => $visibilite,
        //     ]);
    // }
    public function index()
    {
        $ressources = Ressource::with('category')->get();
        return view('admin.ressource.index', compact('ressources'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.ressource.create', ['categories' => $categories]);
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'titre' => 'required',
    //             'categorie' => 'required|in:pedagogie,neuralbox',
    //             'description' => 'required|string|max:255',
    //             'visibilite' => 'required|in:abonne,tous',
    //             'video_url' => 'nullable|file|mimes:mp4|max:1000000', // ~100MB
    //             'ordre' => 'nullable|integer|min:0',
    //             'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // ~2MB
    //             'category_id' => 'nullable|exists:categories,id',
    //         ]);

    //         $data = $request->only(['titre', 'categorie', 'description', 'visibilite', 'ordre', 'category_id']);

    //         // Gestion de l'image
    //         if ($request->hasFile('preview_image')) {
    //             $imagePath = $request->file('preview_image')->store('images', 'private');
    //             $data['preview_image'] = $imagePath;
    //         }

    //         // Gestion de la vidéo
    //         if ($request->hasFile('video_url')) {
    //             $mp4Path = $request->file('video_url')->store('videos', 'private');
    //             $videoName = pathinfo($mp4Path, PATHINFO_FILENAME);
    //             $data['video_url'] = $videoName;

    //             // Convert to HLS
    //             $inputPath = storage_path("app/private/{$mp4Path}");
    //             $outputDir = storage_path("app/private/videos/{$videoName}_hls");
    //             if (!file_exists($outputDir)) mkdir($outputDir, 0777, true);

    //             $outputPath = $outputDir . "/index.m3u8";

    //             $process = new Process([
    //                 'ffmpeg',
    //                 '-i',
    //                 $inputPath,
    //                 '-c:v',
    //                 'copy', // <-- Video stream copy
    //                 '-c:a',
    //                 'copy', // <-- Audio stream copy
    //                 '-hls_time',
    //                 '10',
    //                 '-hls_list_size',
    //                 '0',
    //                 '-f',
    //                 'hls',
    //                 $outputPath
    //             ]);
    //             $process->setTimeout(3600);
    //             $process->run();

    //             if (!$process->isSuccessful()) {
    //                 throw new ProcessFailedException($process);
    //             }
    //         }

    //         $ressource = Ressource::create($data);

    //         if ($request->filled('category_id')) {
    //             $category = Category::find($request->input('category_id'));
    //             $ressource->category()->associate($category);
    //             if ($category) {
    //                 $ressource->save();
    //             }
    //         }

    //         return response()->json(['success' => true]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Return validation errors
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $e->errors(),
    //         ], 422);
    //     } catch (\Exception $e) {
    //         // Return general errors
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    // Gestion de la vidéo
    // if ($request->hasFile('video_url')) {
    //     $videoPath = $request->file('video_url')->store('videos', 'private');
    //     $data['video_url'] = $videoPath;
    // }


    public function edit($id)
    {
        $categories = Category::all();
        $ressource = Ressource::findOrFail($id);
        return view('admin.ressource.edit', compact('ressource', 'categories'));
    }

    public function update(Request $request, $id)
    {
        set_time_limit(3600);
        // Wrap the entire logic in try/catch to handle all errors (validation, file, FFmpeg)
        try {
            // 1. Validation (This is what throws the exception we need to catch)
            $validatedData = $request->validate([
                'titre' => 'required|string|max:255',
                'description' => 'nullable|string',
                'categorie' => 'required|string',
                'visibilite' => 'required|string',
                'ordre' => 'nullable|integer|min:0',
                // Files are now optional for update, but we keep the same file rules
                'video_url' => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg|max:1000000',
                'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'category' => 'nullable|exists:categories,id',
            ]);

            $ressource = Ressource::findOrFail($id);

            // Prepare data for update
            $dataToUpdate = $request->only(['titre', 'description', 'categorie', 'visibilite', 'ordre']);
            $dataToUpdate['category_id'] = $request->input('category');

            // 2. Mise à jour des champs texte
            $ressource->fill($dataToUpdate); // Use fill for bulk updates

            // Mise à jour de la vidéo
            if ($request->hasFile('video_url')) {
                // ... (Your existing video processing logic starts here) ...

                // Remove previous HLS folder
                $previous = $ressource->video_url;
                if ($previous) {
                    try {
                        $prevHlsDir = storage_path("app/private/videos/{$previous}_hls");
                        if (is_dir($prevHlsDir)) {
                            File::deleteDirectory($prevHlsDir);
                        }
                        if (Str::contains($previous, '/') && Storage::disk('private')->exists($previous)) {
                            Storage::disk('private')->delete($previous);
                        }
                    } catch (\Exception $e) {
                        Log::warning('Failed to delete old video files: ' . $e->getMessage());
                    }
                }

                // Store uploaded mp4 in private disk
                $mp4Path = $request->file('video_url')->store('videos', 'private');
                $videoName = pathinfo($mp4Path, PATHINFO_FILENAME);

                // Convert to HLS (FFmpeg processing logic)
                $inputPath = storage_path("app/private/{$mp4Path}");
                $outputDir = storage_path("app/private/videos/{$videoName}_hls");
                if (!file_exists($outputDir)) mkdir($outputDir, 0777, true);
                $outputPath = $outputDir . "/index.m3u8";

                $process = new Process([
                    'ffmpeg',
                    '-i',
                    $inputPath,
                    '-c:v',
                    'copy', // <-- Video stream copy
                    '-c:a',
                    'copy', // <-- Audio stream copy
                    '-hls_time',
                    '10',
                    '-hls_list_size',
                    '0',
                    '-f',
                    'hls',
                    $outputPath
                ]);
                $process->setTimeout(3600);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                // Optionally delete original mp4 to save space
                if (Storage::disk('private')->exists($mp4Path)) {
                    Storage::disk('private')->delete($mp4Path);
                }

                // Save the video name
                $ressource->video_url = $videoName;
            }


            // Mise à jour de l'image de prévisualisation
            if ($request->hasFile('preview_image')) {
                if ($ressource->preview_image) {
                    Storage::disk('private')->delete($ressource->preview_image);
                }

                $imagePath = $request->file('preview_image')->store('images', 'private');
                $ressource->preview_image = $imagePath;
            }

            $ressource->save();

            // 3. SUCCESS RESPONSE (JSON for AJAX)
            return response()->json([
                'success' => true,
                'message' => 'Ressource modifiée avec succès.',
                'ressource' => $ressource // Optional: return the updated object
            ], 200);
        } catch (ValidationException $e) {
            // 4. VALIDATION ERROR RESPONSE (422 for AJAX)
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation.',
                'errors' => $e->errors() // Send validation error details back
            ], 422);
        } catch (\Exception $e) {
            // 5. GENERIC ERROR RESPONSE (500 for AJAX)
            Log::error('Ressource update failed for ID ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur inattendue est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Ressource $ressource)
    {
        $ressource->delete();
        return back()->with('success', 'Ressource supprimée.');
    }

    public function navigate(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:ressources,id',
            'direction' => 'required|in:next,prev',
            'category' => 'required|in:pedagogie,neuralbox',
        ]);

        $current = Ressource::findOrFail($request->id);
        $subscribed = false;

        if (Auth::check())
            $subscribed = Auth::check() && Auth::user()->subscription_type;



        $query = Ressource::where('categorie', $current->categorie);

        if ($request->direction === 'next') {
            $query->where('ordre', '>', $current->ordre)->orderBy('ordre', 'asc');
        } else {
            $query->where('ordre', '<', $current->ordre)->orderBy('ordre', 'desc');
        }

        $target = $query->first();

        if (!$target) {
            return response()->json(['message' => 'No video found'], 404);
        }

        return response()->json([
            'id' => $target->id,
            'title' => $target->titre,
            'order' => $target->ordre,
            'video_url' => route('video-link', ['videoName' => $target->video_url]),
        ]);
    }


    public function uploadChunk(Request $request)
    {
        // Resumable.js uses 'file' for the chunk
        $file = $request->file('file');
        $identifier = $request->input('resumableIdentifier');
        $chunkNumber = $request->input('resumableChunkNumber');

        if (!$file || !$identifier || !$chunkNumber) {
            return response()->json(['status' => 'error', 'message' => 'Missing chunk data.'], 400);
        }

        $tempDir = storage_path("app/private/chunks/{$identifier}");
        if (!Storage::exists("private/chunks/{$identifier}")) {
            // Use Storage facade for consistency and automatic path handling
            Storage::makeDirectory("private/chunks/{$identifier}");
        }

        // Move chunk to the temporary directory
        $file->move($tempDir, "chunk_{$chunkNumber}");

        return response()->json(['status' => 'chunk uploaded']);
    }

    /**
     * Handles the merging of all chunks and the final creation of the resource.
     */
    public function mergeChunks(Request $request)
    {
        // 1. Validation for form data
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:pedagogie,neuralbox',
            'description' => 'required|string|max:1000', // Increased max length for description
            'visibilite' => 'required|in:abonne,tous',
            'ordre' => 'nullable|integer|min:0',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // File is passed here
            'video_category_id' => 'nullable|exists:categories,id',
            // Resumable fields for merging
            'identifier' => 'required|string',
            'filename' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Delete all chunks for the failed upload
            Storage::deleteDirectory("private/chunks/{$request->input('identifier')}");
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $identifier = $request->input('identifier');
        $filename = $request->input('filename');

        $tempDir = storage_path("app/private/chunks/{$identifier}");
        $finalDir = storage_path("app/private/videos");
        $finalPath = $finalDir . '/' . $filename;

        // Use Storage::exists and mkdir (or makeDirectory) for Laravel/filesystem consistency
        if (!Storage::exists("private/videos")) {
            Storage::makeDirectory("private/videos");
        }

        // 2. Merge Chunks
        try {
            $finalFile = fopen($finalPath, 'ab');

            $chunks = glob($tempDir . '/chunk_*');
            natsort($chunks); // Sort chunks numerically

            foreach ($chunks as $chunk) {
                $chunkFile = fopen($chunk, 'rb');
                stream_copy_to_stream($chunkFile, $finalFile);
                fclose($chunkFile);
            }

            fclose($finalFile);
        } catch (\Exception $e) {
            // Clean up failed merge attempts
            Storage::deleteDirectory("private/chunks/{$identifier}");
            return response()->json(['success' => false, 'message' => 'Erreur lors de la fusion des morceaux: ' . $e->getMessage()], 500);
        }

        // 3. Clean up and Resource Creation
        // Remove temp chunks
        Storage::deleteDirectory("private/chunks/{$identifier}");

        $data = $request->only(['titre', 'categorie', 'description', 'visibilite', 'ordre']);
        $data['video_url'] = pathinfo($filename, PATHINFO_FILENAME);
        // Map the corrected category ID field
        $data['category_id'] = $request->input('video_category_id');

        // Handle preview image upload
        if ($request->hasFile('preview_image')) {
            // 'private' disk should be configured to point to storage_path('app/private')
            $imagePath = $request->file('preview_image')->store('images', 'private');
            $data['preview_image'] = $imagePath; // Store only the filename if using public access
        }

        // Create the resource record
        $ressource = Ressource::create($data);

        // 4. HLS Conversion (Asynchronous approach is recommended for long jobs)
        try {
            $outputDir = $finalDir . '/' . pathinfo($filename, PATHINFO_FILENAME) . '_hls';
            if (!is_dir($outputDir)) mkdir($outputDir, 0777, true);
            $outputPath = $outputDir . "/index.m3u8";

            $mp4Path = "videos/{$filename}";

            // Convert to HLS (FFmpeg processing logic)
            $inputPath = storage_path("app/private/{$mp4Path}");

            // IMPORTANT: Use full paths for ffmpeg
            $process = new Process([
                'ffmpeg',
                '-i',
                $inputPath,
                '-c:v',
                'copy', // <-- Revert to simple stream copy
                '-c:a',
                'copy',
                '-hls_time',
                '10',
                '-hls_list_size',
                '0',
                '-f',
                'hls',
                $outputPath
            ]);
            $process->setTimeout(3600); // 1 hour timeout
            $process->run();

            if (!$process->isSuccessful()) {
                // Log error, but don't fail the merge. The resource is created, conversion failed.
                // Consider using a Queued Job (e.g., `php artisan make:job ConvertVideoForHLS`) for this.
                Log::error('FFMPEG HLS Conversion Failed', ['error' => $process->getErrorOutput(), 'path' => $finalPath]);
            }
        } catch (\Exception $e) {
            Log::error('HLS Conversion Exception', ['message' => $e->getMessage(), 'path' => $finalPath]);
        }

        // 5. Final Response
        return response()->json([
            'success' => true,
            'ressource_id' => $ressource->id,
            'message' => 'Ressource et vidéo ajoutées avec succès!',
            // Optional: 'redirect_url' => route('admin.ressources.edit', $ressource)
        ]);
    }

    public function reviews($id){
        $reviews = Rate::where('ressource_id',$id)->with('user','ressource')->paginate(10);
        
        return view('admin.reviews.index',compact(['reviews']));
    }
    
    public function reviewShow($id){
        $review = Rate::with('user')->find($id);
        
        return view('admin.reviews.show',compact(['review']));
    }

    public function streamVideo($videoName)
    {
        // 1. Security Check: Ensure user is subscribed
        $user = auth()->user();

if (!$user->has_access && !$user->is_admin) {
    abort(403, 'Vous n’avez pas accès à cette vidéo.');
}

        // 2. Define the path to your private videos
        $path = storage_path("app/private/videos/{$videoName}.mp4");

        if (!file_exists($path)) {
            abort(404);
        }

        // 3. Return the file as a stream
        return response()->file($path, [
            'Content-Type' => 'video/mp4', // or 'application/x-mpegURL' for HLS
            'Accept-Ranges' => 'bytes',
        ]);
    }
    
}